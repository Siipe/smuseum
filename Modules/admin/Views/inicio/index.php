<div class="row">
    <div class="col-lg-12">
        <h1 class="welcome">Seja bem vindo ao Portal</h1>
        <p>Para navegar entre os modulos, selecione um dos serviços listados abaixo.</p>
        <p>Você também pode retornar ao site oficial <a href="http://www.sistemacei.com.br/site/default.asp">clicando aqui</a>.</p>
    </div>
</div>
<hr />
<div>
    <div class="form-group">
        <div class="side top text-center">
            <a class="module-wrapper" href="<?= \Core\App::getRouter()->url(array('route' => 'responsavel')) ?>">
                <div class="col-md-4">
                    <?= $this->img('responsavel.png', array('alt' => 'Responsável')) ?>
                    <h2>Responsável</h2>
                    <p>Espaço onde o responsável poderá consultar informações sobre o aluno.</p>
                </div>
            </a>
            <a class="module-wrapper" href="<?= \Core\App::getRouter()->url(array('route' => 'aluno')) ?>">
                <div class="col-md-4">
                    <?= $this->img('aluno.png', array('alt' => 'Aluno')) ?>
                    <h2>Aluno</h2>
                    <p>Espaço onde o aluno irá consultar seu andamento no colégio e outros assuntos, como notícias e etc.</p>
                </div>
            </a>
            <a class="module-wrapper" href="<?= \Core\App::getRouter()->url(array('route' => 'professor')) ?>">
                <div class="col-md-4">
                    <?= $this->img('professor.png', array('alt' => 'Professor')) ?>
                    <h2>Professor</h2>
                    <p>Espaço onde o professor fará suas solicitações, lançamentos de notas e acompanhamento da evolução dos seus alunos.</p>
                </div>
            </a>
            <a class="module-wrapper" href="<?= \Core\App::getRouter()->url(array('route' => 'diretor')) ?>">
                <div class="col-md-4">
                    <?= $this->img('director.png', array('alt' => 'Diretor')) ?>
                    <h2>Diretor</h2>
                    <p>Espaço onde o diretor fará suas solicitações, acompanhamentos, etc.</p>
                </div>
            </a>
            <a class="module-wrapper" href="#">
                <div class="col-md-4">
                    <?= $this->img('inscricao.png', array('alt' => 'Incrição')) ?>
                    <h2>Inscrições</h2>
                    <p>Espaço das inscrições.</p>
                </div>
            </a>
        </div>
    </div>
</div>