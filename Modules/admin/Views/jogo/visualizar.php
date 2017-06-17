<?php
/** @var \Admin\Models\Entities\Jogo $jogo */
$jogo = $data['jogo'];
?>
<section class="content-header">
    <h1>
        Jogo
        <small>VISUALIZAR</small>
    </h1>
</section>
<section class="content">
    <div class="box box-widget">
        <div class="box-header with-border">
            <div class="user-block">
                <?= $this->img($jogo->getCaminhoImagem(), array('alt' => $jogo->getNome())) ?>
                <span class="username f-24"><?= $jogo->getNome() ?></span>
                <span class="info-box-number">R$ <?= $jogo->getPrecoFormatado() ?></span>
                <span class="description">Plataforma: <?= $jogo->getPlataforma() ?></span>
                <span class="description">Adicionado em <?= $jogo->getDataInclusaoFormatada() ?> por <?= $jogo->getUsuario()->getNome() ?></span>
            </div>
        </div>
        <div class="box-body">
            <div class="attachment-block clearfix">
                <h4 class="attachment-heading c-blue"><strong>Sobre o jogo</strong></h4>
                <div class="attachment-text">
                    <?= $jogo->getDescricao() ?>
                </div>
            </div>
            <div>
                <a href="javascript:void(0)" onclick="adicionarAoCarrinho('<?= $jogo->getId() ?>', '<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho', 'action' => 'adicionar')) ?>')" title="Adicionar ao carrinho"><i class="fa fa-cart-plus m-r-5 fa-2x c-purple" aria-hidden="true"></i></a>
                <?php if ($jogo->getIdUsuarioInclusao() == $this->getUserSession()['id']): ?>
                    <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'editar', 'id' => $jogo->getId())) ?>" title="Editar"><i class="fa fa-edit fa-2x m-r-5" aria-hidden="true"></i></a>
                    <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'excluir', 'id' => $jogo->getId())) ?>" title="Excluir"><i class="fa fa-trash fa-2x c-red m-r-5" aria-hidden="true"></i></a>
                <?php endif; ?>
            </div>
            <div class="text-right">
                <a class="btn btn-sm btn-default" href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>">Voltar</a>
            </div>
        </div>
    </div>
</section>