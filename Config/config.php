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
    'host' => 'mithsan9.mysql.dbaas.com.br',
    'user' => 'mithsan9',
    'password' => 'mudar123',
    'dbname' => 'mithsan9'
));