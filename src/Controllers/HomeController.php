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
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class HomeController
{
    public function index(Request $request){
        // получение номера страницы и значения для лимита
        $query = parse_url($request->getRequestUri())['query'] ?? false;
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

    public function getLogin(Request $request)
    {
        $logged = $request->getSession()->get('logged');
        if ($logged) return new RedirectResponse('/cabinet');

        $auth_error = $request->getSession()->get('auth_error');
        $content = APP_DIR.'views/login.php';
        return (new Response)->setContent(include APP_DIR.'views/layouts/default.php');
    }

    public function postLogin(Request $request, Application $app)
    {
        $session = $request->getSession();
        if ($session->get('auth_error'))
            $session->remove('auth_error');

        $login = $request->request->get('login');
        $pass = $request->request->get('password');
        $errors = $app['validator']->validate(
            $request->request->all(),
            new Assert\Collection(array(
                'login'=>new Assert\Length(array('min' => 4)),
//                'login'=>new Assert\Email(),
                'password'=>new Assert\Length(array('min' => 4))
            )));
        if (count($errors) > 0) {
            $content = APP_DIR.'views/login.php';
            return (new Response)->setContent(include APP_DIR.'views/layouts/default.php');
        }
        if (isset($login) && isset($pass)) {
            if ((new User)->login($login, $pass)) {
                $session->set('logged', true);
                return new RedirectResponse('/cabinet');
            }
            else {
                $session->set('auth_error', 'Невірний логін або пароль!');
            }
        }
        return new RedirectResponse('/login');
    }

    public function getLogout(Request $request)
    {
        $request->getSession()->remove('logged');
        return new RedirectResponse('/');
    }


}