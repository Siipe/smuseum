<?php if ($flash = \Core\App::getSession()->getAttribute('flash-message')): ?>
    <div class="p-15 p-b-0">
        <div class="alert <?= $flash['cssClass'] ?> alert-dismissable text-center">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <?= $flash['message'] ?>
        </div>
    </div>
<?php
    \Core\App::getSession()->unsetAttribute('flash-message');
endif;
?>