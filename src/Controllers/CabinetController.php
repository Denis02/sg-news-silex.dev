<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 19.03.17
 * Time: 13:57
 */

namespace App\Controllers;


use App\Models\News;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CabinetController
{
    protected $news;

    public function __construct()
    {
        $this->news = new News();
    }
    //get
    public function index(){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        $items = $this->news->getResources();
        $content = APP_DIR.'views/cabinet.php';
        return (new Response)->setContent(include APP_DIR.'views/layouts/default.php');
    }
    //post
    public function store(Request $request){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        if ($request->get('name') && $request->get('url'))
            $this->news->setResource($request->get('name'),$request->get('url'));

        return new RedirectResponse('/cabinet');
    }
    //put
    public function update(Request $request, int $id){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        $name = $request->get('name');
        $url = $request->get('url');
        if (isset($id) && $name && $url)
            $this->news->updateResource($id, $name, $url);

        return new RedirectResponse('/cabinet');
    }
    //delete
    public function destroy(Request $request, int $id){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        if (isset($id))
            $this->news->deleteResource($id);

        return new RedirectResponse('/cabinet');
    }
}