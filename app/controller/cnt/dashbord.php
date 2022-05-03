<?php
trait dashbord
{
    function dashbord(Router $router)
    {
        echo "hello world";
        $router->view("index", [], true);
    }
}