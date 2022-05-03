<?php



// include("..\\app\\database\\database.php");
// include("..\\app\\database\\users.php");
// $db = new userRepo();
// $model = $db->getmodel();
// echo "<pre>";
// print_r($db->getAllLimit());
// echo "</pre>";
// // $rand = new model;
// $db->query("select * from register where id = ?");
// $db->bind(1, "17d5f29153f128deebb2eacc97f5ede0");
// $db->exc();
// $data = $db->only();
// var_dump($data);

// $count = 0;
// while ($count <pre 30) {
//     $count++;
//     $bool = $db->create([
//         "name" => $db::getmodel()->random(12),
//         "email" => $db::getmodel()->random(12) . "@gmail.com",
//         "pass" => $db::getmodel()->random(12)
//     ]);

//     if ($bool['bool']) {
//         echo "created";
//         var_dump($bool['this']->getAll());
//     }
// }

// echo "<pre>";
// print_r();
// echo "</pre>";

// echo json_encode($db->getAll()['data']);
// print_r($db->getOneBy(['email' => "wXg0Q7Klobza@gmail.com"])['this']->count());
// $delete = $db->delete("!uTKrZEGq8!JEtOs3sGw4cEDqoP!RF7APOdSo0665WQfuegCXSv39pVX!iJo");
// if ($delete) {
//     echo "deleted";
// }


// echo "<pre>";
// print_r($db->getAll()['count'] / 10);
// echo "</pre>";

// echo "<pre>";
// print_r($db->getAllLimit());
// echo "</pre>";

// $lg = $db->createLogin("!yrUChM5EcBzeaB6o1E1JmvQs5aclBmd85gpyw2uakvIYiMS0Jnx0XiDqZi0");
// if ($lg['bool']) {
//     echo "inserted";
// }

// $lg = $db->updateLogin("!yrUChM5EcBzeaB6o1E1JmvQs5aclBmd85gpyw2uakvIYiMS0Jnx0XiDqZi0", "::1");
// if ($lg['bool']) {
//     echo "<pre>";
//     print_r($lg['this']->getOneByLogin($lg['data'][0], $lg['data'][1])['this']->only());
//     echo "</pre>";
// }

// print_r($lg['this']->getmodel()->get_client_ip());

// $email = $db->getmodel()->check(get: "email")->isEmail()->getBodyReq()['value'];

// $pass = $db->getmodel()->check(get: "password")->isString()->isLength(['max' => 32, 'min' => 4], "pass 4 to 32 char")
//     ->custom($email, function ($pass, $email) {
//         $passw = '1234567';
//         // echo $pass;
//         if ($pass !== $passw) {
//             throw new Error("password not match");
//         }
//     })
//     ->getReq();

// // var_dump($pass);

// if ($model->errIsEmpty()) echo "error is empty";
// var_dump($db->getmodel()->getError());

include("../app/router/router.php");
include("../app/controller/controller.php");

$router = new Router();
$controller = new controller();


// ? home
$router->get("/home", [$controller, 'home']);
$router->get("/", [$controller, 'home']);
$router->get("/page-404", [$controller, 'page_404']);



//register
$router->get('/register', [$controller, 'register']);
$router->post('/register', [$controller, 'register']);



//signin
$router->get('/signin', [$controller, 'signin']);
$router->post('/signin', [$controller, 'signin']);


//forget pass
$router->get('/forget', [$controller, 'forget']);
$router->post('/forget', [$controller, 'forget']);


//cpa
$router->get('/cpa', [$controller, 'cpa']);


// ! logout
$router->get("/signout", [$controller, 'signout']);










// ! ****************************** admin

// ? dashbord
$router->get("/admin/dashbord", [$controller, 'dashbord']);


//account/accept
$router->get('/account/accept/{id}', [$controller, 'accept'], function ($t, $url) {
    require_once __DIR__ . '/../app/models/model.php';
    $model = new model;
    $path = $model->getpath($t, $url);
    return $path;
});

// $router->vardump($_SERVER);

$router->render();