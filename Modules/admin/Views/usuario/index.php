<?php
/** @var \Admin\Models\Entities\Usuario[] $usuarios */
$usuarios = $data['usuarios'];
?>
<section class="content-header">
    <h1>
        Usuários
        <small>VER TODOS</small>
    </h1>
</section>
<section class="content">
    <div class="box">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Login</th>
                        <th>Membro desde</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= $usuario->getNome() ?></td>
                        <td><?= $usuario->getEmail() ?></td>
                        <td><?= $usuario->getLogin() ?></td>
                        <td><?= $usuario->getDataInclusaoFormatada() ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>