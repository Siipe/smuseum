<?php

namespace Core;

class Controller
{
    /**
     * Valores para armazenar-se para as Views
     * @var string|array
     */
    private $data;

    /**
     * Determina se a pagina solicitada ira herdar do layout padrao
     * @var bool
     */
    private $terminal = false;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    /**
     * Controller constructor.
     * @param $request Request
     * @param $session Session
     */
    public function __construct($request, $session)
    {
        $this->request = $request;
        $this->session = $session;
    }

    /**
     * Responsavel por armazenar atributos para as Views
     * @param $key
     * @param null $value
     * @return $this
     */
    protected function set($key, $value = null)
    {
        if (is_array($key)) {
            $this->data = $key + $this->data;
        } else {
            $this->data[$key] = $value;
        }
        return $this;
    }

    /**
     * Guarda mensagens na Session para serem exibidas nas Views
     * @param $message string
     * @param $cssClass string
     */
    protected function setMessage($message, $cssClass)
    {
        $msg = array(
            'message' => $message,
            'cssClass' => $cssClass
        );
        App::getSession()->setAttribute('flash-message', $msg);
    }

    /**
     * Retona uma instancia do Service solicitado
     * @param $service
     * @return mixed
     * @throws \Exception
     */
    protected function getService($service)
    {
        if(class_exists($service)) {
            return new $service($this->getUserSession());
        }
        throw new \Exception(sprintf('Service "%s" does not exist!'));
    }

    /**
     * Metodo responsavel por exibir a pagina sem aproveitar o template
     * Utilizada normalmente em paginas de Login
     * @return $this
     */
    protected function setTerminal()
    {
        $this->terminal = true;
        return $this;
    }

    /**
     * Metodo redirecionador
     * @param null $route
     * @param bool $keepRoute
     */
    protected function redirect($route = null, $keepRoute = true)
    {
        App::getRouter()->redirect($route, $keepRoute);
    }

    /**
     * Pega o usuario da Sessao
     * @return mixed|null
     */
    protected function getUserSession()
    {
        return $this->session->getAttribute(Config::get('login-role'));
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isTerminal()
    {
        return $this->terminal;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return Session
     */
    public function getSession()
    {
        return $this->session;
    }
}