<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?= \Core\Config::get('title') ?></title>

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
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="http://www.sistemacei.com.br/site/default.asp">
                        <i class="fa fa-home" aria-hidden="true"></i>
                        Site oficial
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav pull-right">
                        <li>
                            <a href="#"><i class="fa fa-cogs" aria-hidden="true"></i> Administração</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <header class="business-header">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h3 class="tagline">Portal Acadêmico</h3>
                    </div>
                </div>
            </div>
            <div class="container subscriptions">
                <div class="row">
                    <div class="col-lg-6 pull-right text-right">
                        <h4>
                            <a href="#">
                                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                                Inscrições abertas
                            </a>
                        </h4>
                    </div>
                </div>
            </div>
        </header>

        <div class="container">
            <?= $data['content'] ?>
        </div>

        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 text-left">&copy; <?= date('Y') ?> - All Rights Reserved, MITHSAN CONSULTORIA E SISTEMAS</div>
                    <div class="col-lg-6 col-md-6 col-sm-6 text-right">
                        <a href="http://www.mithsan.com.br/site" target="_blank">
                            <i class="fa fa-external-link" aria-hidden="true"></i>
                            MithSan WEB
                        </a>
                    </div>
                </div>
            </div>
        </footer>

        <?= $this->js('jquery-2.2.3.min') ?>
        <?= $this->js('bootstrap.min') ?>

    </body>
</html>