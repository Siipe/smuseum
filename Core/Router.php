<?php

namespace Core;

class Router
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $module;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var string
     */
    private $action;

    /**
     * @var array
     */
    private $params;

    /**
     * Atraves da URI como parametro, identifica-se o modulo, o controller, a action e os parametros
     * Router constructor.
     * @param $uri
     */
    public function __construct($uri)
    {
        $this->uri = urldecode(trim(str_replace(Config::get('project_prefix'),'', $uri), '/'));

        //Carrega os valores padrao
        $modules = Config::get('modules');
        $this->module = Config::get('default_module');
        $this->controller = Config::get('default_controller');
        $this->action = Config::get('default_action');

        $uriParts = explode('?', $this->uri);
        $pathParts = explode('/', $uriParts[0]);

        if (count($pathParts)) {

            //Modulo
            $module = strtolower(current($pathParts));
            if (in_array($module, $modules)) {
                $this->module = $module;
                array_shift($pathParts);
            }

            //Controller
            if (current($pathParts)) {
                $this->controller = strtolower(current($pathParts));
                array_shift($pathParts);
            }

            //Action
            if (current($pathParts)) {
                $this->action = strtolower(current($pathParts));
                array_shift($pathParts);
            }

            //Parametros
            $this->params = $pathParts;
        }
    }

    /**
     * Redirecionador
     * @param array $route
     * @param bool $keepRoute
     */
    public function redirect($route = null, $keepRoute = true)
    {
        header('Location: ' . $this->url($route, $keepRoute));
        exit;
    }

    /**
     * Monta uma URL de acordo com parametros passados
     * @param array|null $route
     * @param bool $keepModule
     * @return mixed|null|string
     */
    public function url($route = null, $keepModule = true)
    {
        $prefix = Config::get('project_prefix');

        if($route) {
            return $prefix . DS . implode('/', $route);
        }

        if($this->module !== Config::get('default_module') && $keepModule) {
            return $prefix . DS . $this->module;
        }

        return $prefix;
    }

    /**
     * @return string
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
}