<?php
/**
 * Created by PhpStorm.
 * User: denis
 * Date: 18.03.17
 * Time: 17:00
 */

namespace App\Providers;


use Silex\Api\ControllerProviderInterface;
use Silex\Application;
use Silex\ControllerCollection;

class Home implements ControllerProviderInterface
{

    /**
     * Returns routes to connect to the given application.
     *
     * @param Application $app An Application instance
     *
     * @return ControllerCollection A ControllerCollection instance
     */
    public function connect(Application $app)
    {
        $home = $app['controllers_factory'];

        $home->get("/", "App\\Controllers\\HomeController::index");

        $home->post("/", "App\\Controllers\\HomeController::store");

        $home->get("/{id}", "App\\Controllers\\HomeController::show");

        $home->get("/edit/{id}", "App\\Controllers\\HomeController::edit");

        $home->put("/{id}", "App\\Controllers\\HomeController::update");

        $home->delete("/{id}", "App\\Controllers\\HomeController::destroy");

        return $home;
    }
}