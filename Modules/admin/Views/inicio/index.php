<?php
/** @var \Admin\Models\Entities\Compra $compra */
$compra = $data['compra'];

/** @var \Admin\Models\Entities\Jogo $jogo */
$jogo = $data['jogo'];
?>
<section class="content-header">
    <div class="col-lg-12">
        <h3 class="welcome">Olá, <?= explode(' ', $this->getUserSession()['name'])[0] ?>!</h3>
    </div>
</section>
<section class="content">
    <div class="col-lg-6 col-xs-12">
        <h3><small class="text-uppercase">Sua última compra</small></h3>
        <?php if ($compra): ?>
            <div class="small-box bg-light-blue-gradient">
                <div class="inner">
                    <h3>
                        R$ <?= $compra->calcularTotal(true) ?>
                        <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra', 'action' => 'visualizar', 'id' => $compra->getId())) ?>" title="Visualizar"><i class="fa fa-eye c-white f-24" aria-hidden="true"></i></a>
                    </h3>
                    <p><?= sprintf('%s, realizada em %s', count($compra->getItens()) > 1 ? count($compra->getItens()) . ' itens' : '1 item', $compra->getDataInclusaoFormatada()) ?></p>
                </div>
                <div class="icon">
                    <i class="fa fa-cart-plus"></i>
                </div>
                <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra')) ?>" class="small-box-footer">
                    Ver todas <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        <?php else: ?>
            <p>Você ainda não comprou aqui no site!</p>
        <?php endif; ?>
    </div>
    <div class="col-lg-6 col-xs-12">
        <h3><small class="text-uppercase">Seu último jogo</small></h3>
        <?php if ($jogo): ?>
            <div class="info-box">
                <span class="info-box-icon bg-aqua"><?= $this->img($jogo->getCaminhoImagem(), array('alt' => $jogo->getNome())) ?></span>

                <div class="info-box-content">
                    <span class="info-box-text" title="<?= $jogo->getNome() ?>"><?= $jogo->getNome() ?></span>
                    <span class="info-box-number ellipsis f-14" title="R$ <?= $jogo->getPrecoFormatado() ?>">R$ <?= $jogo->getPrecoFormatado() ?></span>
                    <small class="ellipsis" title="<?= $jogo->getPlataforma() ?>">Plataforma: <?= $jogo->getPlataforma() ?></small>
                    <div>
                        <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'visualizar', 'id' => $jogo->getId())) ?>" title="Visualizar"><i class="fa fa-eye f-16 c-green m-r-5" aria-hidden="true"></i></a>
                        <a href="javascript:void(0)" onclick="adicionarAoCarrinho('<?= $jogo->getId() ?>', '<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho', 'action' => 'adicionar')) ?>')" title="Adicionar ao carrinho"><i class="fa fa-cart-plus m-r-5 c-purple" aria-hidden="true"></i></a>
                        <?php if ($jogo->getIdUsuarioInclusao() == $this->getUserSession()['id']): ?>
                            <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'editar', 'id' => $jogo->getId())) ?>" title="Editar"><i class="fa fa-edit f-16 m-r-5" aria-hidden="true"></i></a>
                            <a data-message="<?= sprintf('Deseja excluir o jogo <strong>%s</strong>?', $jogo->getNome()) ?>" class="confirm" href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo', 'action' => 'excluir', 'id' => $jogo->getId())) ?>" title="Excluir"><i class="fa fa-trash f-16 c-red m-r-5" aria-hidden="true"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>" class="small-box-footer">
                Ver todos <i class="fa fa-arrow-circle-right"></i>
            </a>
        <?php else: ?>
            <p>Você ainda não possui jogos cadastrados!</p>
        <?php endif; ?>
    </div>
</section>