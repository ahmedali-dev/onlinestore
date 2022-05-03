<?php
require_once __DIR__ . "/../../database/users.php";
trait Home
{
    function home(Router $router)
    {
        $userRepo = new userRepo();
        $model = $userRepo->getmodel();

        //session
        $model->session(function ($user) {
            if ($user->kind == 1) {
                header("Location: /admin/dashbord");
            }
        }, function ($user) {
            header("Location: /signin");
        });


        $router->view("home", [], true);
    }
}