<div class="reviews_page">
    <div class="wrapper">
        <h3 class="main_title">Отзывы</h3>
        <div class="reviews_inner">
            <?= Modules::run('allreviews/view', true) ?>
            <div id="reviews-form-block">
                <?= Modules::run('allreviews/save', true) ?>
            </div>
        </div>
    </div>
</div>