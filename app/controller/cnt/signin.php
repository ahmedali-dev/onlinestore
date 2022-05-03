<?php
require_once __DIR__ . "/../../database/users.php";

trait Signin
{
    function signin(Router $router)
    {
        $userRepo = new userRepo();
        $model = $userRepo->getmodel();

        //session
        $model->session(function ($user) {
            header("Location: /home");
        });

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === "GET") {
            $router->view("signin", ['img' => '/cpa'], true);
        } else if ($method === 'POST') {
            $success = false;
            $email = $model->check(post: "email")
                ->isEmail()
                ->custom($userRepo, function ($email, $userRepo, $t) {
                    $getEmail = $userRepo->getOneBy(['email' => $email])['this']->count();
                    if ($getEmail !== 1) {
                        throw new Error("email is not found");
                    }
                })->getValue();
            $pass = $model->check(post: "pass")
                ->isString()
                ->isLength(msg: "pass must be less 32 up 8 char")
                ->custom([$userRepo, $email], function ($pass, $attrs) {
                    $userRepo = $attrs[0];
                    $email = $attrs[1];

                    $password = @$userRepo
                        ->getOneBy(['email' => $email])['data']->password;
                    if (!password_verify($pass, $password)) {
                        throw new Error("invalid password", 1);
                    }
                });

            $cpa = $model->check(post: 'cpa')
                ->isString()
                ->custom($_SESSION['cpa'], function ($cpa, $sess) {
                    if (strcmp($cpa, $sess) !== 0) {
                        throw new Error("cpa is not matched");
                    }
                });

            $active = $model->check(
                custom: [
                    'body' => 'active',
                    'value' => 'value'
                ]
            )->custom([$userRepo, $email], function ($active, $attrs) {
                $userRepo = $attrs[0];
                $email = $attrs[1];
                $active =  @$userRepo
                    ->getOneBy(['email' => $email])['data']
                    ->active;
                if ($active === '0') {
                    throw new Error("account not active", 1);
                }
            });

            if ($model->errIsEmpty()) {

                $user = $userRepo
                    ->getOneBy(['email' => $email]);
                $_SESSION['userData'] = $user['data'];
                $success = true;
                echo json_encode(['success' => true]);
            }


            echo $success ? "" : json_encode($model->getError());
            $router->view("signin", [], FALSE);
        }
    }
}