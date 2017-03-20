<?php
/* Вывод данных на экран */

foreach($items as $item): ?>

    <div class="panel panel-default">

        <div class="panel-heading">
            <a target="_blank" href="<?= $item['link'] ?>">
                <?= $item['id'] ?> || <?= $item['title'] ?>
            </a>
        </div>

        <div class="panel-body"><?= $item['description'] ?></div>

        <div class="panel-footer">
            <?= $item['pub_date'] ?> -
            <a target="_blank" href="<?= $item['source'] ?>"><?= $item['source'] ?></a>
        </div>

    </div>

<?php endforeach;


/* Пагинация */

$num_pages = ceil($quantity / $per_page);
$page = 0;

?>
<ul class="pagination">

    <li><a href="?page=1">«</a></li>

    <?php while ($page++ < $num_pages): ?>

        <?php if ($page == $cur_page): ?>
            <li class="active">
                <a href=""><?=$page?></a>
            </li>
        <?php else: ?>
            <li>
                <a href="?page=<?=$page?>"><?=$page?></a>
            </li>
        <?php endif;

    endwhile ?>

    <?php if ($page > 2): ?>
        <li><a href="?page=<?= $page-1?>">»</a></li>
    <?php endif; ?>

</ul>
