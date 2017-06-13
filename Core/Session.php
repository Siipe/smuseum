<?php

namespace Core;

class Session
{
    const SESSION_NOT_STARTED = FALSE;

    /**
     * Estado da Sessao
     * @var bool
     */
    private $sessionState = self::SESSION_NOT_STARTED;

    /**
     * Padrao Singleton
     * @var Session
     */
    private static $instance;

    private function __construct()
    {
        $this->start();
    }

    /**
     * @return Session
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Guarda na Sessao o atributo com seu respectivo valor
     * @param $name
     * @param $value
     * @return Session
     */
    public function setAttribute($name, $value)
    {
        $_SESSION[$name] = $value;
        return $this;
    }

    /**
     * Retira um ou mais atributos da Sessao
     * @param string $name
     * @return Session
     */
    public function unsetAttribute($name)
    {
        if (is_array($name)) {
            foreach ($name as $item) {
                unset($_SESSION[$item]);
            }
        } else {
            unset($_SESSION[$name]);
        }
        return $this;
    }

    /**
     * @param $name
     * @return null|mixed
     */
    public function getAttribute($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        }
        return null;
    }

    /**
     * @return bool
     */
    public function destroy()
    {
        if ($this->sessionState != self::SESSION_NOT_STARTED) {
            $this->sessionState = !session_destroy();
            unset($_SESSION);

            return !$this->sessionState;
        }

        return false;
    }

    /**
     * Handles Session timeout
     * @param string $sessionRole
     */
    public function handleTimeout($sessionRole)
    {
        if ($role = $this->getAttribute($sessionRole)) {
            $time = $_SERVER['REQUEST_TIME'];
            $lastActivity = $this->getAttribute('last-activity');
            if ($lastActivity && ($time - $lastActivity) > Config::get('default_session_timeout')) {
                $this->destroy();
                $this->start();

                $msg = array(
                    'message' => 'Sua Sessão expirou! Faça o Login novamente.',
                    'cssClass' => 'alert-info'
                );
                $this->setAttribute('flash-message', $msg);
            }
            $this->setAttribute('last-activity', $time);
        }
    }

    /**
     * Starts the Session
     */
    private function start()
    {
        if ($this->sessionState == self::SESSION_NOT_STARTED) {
            $this->sessionState = session_start();
        }
    }
}