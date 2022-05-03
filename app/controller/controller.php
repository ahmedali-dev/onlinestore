<?php
session_start();
$data = array("register", 'signin', 'cpa', 'home', 'dashbord', 'forget');
foreach ($data as $value) {
    require_once __DIR__ . '/cnt/' . $value . ".php";
}

class controller
{


    use register, home, signin, cpa, dashbord, forget;




    function accept(Router $router)
    {
        require_once __DIR__ . '/../database/users.php';

        $userRepo = new userRepo;
        $url = explode('/', $router->getPath());
        $url = $url[count($url) - 1];
        $urlcode = $userRepo->getOneBy(['urlcode' => $url]);
        $count = $urlcode['this']->count();


        if ($count !== 1) {
            header("HTTP/1.0 404 Not Found");
        } else {


            $code = $userRepo->getmodel()->random(60);
            $userRepo->update(
                $urlcode['data']->id,
                [
                    'active:' => 1,
                    'urlcode:' => $code
                ]
            );
            $router->view("accept", [], true);
            header("Refres: 3s; /home");
        }
    }

    function signout()
    {
        if (isset($_SESSION)) {
            session_destroy();
            header("Location: /signin");
        } else {
            header("HTTP/0.1 404 NOT FOUND THIS PAGE");
        }
    }

    function page_404()
    {
        echo "this page not foud";
    }
}