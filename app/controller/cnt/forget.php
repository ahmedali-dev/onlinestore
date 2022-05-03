<?php
require_once __DIR__ . "/../../database/users.php";
trait forget {
    function forget (Router $router): void {

        $userRepo = new userRepo();
        $model = $userRepo->getmodel();

        //session
        $model->session(function ($user) {
            header("Location: /home");
        });


        $method = $_SERVER['REQUEST_METHOD'];
        if ($method === "GET") {
            $router::views("forget",[],true);
        } else if ($method === 'POST') {
            $data = [];
            $success = false;


            $email = $model->check(post: "email")
                ->isEmail()
                ->custom($userRepo, function ($email, $userRepo, $t) {
                    $getEmail = $userRepo->getOneBy(['email' => $email])['this']->count();
                    if ($getEmail === 0) {
                        throw new Error("email is not found");
                    }
                })->getValue();


            $cpa = $model->check(post: 'cpa')
                ->isString()
                ->custom($_SESSION['cpa'], function ($cpa, $sess) {
                    if (strcmp($cpa, $sess) !== 0) {
                        throw new Error("cpa is not matched");
                    }
                });

            if ($model->errIsEmpty()) {


                //send email
//                $body = <<< EOF
//
//                    <!DOCTYPE html>
//                    <html lang="en">
//
//                    <head>
//                        <meta charset="UTF-8">
//                        <meta http-equiv="X-UA-Compatible" content="IE=edge">
//                        <meta name="viewport" content="width=device-width, initial-scale=1.0">
//                        <title>onlinestore</title>
//
//                        <style>
//                        * {
//                            padding: 0;
//                            margin: 0;
//                            box-sizing: border-box;
//                        }
//
//                        body {
//                            display: flex;
//                            flex-flow: column;
//                            align-items: center;
//                            justify-content: center;
//                            gap: 2rem;
//                        }
//
//                        a {
//                            display: inline-block;
//                            padding: 1rem 5rem;
//                            text-decoration: none;
//                            border-radius: .5rem;
//                            background: lightblue;
//                            color: #333;
//                            text-transform: capitalize;
//                            font-family: sans-serif;
//                        }
//                        </style>
//
//                    </head>
//
//                    <body>
//
//                        <h1>Hi Dr ahmedali</h1>
//                        <p>update password</p>
//                        <a href="http://localhost:5555/account/updatepassword/{$_SESSION['userData']->urlcode}">active</a>
//                    </body>
//
//                    </html>
//
//                EOF;


//                $model->sendEmail([
//                    'email' => $_SESSION['userData']->email,
//                    'name' => $_SESSION['userData']->NAME,
//                    'subject' => 'active account',
//                    'body' => $body
//                ]);
                $success = true;
                echo json_encode(['success' => true]);
            }


            echo $success ? "" : json_encode($model->getError());
            $router::views("forget",[],false);
        }


    }
}