<?php
/** @var \Admin\Models\Entities\Compra $compra */
$compra = $data['compra'];
?>
<section class="content-header">
    <h1>
        Compra
        <small>VISUALIZAR</small>
    </h1>
</section>
<section class="content">
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <span class="info-box-number f-24"><?= $compra->getDataInclusaoFormatada() ?></span>
                <span class="info-box-number">Total: R$ <?= $compra->calcularTotal(true) ?></span>
            </div>
        </div>
        <div class="box-body">
            <div class="attachment-block clearfix">
                <h4 class="attachment-heading c-blue"><strong><?= sprintf('Itens da Compra (%s)', count($compra->getItens())) ?></strong></h4>
                <div class="row m-t-10">
                <?php foreach ($compra->getItens() as $item): ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-aqua"><?= $this->img($item->getJogo()->getCaminhoImagem(), array('alt' => $item->getJogo()->getNome())) ?></span>
                            <div class="info-box-content">
                                <span class="info-box-text" title="<?= $item->getJogo()->getNome() ?>"><?= $item->getJogo()->getNome() ?></span>
                                <span class="info-box-number f-14">R$ <?= $item->getPrecoFormatado() ?></span>
                                <div>
                                    <small>Plataforma: <?= $item->getJogo()->getPlataforma() ?></small>
                                </div>
                                <div>
                                    <small>Quantidade: <?= $item->getQuantidade() ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
            <div class="text-right">
                <a class="btn btn-sm btn-default" href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra')) ?>">Voltar</a>
            </div>
        </div>
    </div>
</section>