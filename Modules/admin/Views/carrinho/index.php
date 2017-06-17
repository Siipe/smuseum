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
                    <?php foreach ($itens as $key => $value): ?>
                        <tr>
                            <td><?= $key ?></td>
                            <td><?= $value['nome'] ?></td>
                            <td><?= number_format($value['preco'], 2) ?></td>
                            <td><?= $value['quantidade'] ?></td>
                            <td><a href="javascript:void(0)" title="Remover" onclick="removerDoCarrinho(this, '<?= $key ?>', '<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho', 'action' => 'remover')) ?>')"><i class="fa fa-trash f-18 c-red" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <div class="text-right p-10">
                <a href="<?= $this->url() ?>" class="btn btn-sm btn-default"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                <a href="<?= $this->url(array('module' => 'admin', 'controller' => 'carrinho', 'action' => 'finalizar')) ?>" class="btn btn-sm btn-primary">Finalizar compra</a>
            </div>
        <?php endif; ?>
    </div>
</section>