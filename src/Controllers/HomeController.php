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
    public function index(Application $app, Request $request){
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

        $data = (new News())->getNews($cur_page,$per_page);
        $data['logged'] = $request->getSession()->get('logged');
        return $app['twig']->render('news.twig', $data);
    }

    public function getLogin(Application $app, Request $request)
    {
        $logged = $request->getSession()->get('logged');
        if ($logged) return new RedirectResponse('/cabinet');

        $errors = $request->getSession()->get('errors');
//        $content = APP_DIR.'views/login.twig';
//        return (new Response)->setContent(include APP_DIR.'views/layouts/default.twig');

        return $app['twig']->render('login.twig', array(
            'logged' => $logged,
            'errors' => $errors
        ));
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
                'login'=>new Assert\Length(array('min' => 8)),
//                'login'=>new Assert\Email(),
                'password'=>new Assert\Length(array('min' => 4))
            )));
        if (count($errors) > 0) {
            $request->getSession()->set('errors',$errors);
            return new RedirectResponse('/login');
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