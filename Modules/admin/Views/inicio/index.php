<div class="row">
    <div class="col-lg-12">
        <h3 class="welcome">Olá, <?= explode(' ', $this->getUserSession()['name'])[0] ?>!</h3>
    </div>
</div>
<hr />
<div class="side top text-center">
    <a class="module-wrapper" href="<?= $this->url(array('module' => 'admin', 'controller' => 'jogo')) ?>">
        <div class="col-md-6 col-sm-6">
            <i class="fa fa-rocket fa-4x" aria-hidden="true"></i>
            <h2>Jogos</h2>
            <p>Diversos jogos desde os cartuchos até os mais modernos!</p>
        </div>
    </a>
    <div class="col-md-6 col-sm-6">
        <h2>Lorem Ipsum</h2>
        <p class="text-justify">Etiam bibendum mi a lacus porttitor rhoncus. Morbi egestas quam sit amet libero fringilla sodales. Curabitur ullamcorper commodo purus. Phasellus placerat tempus ipsum, nec efficitur turpis scelerisque viverra. Vestibulum viverra sagittis massa sit amet dapibus. Fusce tristique tempor sollicitudin. Donec vulputate varius ligula, eu posuere leo cursus in. Mauris vel hendrerit nisi.</p>
    </div>
</div>