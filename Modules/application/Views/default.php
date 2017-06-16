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
                        <h3 class="tagline">Super Museum</h3>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 pull-right text-right">
                        <div class="entrance">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#modal-login"><i class="fa fa-sign-in m-r-5" aria-hidden="true"></i>Login</a>
                            <a class="m-l-10" href="javascript:void(0)" data-toggle="modal" data-target="#modal-cadastro"><i class="fa fa-plus m-r-5" aria-hidden="true"></i>Cadastro</a>
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

        <div id="modal-login" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-sign-in m-r-5" aria-hidden="true"></i> Login</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $this->url(array('admin', 'usuario', 'login')) ?>" method="POST">
                            <div class="form-group">
                                <label for="login">Login*</label>
                                <input class="form-control" id="login" name="login">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha*</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div id="modal-cadastro" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-plus m-r-5" aria-hidden="true"></i> Cadastro</h4>
                    </div>
                    <div class="modal-body">
                        <form action="<?= $this->url(array('admin', 'usuario', 'cadastrar')) ?>" method="POST">
                            <div class="form-group">
                                <label for="nome">Nome*</label>
                                <input class="form-control" id="nome" name="nome">
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail*</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                            <div class="form-group">
                                <label for="login">Login*</label>
                                <input class="form-control" id="login" name="login">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha*</label>
                                <input type="password" class="form-control" id="senha" name="senha">
                            </div>
                            <div class="form-group">
                                <label for="confirmar">Confirmar*</label>
                                <input type="password" class="form-control" id="confirmar" name="confirmar">
                            </div>
                            <div class="text-right">
                                <button type="button" class="btn btn-sm btn-default" data-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?= $this->js('jquery-2.2.3.min') ?>
        <?= $this->js('bootstrap.min') ?>

    </body>
</html>