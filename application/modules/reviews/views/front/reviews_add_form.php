<h5 class="hotel_title_2">Оставить отзыв:</h5>

<form id="form" action="javascript:">
    <div class="hotel_description message">
        <p>Имя</p>
        <input <?php if (strpos(validation_errors(), '"Имя"')): ?> style="border:2px solid red;" <?php endif; ?> name="name" value="<?= set_value('name') ?>" type="text">
        <p>Достоинства</p>
        <input <?php if (strpos(validation_errors(), '"Достоинства"')): ?> style="border:2px solid red;" <?php endif; ?> name="worths" value="<?= set_value('worths') ?>" type="text">
        <p>Недостатки</p>
        <input <?php if (strpos(validation_errors(), '"Недостатки"')): ?> style="border:2px solid red;" <?php endif; ?> name="flaws" value="<?= set_value('flaws') ?>" type="text">
    </div>
    <input type="hidden" name="do" value="reviewsSave">
    <input type="hidden" name="obj_id" value="<?= $object_id ?>">
    <input id="send_review_btn" onclick="sendform()" type="button" value="Добавить" class="add">
</form>
<script>
    function sendform() {
        $('#form').css('opacity', '0.5');
        $('#send_review_btn').css('visibility', 'hidden');
        $.ajax({
            url: '/reviews/save/<?= $object_id ?>',
            type: "POST",
            dataType: "html",
            data: $('#form').serialize(),
            success: function (response) {
                document.getElementById('reviews-form-block').innerHTML = response;
                $('#form').css('opacity', '1');
                $('#send_review_btn').css('visibility', 'visible');
            },
            error: function (response) {
                document.getElementById('reviews-form-block').innerHTML = "<?= $this->lang->line('text_error_while_sending_form') ?>";
                $('#form').css('opacity', '1')
            }
        });
        return false;
    }
</script>
<!--

<h3>Оставить отзыв:</h3>
<form id="form" action="javascript:">
    <div class="fields">
        <label>Фамилия, Имя</label>
        <input <?php if (strpos(validation_errors(), '"Имя"')): ?> style="border:2px solid red;" <?php endif; ?> name="name" value="<?= set_value('name') ?>" type="text"/>

        <label>Достоинства</label>
        <textarea <?php if (strpos(validation_errors(), '"Достоинства"')): ?> style="border:2px solid red;" <?php endif; ?> name="worths" cols="30" rows="10"><?= set_value('worths') ?></textarea>

        <label>Недостатки</label>
        <textarea <?php if (strpos(validation_errors(), '"Недостатки"')): ?> style="border:2px solid red;" <?php endif; ?> name="flaws" cols="30" rows="10"><?= set_value('flaws') ?></textarea>

    </div>
    <input type="hidden" name="do" value="reviewsSave">
    <input type="hidden" name="obj_id" value="<?= $object_id ?>">
    <input onclick="sendform()" type="submit" value="Добавить"/>
</form>-->