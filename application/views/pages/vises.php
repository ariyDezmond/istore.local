<div class="viza">
    <div class="wrapper">
        <h3 class="main_title"><?= Modules::run('widget/getByTitle', 'vises-title') ?></h3>

        <?= Modules::run('vises/view', true, $this->uri->segment(2)) ?>

    </div>
</div>