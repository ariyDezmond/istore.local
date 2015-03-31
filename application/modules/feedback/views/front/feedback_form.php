<div id="feedback_form">
<form id="send_msg">
<div class="form-group form-group_2">
   <label for="exampleInputEmail1">Имя*</label>
   <input type="text" name='name' value="<?= set_value('name') ?>" <?php
        if (strpos(validation_errors(), '"Name"')) {
            echo 'style="border:2px solid red;"';
        }
        ?>class="form-control" id="exampleInputEmail1" placeholder="">
</div>
<div class="form-group form-group_2">
   <label for="exampleInputEmail1">Email*</label>
   <input type="email" name='email' value="<?= set_value('email') ?>" <?php
        if (strpos(validation_errors(), '"Email"')) {
            echo 'style="border:2px solid red;"';
        }
        ?>class="form-control" id="exampleInputEmail1" placeholder="">
</div>
<div class="form-group form-group_2">
   <label for="exampleInputEmail1">Тема*</label>
   <input type="text" name='theme' value="<?= set_value('theme') ?>" <?php
        if (strpos(validation_errors(), '"Theme"')) {
            echo 'style="border:2px solid red;"';
        }
        ?>class="form-control" id="exampleInputEmail1" placeholder="">
</div>
<div class="clear"></div>
<div class="form-group">
   <label for="exampleInputPassword1">Сообщение*</label>
   <textarea name="message" id="" value="<?= set_value('message') ?>" <?php
        if (strpos(validation_errors(), '"Message"')) {
            echo 'style="border:2px solid red;"';
        }
        ?>cols="" rows=""></textarea>
</div>
<!-- <div class="checkbox">
   <label>
   <input type="checkbox"> Отправить копию  этого сообщения  на ваш адрес
   </label>
</div> -->
<input type="hidden" name="do" value="feedbackSave">
<div id="load"><button type="button" id="send" class="btn btn-default">Отправить</button></div>
</form>
</div>
<script type="text/javascript">
  $(function(){
    $('#send').click(function(){
      $.ajax({
        type : 'POST',
        url  : '/feedback/save',
        data : $('#send_msg').serialize(),
        beforeSend : function(){
          $('#load').empty();
          $('#load').append("<div class='progress'>"+
                              "<div class='progress-bar progress-bar-striped active'"+
                                "role='progressbar' aria-valuenow='100'"+
                                "aria-valuemin='0' aria-valuemax='100' style='width: 50%'>"+
                              "</div>"+
                            "</div>")
                    .next()
                    .animate({width: '100%'});
        },
        success: function(data){
          $('#feedback_form').html(data);
        },
        error : function(jqhr,error){
          $('#feedback_form').text(error);
        }
      });
    });
  });
</script>