<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="description" content="" />
        <meta name="author" content="" />

        <title>Erro interno</title>

        <?= $this->css('bootstrap.min') ?>
        <?= $this->css('custom-classes.min') ?>
        <?= $this->css('font-awesome-4.7.0/css/font-awesome.min') ?>

    </head>
    <body>
        <div class="container center-block text-center">
            <div class="row">
                <div class="span12">
                    <div class="hero-unit center p-10">
                        <h1>Ops! Ocorreu um erro interno<br /><small>Erro 500</small></h1>
                        <p class="m-t-20">
                            <strong>Mensagem:</strong>
                            &quot;<?= $data['msg'] ?>&quot;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>