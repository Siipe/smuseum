<?php
/** @var \Admin\Models\Entities\Compra[] $compras */
$compras = $data['compras'];
?>
<section class="content-header">
    <h1>
        Compras
        <small>VER TODOS</small>
    </h1>
</section>
<section class="content">
    <div class="box" id="carrinho-container">
        <?php if (empty($compras)): ?>
            <p class="text-center p-10">Você ainda não comprou aqui no site!</p>
        <?php else: ?>
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($compras as $compra): ?>
                        <tr>
                            <td><?= $compra->getId() ?></td>
                            <td><?= $compra->getDataInclusaoFormatada() ?></td>
                            <td><a href="<?= $this->url(array('module' => 'admin', 'controller' => 'compra', 'action' => 'visualizar', 'id' => $compra->getId())) ?>" title="Visualizar"><i class="fa fa-eye f-18 c-green" aria-hidden="true"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>
</section>