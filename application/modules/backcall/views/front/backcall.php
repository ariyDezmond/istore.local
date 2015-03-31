<div class="modal-content modal-content2">
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
        ?> type="text" name="name" value="<?= set_value('name') ?>" placeholder="Введите имя">
        <input <?php
        if (strpos(validation_errors(), '"Телефон"')) {
            echo 'style="border-color:red;"';
        }
        ?> type="text" name="phone" value="<?= set_value('phone') ?>" type="text" placeholder="Введите телефон">
        <input type="hidden" name="do" value="backcallSend">
        <input id="send_button" type="button" value="Перезвонить мне" onclick="javascript:sendbackcall()">
        <div id="loading_img" style="text-align: center; display: none;"><img src="/img/loading.gif"></div>
    </form>
</div>
<script>
    function sendbackcall() {
        $("#send_button").css('display', 'none');
        $("#loading_img").css('display', 'block');
        $.ajax({
            url: '/backcall/send',
            type: "POST",
            dataType: "html",
            data: $('#backcall_form').serialize(),
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