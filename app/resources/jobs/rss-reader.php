<?php

date_default_timezone_set('europe/kiev');

include_once '/vagrant/share/sg-news-silex.dev/vendor/autoload.php';

/* Подключение к БД */
$db = new PDO("mysql:host=localhost;dbname=sg_news_silex;charset=utf8", "root", "123");

// Получение списка RSS ресурсов из таблицы resources
$resources = [];
foreach ($db->query("SELECT url FROM sources")->fetchAll() as $i)
    $resources[] = $i['url'];

/* Наполнение таблицы news данными из RSS ресурсов*/
$sql = "INSERT IGNORE INTO news (title, link, description, source, pub_date) VALUES (?, ?, ?, ?, ?)";
$stmt = $db->prepare($sql);

$feed = new SimplePie();
$feed->enable_cache(false);

$feed->set_feed_url($resources);
$feed->init();
$items = $feed->get_items();

foreach ($items as $item) {
    $stmt->execute([
        $item->get_title(),
        $item->get_link(),
        $item->get_description(),
        $item->get_feed()->get_link(),
        $item->get_date("Y-m-d H:i:s"),
    ]);
}

/* Отключение от БД */
$db = null;