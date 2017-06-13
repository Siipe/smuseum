<?php

namespace Core;

class Request
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var array
     */
    private $post;

    /**
     * @var array
     */
    private $get;

    /**
     * @var array
     */
    private $files;

    public function __construct()
    {
        $this->type = $_SERVER['REQUEST_METHOD'];
        $this->post = $_POST;
        $this->get = $_GET;
        $this->files = $_FILES;
    }

    /**
     * Identifica a requisicao atraves do parametro passado
     * @param $arg
     * @return bool
     */
    public function is($arg)
    {
        if (is_array($arg)) {
            $ajax = false;
            if (array_key_exists('ajax', $arg)) {
                $ajax = $this->isAjax();
            }
            return in_array(strtolower($this->type), $arg) || $ajax;
        }
        return $arg == 'ajax' ? $this->isAjax() : strtolower($this->type) == $arg;
    }

    /**
     * Recupera dados enviados via POST
     * @param null $name
     * @return array|null
     */
    public function getPost($name = null)
    {
        if ($name) {
            if (isset($this->post[$name])) {
                return $this->post[$name];
            }
            return null;
        }
        return $this->post;
    }

    /**
     * Recupera dados enviados via GET
     * @param null $name
     * @return array|null
     */
    public function getGet($name = null)
    {
        if ($name) {
            if (isset($this->get[$name])) {
                return $this->get[$name];
            }
            return null;
        }
        return $this->get;
    }

    /**
     * Recupera arquivos enviados
     * @param null $name
     * @return array|null
     */
    public function getFiles($name = null)
    {
        if ($name) {
            if (isset($this->files[$name])) {
                return $this->files[$name];
            }
            return null;
        }
        return $this->files;
    }

    /**
     * Identifica a requisicao em caso de XMLHTTPRequest
     * @return bool
     */
    private function isAjax()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }
}