<!DOCTYPE html>
<html lang="uk">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="autor" content="Кучевський Денис" />
        <meta name="description" content="Новини" />
        <title>Новини</title>

        <link href="/bootstrap-3/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="/bootstrap-3/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">sg-news.dev</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="/">
                        <span class="glyphicon glyphicon-home"></span>
                        Головна</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php
                if($logged)
                    echo '<li><a href="/cabinet">
                        <span class="glyphicon glyphicon-user"></span>
                        Кабінет</a></li>
                        <li><a href="/logout">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Вийти</a></li>';
                else
                    echo '<li><a href="/login">
                        <span class="glyphicon glyphicon-log-in"></span>
                        Увійти</a></li>';
                ?>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <?php
            if (isset($content))
                include_once $content;
        ?>
    </div>

    <script src="/bootstrap-3/js/jquery-3.1.1.min.js"></script>
    <script src="/bootstrap-3/js/bootstrap.min.js" type="text/javascript"></script>
    </body>
</html>