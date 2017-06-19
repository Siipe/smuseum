<?php
/** @var \Admin\Models\Entities\Usuario $usuario */
$usuario = $this->data['usuario'];
?>

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
                    <h1 class="text-center login-title">Autenticação</h1>

                    <?php include ROOT . DS . 'Modules' . DS . 'flash.php' ?>

                    <div class="account-wall">
                        <form class="form-signin" action="<?= $this->url(array('admin', 'usuario', 'login')) ?>" method="POST">
                            <div class="form-group">
                                <label for="login">Login*</label>
                                <input class="form-control" id="login" name="login" value="<?= $usuario->getLogin() ?>" required autofocus/>
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha*</label>
                                <input type="password" class="form-control" id="senha" name="senha_criptografada" required />
                            </div>
                            <div class="text-right">
                                <a href="<?= $this->url(array(), false) ?>" class="btn btn-sm btn-default"><i class="fa fa-home m-r-5" aria-hidden="true"></i> Home</a>
                                <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'usuario', 'action' => 'cadastrar')) ?>" class="btn btn-sm btn-success"><i class="fa fa-plus m-r-5" aria-hidden="true"></i> Cadastro</a>
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