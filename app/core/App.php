<?php
// app/core/App.php
class App
{
    protected $controller = 'HomeController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        // CONTROLLER
        if (!empty($url[0])) {
            $controllerName = ucfirst($url[0]) . 'Controller';
            $controllerPath = '../app/controllers/' . $controllerName . '.php';

            if (file_exists($controllerPath)) {
                $this->controller = $controllerName;
                unset($url[0]);
            } else {
                $this->load404();
                return;
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // METHOD
        if (isset($url[1])) {
            $method = $this->formatMethod($url[1]);

            if (method_exists($this->controller, $method)) {
                $this->method = $method;
                unset($url[1]);
            } else {
                $this->load404();
                return;
            }
        }

        // PARAMS
        $this->params = $url ? array_values($url) : [];

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    protected function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }

    protected function formatMethod($method)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $method))));
    }

    protected function load404()
    {
        require_once '../app/controllers/ErrorsController.php';
        $controller = new ErrorsController();
        $controller->notFound();
    }
}
