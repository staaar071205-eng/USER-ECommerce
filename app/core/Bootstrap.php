<?php

namespace App\Core;

class Bootstrap
{
    public function __construct()
    {
        $url = $_GET['page'] ?? $this->getRequestUri();

        // Jika ada URL yang diakses
        if ($url) {
            // Filter dan bersihkan URL
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = trim($url, '/');
            $url = explode('/', $url);

            // Uppercase huruf pertama dan ambil bagian pertama sebagai nama controller
            $page = ucfirst(array_shift($url));


            if (file_exists(ROOT . "app/controllers/" . $page . ".php")) {
                $class = "App\\Controllers\\" . $page;
                $controller = new $class;

         
                $action = $url ? array_shift($url) : 'index';

        
                if (is_callable([$controller, $action])) {
           
                    $params = array_values($url);
                    call_user_func_array([$controller, $action], $params);
                } else {
                    $controller->index();
                }
            } else {

                $class = "App\\Core\\Error";
                $controller = new $class();
                $controller->fileNotFound();
            }
        } else {
     
            $class = "App\\Controllers\\Index";
            $controller = new $class();
            $controller->index();
        }
    }

    private function getRequestUri()
    {
        $uri = $_SERVER['REQUEST_URI'];

        $uri = parse_url($uri, PHP_URL_PATH);

        $uri = rawurldecode($uri);

        $base = rtrim(str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'])), '/');
        if ($base !== '' && stripos($uri, $base) === 0) {
            $uri = substr($uri, strlen($base));
        }

        return trim($uri, '/');
    }
}
