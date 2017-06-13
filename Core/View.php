<?php

namespace Core;

use Exception;

class View
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var string
     */
    private $path;

    public function __construct($data = array(), $path = null)
    {
        if (!$path) {
            $path = $this->getDefaultViewPath();
        }
        if (!file_exists($path)) {
            throw new Exception(sprintf('VIEW: Não há nenhum Template definido para "%s"!', $path));
        }

        $this->data = $data;
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function render()
    {
        $data = $this->data;

        ob_start();
        include $this->path;
        $content = ob_get_clean();

        return $content;
    }

    /**
     * @return string
     * @throws Exception
     */
    private function getDefaultViewPath()
    {
        $router = App::getRouter();
        if (!$router)
            throw new Exception('VIEW: Classe Router indisponível!');

        $controllerDir = $router->getController();
        $viewFile = $router->getAction() . '.php';

        return ROOT . DS . 'Modules' . DS . $router->getModule() . DS . 'Views' . DS . $controllerDir . DS . $viewFile;
    }

    /**
     * Carrega arquivos CSS
     * Usado em Views
     * @param string $filePath
     * @param bool $pathOnly
     * @return string
     * @throws Exception
     */
    private function css($filePath = '', $pathOnly = false)
    {
        if (!$filePath)
            throw new Exception('VIEW CSS: Você deve fornecer um nome!');

        if (!$pathOnly) {
            if (strpos($filePath,'.css') == false) {
                $filePath .= '.css';
            }
            $fullPath = Config::get('project_prefix') . DS . 'public' . DS . 'css' . DS . $filePath;
        } else {
            $fullPath = $filePath;
        }

        return sprintf('<link rel="stylesheet" href="%s" />', $fullPath) . PHP_EOL;
    }

    /**
     * Carrega arquivos JavaScript
     * Usado em Views
     * @param string $filePath
     * @param bool $pathOnly
     * @return string
     * @throws Exception
     */
    private function js($filePath = '', $pathOnly = false)
    {
        if (!$filePath)
            throw new Exception('VIEW JS: Você deve fornecer um nome!');

        if (!$pathOnly) {
            if (strpos($filePath,'.js') == false) {
                $filePath .= '.js';
            }
            $fullPath = Config::get('project_prefix') . DS . 'public' . DS . 'js' . DS . $filePath;
        } else {
            $fullPath = $filePath;
        }

        return sprintf('<script src="%s"></script>', $fullPath) . PHP_EOL;
    }

    /**
     * Carrega imagens
     * Usado em Views
     * @param string $filePath
     * @param array $attributes
     * @param bool $pathOnly
     * @param bool $noImgTag
     * @return string
     * @throws Exception
     */
    private function img($filePath = '', $attributes = array(), $pathOnly = false, $noImgTag = false)
    {
        if (!$filePath)
            throw new Exception('VIEW IMG: Você deve fornecer um nome!');

        if (!$pathOnly) {
            $fullPath = Config::get('project_prefix') . DS . 'public' . DS . 'img' . DS . $filePath;
        } else {
            $fullPath = $filePath;
        }

        if($noImgTag)
            return $fullPath;

        $attrs = '';
        foreach ($attributes as $key => $value) {
            $attrs .= ' ' . $key . '="' . $value . '" ';
        }

        return sprintf('<img src="%s" %s />', $fullPath, $attrs) . PHP_EOL;
    }

    /**
     * Pega o usuario da Sessao
     * @return mixed|null
     */
    private function getUserSession()
    {
        return App::getSession()->getAttribute(Config::get('login-role'));
    }

    /**
     * Monta uma URL
     * @param array $route
     * @param bool $keepModule
     * @return string
     */
    private function url($route = null, $keepModule = true) {
        return App::getRouter()->url($route, $keepModule);
    }

    /**
     * @return mixed|null
     */
    private function getTitle() {
        return Config::get('title');
    }
}