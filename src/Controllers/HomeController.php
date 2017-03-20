<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 18.03.17
 * Time: 15:27
 */

namespace App\Controllers;


use App\Models\News;
use App\Models\User;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class HomeController
{
    public function index(){
        // получение номера страницы и значения для лимита
        $query = parse_url($_SERVER['REQUEST_URI'])['query'] ?? false;
        $cur_page = 1;
        $per_page = 50;
        if ($query)
        {
            foreach (explode("&", $query) as $value)
            {
                $page = explode("=", $value);
                if ($page[0]=='page') $cur_page = $page[1] ?? 1;
                if ($page[0]=='limit') $per_page = $page[1] ?? 50;
            }
        }

        extract((new News())->getNews($cur_page,$per_page), EXTR_PREFIX_INVALID, '_');
        $content = APP_DIR.'views/news.php';
        return (new Response)->setContent(include APP_DIR.'views/layouts/default.php');
    }

    public function getLogin()
    {
        $content = APP_DIR.'views/login.php';
        return (new Response)->setContent(include APP_DIR.'views/layouts/default.php');
    }

    public function postLogin()
    {

        if (isset($_SESSION['auth_error']))
            unset($_SESSION['auth_error']);

        if (isset($_POST['login']) && isset($_POST['password'])) {
            if ((new User)->login($_POST['login'], $_POST['password'])) {
                $_SESSION['logged'] = true;
                return new RedirectResponse('/cabinet');
            }
            else {
                $_SESSION['auth_error'] = 'Невірний логін або пароль!';
            }
        }

        return new RedirectResponse('/login');
    }

    public function getLogout()
    {
        if(isset($_SESSION['logged'])){
            unset($_SESSION['logged']);
        }

        return new RedirectResponse('/');
    }


}