<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.03.17
 * Time: 15:58
 */

namespace App\Models;


use PDO;

class News
{
    protected $db;

    public function __construct()
    {
        $this->db = new PDO("mysql:host=localhost;dbname=sg_news;charset=utf8", "root", "123");
    }

    public function getResources(){
        return $this->db->query("SELECT * FROM resources ORDER BY id DESC")->fetchAll();
    }

    public function setResource(string $name, string $url){
        return $this->db->query("INSERT IGNORE INTO resources (name, url) VALUES ('$name','$url')");
    }

    public function deleteResource(int $id)
    {
        return $this->db->query("DELETE FROM resources WHERE id=$id");
    }

    public function updateResource(int $id, string $name, string $url)
    {
        return $this->db->query("UPDATE resources SET name='$name', url='$url' WHERE id=$id");
    }

    /**
     * @param int $cur_page - номер текущей страницы
     * @param int $per_page - количество элементов на странице
     * @return array
     */
    public function getNews(int $cur_page = 1, int $per_page = 50){
        // первый элемент на странице
        $start = ($cur_page - 1) * $per_page;
        // получение количества записей в таблице
        $rows = $this->db->query("SELECT COUNT(*) as count FROM news")->fetchColumn();
        // получение записей из таблице, необходимых для текущей страницы
        $items = $this->db->query("SELECT * FROM news ORDER BY `pub_date` DESC  LIMIT $start, $per_page")->fetchAll();
        $num_pages = ceil($rows / $per_page);
        $page = 0;

        return ['quantity'=>$rows,'items'=>$items,'per_page'=>$per_page,'cur_page'=>$cur_page, 'num_pages'=>$num_pages, 'page'=>$page];
    }
}