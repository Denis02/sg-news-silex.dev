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
    public function store(){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        if (isset($_POST['name']) && isset($_POST['url']))
            $this->news->setResource($_POST['name'],$_POST['url']);

        return new RedirectResponse('/cabinet');
    }
    //put
    public function update($id){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        if (isset($id) && isset($_POST['name']) && isset($_POST['url']))
            $this->news->updateResource($id, $_POST['name'],$_POST['url']);

        return new RedirectResponse('/cabinet');
    }
    //delete
    public function destroy($id){
        if(!isset($_SESSION['logged']))
            return new RedirectResponse('/login');

        if (isset($id))
            $this->news->deleteResource($id);

        return new RedirectResponse('/cabinet');
    }
}