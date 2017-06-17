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
        <?= $this->css('login') ?>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
                    <h1 class="text-center login-title">Venha e faça parte!</h1>

                    <?php include ROOT . DS . 'Modules' . DS . 'flash.php' ?>

                    <div class="account-wall">
                        <form class="form-signin" action="<?= $this->url(array('admin', 'usuario', 'cadastrar')) ?>" method="POST">
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
                                <a href="<?= $this->url(array(), false) ?>" class="btn btn-sm btn-default"><i class="fa fa-home m-r-5" aria-hidden="true"></i> Home</a>
                                <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-send m-r-5" aria-hidden="true"></i> Enviar</button>
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