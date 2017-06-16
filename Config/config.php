<?php

use Core\Config;

//Diretorio principal do projeto
Config::set('project_prefix', '/smuseum');

//Titulo padrao do sistema
Config::set('title', 'Trabalho CES');


//Modulos disponiveis
Config::set('modules', array(
    'application',
    'admin'
));

//Modulo padrao
Config::set('default_module', 'application');

//Controller padrao
Config::set('default_controller', 'inicio');

//Action padrao
Config::set('default_action', 'index');

//Tempo padrao de expiracao da Sessao
Config::set('default_session_timeout', 600);

//Parametros de conexao com o BD
Config::set('db', array(
    'dsn' => 'mysql:dbname=smuseum;host=127.0.0.1',
    'user' => 'root',
    'password' => 'feniX123'
));