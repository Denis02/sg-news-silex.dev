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

class Cabinet implements ControllerProviderInterface
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
        $cabinet = $app['controllers_factory'];

        $cabinet->get("/", "App\\Controllers\\CabinetController::index");

        $cabinet->post("/", "App\\Controllers\\CabinetController::store");

//        $cabinet->get("/{id}", "App\\Controllers\\CabinetController::show");

//        $cabinet->get("/edit/{id}", "App\\Controllers\\CabinetController::edit");

        $cabinet->put("/{id}", "App\\Controllers\\CabinetController::update")->assert('id','\d+');

        $cabinet->delete("/{id}", "App\\Controllers\\CabinetController::destroy")->assert('id','\d+');

        return $cabinet;
    }
}