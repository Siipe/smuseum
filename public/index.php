<?php

/**
 * Arquivo de disparo de todas as requisicoes
 * Toda e qualquer URL passa por aqui
 */

use Core\App;
use Core\View;

require_once '../vendor/autoload.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DS', DIRECTORY_SEPARATOR);
define('BS', '\\');
define('ROOT', dirname(dirname(__FILE__)));

require_once ROOT . DS . 'Config' . DS . 'config.php';

try {
    App::run($_SERVER['REQUEST_URI']);
} catch (Throwable $e) {
    $path = ROOT . DS . 'Modules' . DS . '500.php';
    $view = new View(array('msg' => $e->getMessage()), $path);
    echo $view->render();
}