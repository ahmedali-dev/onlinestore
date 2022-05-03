<?php
class Router
{

    private array $getArray = [];
    private array $postArray = [];


    function getPath(): string
    {
        if (strpos($_SERVER['REQUEST_URI'], "?")) {
            $path = substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], "?")) ?? '/';
        } else {
            $path = substr($_SERVER['REQUEST_URI'], 0) ?? '/';
        }

        return $path;
    }


    function get($url, $fn, $callback = '')
    {
        if ($callback) {
            $url = $callback($this, $url);
        }
        $this->getArray[$url] = $fn;
    }

    function post($url, $fn, $callback = '')
    {
        if ($callback) {
            $url = $callback($this, $url);
        }
        $this->postArray[$url] = $fn;
    }

    public function vardump($info)
    {
        echo '<pre>';
        // print_r($this->get);
        // print_R($this->post);
        print_r($info);
        echo '</pre>';
    }

    function render(): void
    {

        $path = self::getPath();
        $method = $_SERVER['REQUEST_METHOD'];
        $upper = function ($n) {
            return strtoupper($n);
        };
        if ($method === $upper("get")) {
            $fn = $this->getArray[$path] ?? null;
        } else if ($method === $upper("post")) {
            $fn = $this->postArray[$path] ?? null;
        }


        if ($fn) {
            call_user_func_array(array($fn[0], $fn[1]), array($this));
        } else {
            header("Location: /page-404");
        }
    }


    function view($view, $data = [], bool $html): void
    {
        if ($html) {
            ob_start();
            require_once __DIR__ . '/../views/' . $view . ".php";
            $content = ob_get_clean();
            require_once  __DIR__ .  '/../views/inc/layout.php';
        } else {
            // require_once __DIR__ . '/../views/' . $view . ".php";
        }
    }

    static function views($view, $data = [], bool $html=true): void
    {
        if ($html) {
            ob_start();
            require_once __DIR__ . '/../views/' . $view . ".php";
            $content = ob_get_clean();
            require_once  __DIR__ .  '/../views/inc/layout.php';
        } else {
            // require_once __DIR__ . '/../views/' . $view . ".php";
        }
    }
}