<?php
/** @var \Admin\Models\Entities\Jogo[] $jogos */
$jogos = $data['jogos'];
?>

<div class="row">
    <div class="col-lg-12">
        <h1 class="welcome">
            Jogos
            <small>VER TODOS</small>
        </h1>
    </div>
</div>

<div class="content m-t-20">
        <?php if (empty($jogos)): ?>
            <p class="text-center">Nenhum jogo encontrado</p>
        <?php else: ?>
            <div class="row">
                <form class="navbar-form m-b-20" role="search" action="<?= $this->url(array('controller' => 'jogo')) ?>">
                    <div class="form-group">
                        <input type="text" class="form-control" id="navbar-search-input" name="pesquisa" placeholder="Pesquisar Jogo" value="<?= \Core\App::getRequest()->getGet('pesquisa') ?>">
                    </div>
                </form>
                <?php foreach ($jogos as $jogo): ?>
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="info-box">
                                <span class="info-box-icon bg-aqua"><?= $this->img($jogo->getCaminhoImagem(), array('alt' => $jogo->getNome())) ?></span>
                                <div class="info-box-content">
                                    <span class="info-box-text" title="<?= $jogo->getNome() ?>"><?= $jogo->getNome() ?></span>
                                    <span class="info-box-number ellipsis f-14" title="R$ <?= $jogo->getPrecoFormatado() ?>">R$ <?= $jogo->getPrecoFormatado() ?></span>
                                    <small class="ellipsis" title="<?= $jogo->getPlataforma() ?>">Plataforma: <?= $jogo->getPlataforma() ?></small>
                                    <div>
                                        <a href="<?= $this->url(array('controller' => 'jogo', 'action' => 'visualizar', 'id' => $jogo->getId())) ?>" title="Visualizar"><i class="fa fa-eye f-16 c-green m-r-5" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
</div>