<section class="content-header">
    <h1>
        Jogo
        <small>INSERIR</small>
    </h1>
</section>
<section class="content">
    <div class="box box-primary">
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="nome">Nome*</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome" autofocus required>
                </div>
                <div class="form-group">
                    <label for="plataforma">Plataforma*</label>
                    <input type="text" class="form-control" id="plataforma" name="plataforma" placeholder="Plataforma" required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea id="descricao" class="form-control" rows="4" name="descricao" placeholder="Descrição" required></textarea>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="number" class="form-control" id="preco" name="preco" placeholder="Preço" required>
                </div>
                <div class="form-group">
                    <label for="imagem">Imagem</label>
                    <div id="image-thumbnail"></div>
                    <div>
                        <a href="javascript:void(0)" id="update-image">Clique para selecionar</a>
                    </div>
                </div>
            </div>
            <div class="box-footer text-right">
                <input name="cropped" type="hidden" id="cropped-image-data" />
                <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>" class="btn btn-sm btn-default">Cancelar</a>
                <button type="submit" class="btn btn-sm btn-primary">Enviar</button>
            </div>
        </form>
    </div>
</section>

<div id="modal-cropper" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" id="cropper-container">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-plus m-r-5" aria-hidden="true"></i> Preparação da Imagem</h4>
            </div>
            <div class="modal-body">
                <input type="file" style="display: none" id="browse-image" accept="image/x-png, image/jpeg" />
                <div class="crop">
                    <div class="overlay">
                        <div class="overlay-inner"></div>
                    </div>
                </div>
                <div class="text-center m-t-10">
                    <button class="btn btn-sm btn-default cancel-modal">Cancelar</button>
                    <button class="btn btn-sm btn-primary js-crop">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->js('cropper') ?>