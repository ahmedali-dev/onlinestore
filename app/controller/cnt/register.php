<?php
require_once __DIR__ . "/../../database/users.php";
trait Register
{
    function register(Router $router)
    {

        $userRepo = new userRepo();
        $model = $userRepo->getmodel();

        //session
        $model->session(function ($user) {
            header("Location: /home");
        });

        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === "GET") {
            $router->view("register", ['img' => '/cpa'], true);
        } else if ($method === 'POST') {
            $data = [];
            $success = false;
            $name = $model->check(post: 'name')
                ->isString()
                ->isLength(msg: "name must be less 32 up 8 char")->getValue();
            $email = $model->check(post: "email")
                ->isEmail()
                ->custom($userRepo, function ($email, $userRepo, $t) {
                    $getEmail = $userRepo->getOneBy(['email' => $email])['this']->count();
                    if ($getEmail > 0) {
                        throw new Error("email is found");
                    }
                })->getValue();
            $pass = $model->check(post: "pass")
                ->isString()
                ->isLength(msg: "pass must be less 32 up 8 char")
                ->getValue();


            $rePass = $model->check(post: "rePass")
                ->isString()
                ->isLength(msg: "pass must be less 32 up 8 char")
                ->custom($pass, function ($rePass, $check) {
                    if (strcmp($rePass, $check) !== 0) {
                        throw new Error("password is not match");
                    }
                });

            $cpa = $model->check(post: 'cpa')
                ->isString()
                ->custom($_SESSION['cpa'], function ($cpa, $sess) {
                    if (strcmp($cpa, $sess) !== 0) {
                        throw new Error("cpa is not matched");
                    }
                });

            if ($model->errIsEmpty()) {
                $pass_hash = password_hash($pass, PASSWORD_ARGON2ID);
                $user = $userRepo
                    ->create(['name' => $name, 'pass' => $pass_hash, 'email' => $email])['this']->getOneBy(['email' => $email]);
                $_SESSION['userData'] = $user['data'];

                //send email 
                $body = <<< EOF

                    <!DOCTYPE html>
                    <html lang="en">

                    <head>
                        <meta charset="UTF-8">
                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
                        <title>onlinestore</title>

                        <style>
                        * {
                            padding: 0;
                            margin: 0;
                            box-sizing: border-box;
                        }

                        body {
                            display: flex;
                            flex-flow: column;
                            align-items: center;
                            justify-content: center;
                            gap: 2rem;
                        }

                        a {
                            display: inline-block;
                            padding: 1rem 5rem;
                            text-decoration: none;
                            border-radius: .5rem;
                            background: lightblue;
                            color: #333;
                            text-transform: capitalize;
                            font-family: sans-serif;
                        }
                        </style>

                    </head>

                    <body>

                        <h1>Hi Dr ahmedali</h1>
                        <p>Thanks for signing up with Heroku!</p>
                        <a href="http://localhost:5555/account/accept/{$_SESSION['userData']->urlcode}">active</a>
                    </body>

                    </html>

                EOF;


                $model->sendEmail([
                    'email' => $_SESSION['userData']->email,
                    'name' => $_SESSION['userData']->NAME,
                    'subject' => 'active account',
                    'body' => $body
                ]);
                $success = true;
                echo json_encode(['success' => true]);
            }


            echo $success ? "" : json_encode($model->getError());
            $router->view("register", $data, FALSE);
        }
    }
}