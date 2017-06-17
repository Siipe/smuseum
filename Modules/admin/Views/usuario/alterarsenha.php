<section class="content-header">
    <h1 class="box-title">Alteração de <small>SENHA</small></h1>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <form role="form" method="POST">
                    <div class="box-body">
                        <div class="form-group">
                            <label>Senha atual</label>
                            <input type="password" name="senha-atual" class="form-control" placeholder="Senha atual" required autofocus />
                        </div>
                        <div class="form-group">
                            <label>Nova Senha</label>
                            <input type="password" name="nova-senha" class="form-control" placeholder="Nova Senha" required />
                        </div>
                        <div class="form-group">
                            <label>Confirmar Nova Senha</label>
                            <input type="password" name="confirmar-senha" class="form-control" placeholder="Confirmar Nova Senha" required />
                        </div>
                    </div>
                    <div class="box-footer text-right">
                        <a href="<?= $this->url() ?>" class="btn btn-sm btn-default"><i class="fa fa-home m-r-5" aria-hidden="true"></i> Home</a>
                        <input type="submit" class="btn btn-sm btn-primary" value="Salvar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>