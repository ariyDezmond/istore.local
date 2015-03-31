<div class="modal-content modal-content2">
    <form method="POST" action="javascript:" id="<?= $module ?>_form">
        <?php
        if ($this->session->userdata('error')) {
            echo $this->session->userdata('error');
        }
        $this->session->unset_userdata('error');
        ?>
        <input <?php
        if (strpos(validation_errors(), '"Имя"')) {
            echo 'style="border-color:red;"';
        }
        ?> type="text" name="name" value="<?= set_value('name') ?>" type="text" placeholder="Введите имя">
        <input <?php
        if (strpos(validation_errors(), '"Email"')) {
            echo 'style="border-color:red;"';
        }
        ?> name="email" value="<?= set_value('email') ?>" type="text" placeholder="E-mail">
        <input <?php
        if (strpos(validation_errors(), '"Телефон"')) {
            echo 'style="border-color:red;"';
        }
        ?> name="phone" value="<?= set_value('phone') ?>" type="text" placeholder="Введите телефон">
        <input type="hidden" name="do" value="<?= $module ?>Send">
        <input id="send_button" type="button" value="Купить" onclick="javascript:send<?= $module ?>()">
        <div id="loading_img" style="text-align: center; display: none;"><img src="/img/loading.gif"></div>
    </form>
</div>
<script>
    function send<?= $module ?>() {
        $("#send_button").css('display', 'none');
        $("#loading_img").css('display', 'block');
        $.ajax({
            url: '/<?= $module ?>/send/<?= $id ?>',
            type: "POST",
            dataType: "html",
            data: $('#<?= $module ?>_form').serialize(),
            success: function (response) {
                document.getElementById('cboxLoadedContent').innerHTML = response;
                $("#send_button").css('display', 'block');
                $("#loading_img").css('display', 'none');
            },
            error: function (response) {
                document.getElementById('cboxLoadedContent').innerHTML = "Ошибка при отправке формы";
            }
        });
        return false;
    }
</script>


<!--<div class="modal-content modal-content2">
    <form method="POST" action="javascript:" id="backcall_form">
<?php
if ($this->session->userdata('error')) {
    echo $this->session->userdata('error');
}
$this->session->unset_userdata('error');
?>
        <input <?php
if (strpos(validation_errors(), '"Имя"')) {
    echo 'style="border-color:red;"';
}
?> type="text" name="name" placeholder="Введите имя">
        <input <?php
if (strpos(validation_errors(), '"Телефон"')) {
    echo 'style="border-color:red;"';
}
?> name="phone" type="text" placeholder="Введите телефон">
        <input type="hidden" name="do" value="backcallSend">
        <input id="send_button" type="button" value="Перезвонить мне" onclick="javascript:sendbackcall()">
        <div id="loading_img" style="text-align: center; display: none;"><img src="/img/loading.gif"></div>
    </form>
</div>-->