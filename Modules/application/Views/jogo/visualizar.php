<?php
/** @var \Admin\Models\Entities\Jogo $jogo */
$jogo = $data['jogo'];
?>
<div class="row">
    <div class="col-lg-12">
        <h1 class="welcome">
            Jogo
            <small>VISUALIZAR</small>
        </h1>
    </div>
</div>
<section class="content m-t-20">
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <?= $this->img($jogo->getCaminhoImagem(), array('alt' => $jogo->getNome())) ?>
                <span class="username f-24"><?= $jogo->getNome() ?></span>
                <span class="info-box-number">R$ <?= $jogo->getPrecoFormatado() ?></span>
                <span class="description">Plataforma: <?= $jogo->getPlataforma() ?></span>
                <span class="description">Adicionado em <?= $jogo->getDataInclusaoFormatada() ?></span>
            </div>
        </div>
        <div class="box-body">
            <div class="attachment-block clearfix">
                <h4 class="attachment-heading c-blue"><strong>Sobre o jogo</strong></h4>
                <div class="attachment-text">
                    <?= $jogo->getDescricao() ?>
                </div>
            </div>
            <div class="text-right">
                <a class="btn btn-sm btn-default" href="<?= $this->url(array('controller' => 'jogo')) ?>">Voltar</a>
            </div>
        </div>
    </div>
</section>