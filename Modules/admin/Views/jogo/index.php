<?php
/** @var \Admin\Models\Entities\Jogo[] $jogos */
$jogos = $data['jogos'];
?>

<section class="content-header">
    <h1>
        Jogos
        <small>VER TODOS</small>
    </h1>
</section>

<section class="content">
    <div class="row">

        <?php if (empty($jogos)): ?>
            <p class="text-center">Nenhum jogo encontrado</p>
        <?php
            else:
                foreach ($jogos as $jogo):
        ?>
                    <div class="col-md-4 col-sm-6 col-xs-12">
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
                    </div>
        <?php
                endforeach;
            endif;
        ?>
    </div>
</section>