<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        <title><?= \Core\Config::get('title') ?></title>

        <?= $this->css('bootstrap.min') ?>
        <?= $this->css('font-awesome-4.7.0/css/font-awesome.min') ?>
        <?= $this->css('AdminLTE.min') ?>
        <?= $this->css('_all-skins.min') ?>
        <?= $this->css('custom-classes.min') ?>
        <?= $this->css('seven') ?>
        <?= $this->css('cropper') ?>

        <?= $this->js('jquery-2.2.3.min') ?>
        <?= $this->js('bootstrap.min') ?>
        <?= $this->js('bootbox') ?>
        <?= $this->js('jquery.slimscroll.min') ?>
        <?= $this->js('app.min') ?>
        <?= $this->js('demo') ?>
        <?= $this->js('seven') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?= $this->js('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', true) ?>
        <?= $this->js('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', true) ?>
        <![endif]-->
    </head>
    <body class="hold-transition skin-purple-light layout-top-nav fixed">
        <div class="wrapper">

            <header class="main-header">
                <nav class="navbar navbar-static-top">
                    <div class="container">
                        <div class="navbar-header">
                            <a href="<?= $this->url() ?>" class="navbar-brand"><b>Smuseum</b> Admin</a>
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                                <i class="fa fa-bars"></i>
                            </button>
                        </div>

                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                            <ul class="nav navbar-nav">
                                <li><a href="<?= $this->url() ?>"><i class="fa fa-home m-r-5" aria-hidden="true"></i> Home</a></li>
                                <li><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario')) ?>"><i class="fa fa-user m-r-5" aria-hidden="true"></i> Membros</a></li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-rocket m-r-5" aria-hidden="true"></i> Jogos <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>">Ver todos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'inserir')) ?>">Inserir</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-cart-plus m-r-5" aria-hidden="true"></i> Compras <span class="caret"></span></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra')) ?>">Ver todos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho')) ?>">Carrinho</a></li>
                                    </ul>
                                </li>
                            </ul>
                            <form class="navbar-form navbar-left" role="search" action="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="navbar-search-input" name="pesquisa" placeholder="Pesquisar Jogo" value="<?= \Core\App::getRequest()->getGet('pesquisa') ?>">
                                </div>
                            </form>
                        </div>
                        <div class="navbar-custom-menu">
                            <ul class="nav navbar-nav">
                                <li class="dropdown user user-menu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li class="user-header">
                                            <i class="fa fa-user fa-4x c-white" aria-hidden="true"></i>
                                            <p><?= $this->getUserSession()['name'] ?></p>
                                            <p class="f-12">Desde <?= $this->getUserSession()['date'] ?></p>
                                        </li>
                                        <li class="user-body">
                                            <div class="row">
                                                <div class="col-xs-6 text-center">
                                                    <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'alterarsenha')) ?>"><i class="fa fa-key m-r-5" aria-hidden="true"></i> Alterar Senha</a>
                                                </div>
                                                <div class="col-xs-6 text-center">
                                                    <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'logout')) ?>"><i class="fa fa-sign-out m-r-5" aria-hidden="true"></i> Sair</a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </header>
            <div class="content-wrapper">
                <div class="container m-t-5">
                    <?php include ROOT . DS . 'Modules' . DS . 'flash.php' ?>
                    <?= $data['content'] ?>
                </div>
            </div>
            <footer class="main-footer">
                <div class="container">
                    &copy; <?= date('Y') ?> - All Rights Reserved, CES-JF
                </div>
            </footer>
        </div>
        <div id="seven-loading">
            <div class="loading-overlay animationload"></div>
            <div class="loading-icon osahanloading"></div>
        </div>
    </body>
</html>