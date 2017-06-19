<?php

namespace Core;

use Core\Exceptions\ResourceNotFoundException;

final class App
{
    /**
     * @var Router
     */
    private static $router;

    /**
     * @var Request
     */
    private static $request;

    /**
     * @var Session
     */
    private static $session;

    /**
     * @var array
     */
    private static $allowed;

    /**
     * @param string $uri
     * @throws \Throwable
     */
    public static function run($uri)
    {
        try {
            //Defini-se aqui rotas que nao requerem autenticacao
            self::$allowed = array(
                'application' => array(
                    'inicio',
                    'jogo' => array(
                        'index',
                        'visualizar'
                    )
                ),
                'admin' => array(
                    'usuario' => array(
                        'cadastrar',
                        'login',
                        'logout'
                    )
                )
            );

            self::$router = new Router($uri);

            self::$request = new Request();
            self::$session = Session::getInstance();

            //Nome do atributo guardado na Session
            Config::set('login-role', 'user-' . self::$router->getModule() . '-session');

            $controllerClass = self::assemblyControllerClass();
            if (class_exists($controllerClass)) {
                /** @var Controller $controllerObject */
                $controllerObject = new $controllerClass(self::$request, self::$session);
                self::handleAccess();
                if (method_exists($controllerObject, $action = self::$router->getAction())) {
                    $viewPath = call_user_func_array(
                        array(
                            $controllerObject,
                            $action
                        ),
                        self::$router->getParams()
                    );

                    $viewObject = new View($controllerObject->getData(), $viewPath);
                    $content = $viewObject->render();

                    if($controllerObject->isTerminal()) {
                        echo $content;
                    } else {
                        $layoutPath = ROOT . DS . 'Modules' . DS . self::$router->getModule() . DS . 'Views' . DS . 'default.php';
                        $layoutObject = new View(compact('content'), $layoutPath);
                        echo $layoutObject->render();
                    }
                } else {
                    throw new ResourceNotFoundException(sprintf('APP: Método [%s] não existe no Controller "%s"', $action, $controllerClass));
                }
            } else {
                throw new ResourceNotFoundException(sprintf('APP: O Controller [%s] não existe!', $controllerClass));
            }
        } catch (\Throwable $e) {
            if ($e instanceof ResourceNotFoundException) {
                $path = ROOT . DS . 'Modules' . DS . '404.php';
                $view = new View(array('msg' => $e->getMessage()), $path);
                echo $view->render();
            } else {
                throw $e;
            }
        }
    }

    /**
     * Monta o Controller com Namespace baseando-se no modulo de acesso
     * @return string
     */
    private static function assemblyControllerClass()
    {
        $route = self::$router->getModule();
        $controller = self::$router->getController();
        return ucfirst($route) . BS . 'Controllers' . BS . ucfirst($controller) . 'Controller';
    }

    /**
     * Responsavel por fazer o controle basico de acesso
     */
    private static function handleAccess()
    {
        if (!self::isAllowed()) {
            self::$session->unsetAttribute('last-activity');
            self::$router->redirect(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'login'));
        }
    }

    /**
     * Atraves da rota de acesso verifica-se se tem-se permissao ou nao
     * @return bool
     */
    private static function isAllowed()
    {
        //Verifica-se Controllers e Actions
        if (array_key_exists($route = self::$router->getModule(), self::$allowed) || in_array($route, self::$allowed)) {
            if (empty(self::$allowed[$route])) {
                return true;
            }
            if (array_key_exists($controller = self::getRouter()->getController(), self::$allowed[$route]) || in_array($controller, self::$allowed[$route])) {
                if (empty(self::$allowed[$route][$controller])) {
                    return true;
                }
                if (in_array(self::$router->getAction(), self::$allowed[$route][$controller])) {
                    return true;
                }
            }
        }

        //Testa a Session por ultimo
        self::$session->handleTimeout($sessionRole = Config::get('login-role'));
        return self::$session->getAttribute($sessionRole) !== null;
    }

    /**
     * @return Router
     */
    public static function getRouter()
    {
        return self::$router;
    }

    /**
     * @return Request
     */
    public static function getRequest()
    {
        return self::$request;
    }

    /**
     * @return Session
     */
    public static function getSession()
    {
        return self::$session;
    }
}