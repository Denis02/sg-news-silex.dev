<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.03.17
 * Time: 13:57
 */

namespace App\Controllers;


use App\Models\News;
use Silex\Application;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

class CabinetController
{
    protected $news;

    public function __construct()
    {
        $this->news = new News();
    }
    public static function _before(Request $request)
    {
        $logged = $request->getSession()->get('logged');
        if (! $logged) return new RedirectResponse('/login');
    }
    //get
    public function index(Application $app, Request $request){
        $data['items'] = $this->news->getResources();
        $data['logged'] = $request->getSession()->get('logged');
        $data['errors'] = $request->getSession()->get('errors');

        return $app['twig']->render('cabinet.twig', $data);
    }
    //post
    public function store(Application $app, Request $request){
        $name = $request->get('name');
        $url = $request->get('url');
        $errors = $app['validator']->validate($url, new Assert\Url());
        if ((count($errors) == 0) && @get_headers($url) && $name && $url){}
            $this->news->setResource($name,$url);
        dump($errors);
        $request->getSession()->set('errors', $errors);
        return new RedirectResponse('/cabinet');
    }
    //put
    public function update(Application $app, Request $request, int $id){
        $name = $request->get('name');
        $url = $request->get('url');
        $errors = $app['validator']->validate($url, new Assert\Url());
        if ((count($errors) == 0) && @get_headers($url) && isset($id) && $name && $url)
            $this->news->updateResource($id, $name, $url);

        return new RedirectResponse('/cabinet');
    }
    //delete
    public function destroy(Request $request, int $id){
        if (isset($id))
            $this->news->deleteResource($id);
        return new RedirectResponse('/cabinet');
    }
}