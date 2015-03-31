<div class="reviews_inner_item add_review">
    <form id="form" action="javascript:">
        <input <?php if (strpos(validation_errors(), '"Имя"')): ?> style="border:2px solid red;" <?php endif; ?> name="name" value="<?= set_value('name') ?>" type="text" placeholder="Введите имя">
        <textarea <?php if (strpos(validation_errors(), '"Текст отзыва"')): ?> style="border:2px solid red;" <?php endif; ?> name="text" cols="30" rows="10" placeholder="Введите текст отзыва"><?= set_value('text') ?></textarea>
        <input type="hidden" name="do" value="allreviewsSave">
    </form>
</div>
<a onclick="sendform()" href="javascript:" class="add_review_btn">Добавить</a>
<script>
    function sendform() {
        $('#form').css('opacity', '0.5');
        $('.add_review_btn').css('display', 'none');
        $.post('/allreviews/save/', $('#form').serialize(), function (data) {
            $('#reviews-form-block').html(data);
            $('#form').css('opacity', '1');
            $('.add_review_btn').css('display', 'block');
        });
        return false;
    }
</script>