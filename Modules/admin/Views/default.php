<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= $this->getTitle() ?></title>

        <?= $this->css('bootstrap.min') ?>
        <?= $this->css('font-awesome-4.7.0/css/font-awesome.min') ?>
        <?= $this->css('business-frontpage') ?>
        <?= $this->css('custom-classes.min') ?>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <?= $this->js('https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', true) ?>
        <?= $this->js('https://oss.maxcdn.com/respond/1.4.2/respond.min.js', true) ?>
        <![endif]-->
    </head>
    <body>
        <header class="business-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <h3 class="tagline">Área do Usuário</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 pull-right text-right">
                        <div class="entrance">
                            <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'perfil'), true) ?>"><?= $this->getUserSession()['name'] ?></a>
                            <a class="m-l-10" href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'logout'), true) ?>"><i class="fa fa-sign-out m-r-5" aria-hidden="true"></i>Sair</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <nav class="navbar navbar-inverse" role="navigation" data-spy="affix" data-offset-top="197">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li>
                            <a href="<?= $this->url() ?>"><i class="fa fa-home m-r-5" aria-hidden="true"></i> Home</a>
                        </li>
                        <li>
                            <a href="<?= $this->url() ?>"><i class="fa fa-user m-r-5" aria-hidden="true"></i> Meu Perfil</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-rocket m-r-5" aria-hidden="true"></i> Jogos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container">
            <?php include ROOT . DS . 'Modules' . DS . 'flash.php' ?>
        </div>

        <div class="container">
            <?= $data['content'] ?>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-left">&copy; <?= date('Y') ?> - All Rights Reserved, CES-JF</div>
                </div>
            </div>
        </footer>

        <?= $this->js('jquery-2.2.3.min') ?>
        <?= $this->js('bootstrap.min') ?>

    </body>
</html>