<?php
/** @var array $itens */
$itens = $data['itens'];
?>
<section class="content-header">
    <h1>
        Itens do Carrinho
        <small>VER TODOS</small>
    </h1>
</section>
<section class="content">
    <div class="box" id="carrinho-container">
        <?php if (empty($itens)): ?>
            <p class="text-center p-10">Seu carrinho está vazio!</p>
        <?php else: ?>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código do Produto</th>
                            <th>Jogo</th>
                            <th>Preço (R$)</th>
                            <th>Quantidade</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $total = 0;
                        foreach ($itens as $key => $value):
                            for ($i=0; $i<$value['quantidade']; $i++) {
                                $total += (int) $value['preco'];
                            }
                    ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $value['nome'] ?></td>
                            <td><?= number_format($value['preco'], 2, ',', '.') ?></td>
                            <td><?= $value['quantidade'] ?></td>
                            <td><a data-message="<?= sprintf('Deseja excluir o item <strong>%s</strong>?', $value['nome']) ?>" class="confirm" href="<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho', 'action' => 'remover', 'id' => $key)) ?>" title="Remover"><i class="fa fa-trash f-18 c-red" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="5"><strong>Total:</strong> R$ <?= number_format($total, 2, ',', '.') ?>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right p-10">
                <a href="<?= $this->url() ?>" class="btn btn-sm btn-default"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                <a data-message="<?= sprintf('Valor total de R$ %s. Deseja finalizar a compra?', number_format($total, 2, ',', '.')) ?>" href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra', 'action' => 'finalizar')) ?>" class="confirm btn btn-sm btn-primary">Finalizar compra</a>
            </div>
        <?php endif; ?>
    </div>
</section>