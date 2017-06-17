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
                                <span class="info-box-number">R$ <?= $jogo->getPrecoFormatado() ?></span>
                                <span class="info-box-number">Plataforma: <?= $jogo->getPlataforma() ?></span>
                            </div>
                        </div>
                    </div>
        <?php
                endforeach;
            endif;
        ?>
    </div>
</section>