<div class="row">
    <div class="col-md-12">
        <a href="/admin/<?= $module ?>">
            <button type="button" class="btn btn-default btn-default"><span class='glyphicon glyphicon-step-backward'></span> Назад к списку</button>
        </a>
    </div>
</div>
<div class="page-header">
    <h2>Редактирование модуля "<?= $module_name ?>"</h2>
</div>
<?= form_open_multipart('admin/' . $module . '/edit/' . $entry['id']) ?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-md-12">
        <?= validation_errors(); ?>
        <?php
        if ($this->session->userdata('error')) {
            echo $this->session->userdata('error');
        }
        $this->session->unset_userdata('error');
        ?>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название</label>
            <input required name='name' value="<?= $entry['name'] ?>" type="text" class="form-control" id="name" placeholder="Название">
        </div>
        <label for="status">Статус</label>
        <div class="input-group">
            <input required name='status' value="<?= $entry['status'] ?>" type="number" min="1" max="7" class="form-control" id="status" placeholder="Введите количество звезд">
            <span class="input-group-addon"><span class="glyphicon glyphicon-star-empty"></span></span>
        </div>
        <div class="form-group">
            <label for="site">Сайт</label>
            <input name='site' value="<?= $entry['site'] ?>" type="url" class="form-control" id="site" placeholder="www.site.com">
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input required name='phone' value="<?= $entry['phone'] ?>" type="text" class="form-control" id="phone" placeholder="">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input name='email' value="<?= $entry['email'] ?>" type="email" class="form-control" id="email" placeholder="">
        </div>
        <div class="form-group">
            <label for="fax">Fax</label>
            <input name='fax' value="<?= $entry['fax'] ?>" type="text" class="form-control" id="fax" placeholder="">
        </div>
        <div class="form-group">
            <label for="rooms">Количество номеров</label>
            <input required name='rooms' value="<?= $entry['rooms'] ?>" type="number" class="form-control" id="rooms" placeholder="">
        </div>
        <label for="distoport">Расстояние до аэропорта</label>
        <div class="input-group">
            <input required name='distoport' value="<?= $entry['distoport'] ?>" type="number" class="form-control" id="distoport" placeholder="">
            <span class="input-group-addon">км</span>
        </div>
        <div class="form-group">
            <label for="beachl">Пляжная линия</label>
            <input required name='beachl' value="<?= $entry['beachl'] ?>" type="text" class="form-control" id="beachl" placeholder="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="image">Главное изображение</label><br/>
            <div class="well"><img width="200px" style="border: 1px solid black; background-color: grey;" src="/images/<?= $module ?>/<?= $entry['image'] ?>"></div>
            <input name='image' type="file" class="btn-file" id="image">
            <p class="help-block">Выберите главное фото</p>
        </div>
        <script>
            $(document).ready(function () {
                var url = '/admin/' + '<?= $module ?>' + '/images_upload/' + '<?= $entry['id'] ?>';
                $("#upload_image").imageUpload(url, {
                    uploadButtonText: "Добавить",
                    previewImageSize: 150,
                    onSuccess: function (response) {
                        $.ajax(
                                {
                                    url: '/admin/<?= $module ?>/get_images/' + '<?= $entry['id'] ?>',
                                    type: 'POST',
                                    data: {
                                    },
                                    error: function () {
                                        console.log('Ошибка');
                                    },
                                    success: function (data) {
                                        $('.images_group').html(data)
                                        image_del_click_subscription('<?= $module ?>');
                                    }
                                });
                    }
                });
                $.ajax({
                    url: '/admin/<?= $module ?>/get_images/' + '<?= $entry['id'] ?>',
                    type: 'POST',
                    data: {
                    },
                    error: function () {
                        console.log('Ошибка');
                    },
                    success: function (data) {
                        $('.images_group').html(data)
                        image_del_click_subscription('<?= $module ?>');
                    }
                });
            });
        </script>
        <div class="checkbox">
            <label>
                <input name='active' <?php
                if ($entry['active'] == 'on') {
                    echo 'checked';
                }
                ?> type="checkbox"> Активен
            </label>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <label for="text">Картинки</label>
        <div class="alert alert-info" role="alert">
            <div id="upload_image"></div>
        </div>
        <div class="images_group"></div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Информация об отеле</label>
            <textarea name="text" id="text" rows="30">
                <?= $entry['text'] ?>
            </textarea>
        </div>
        <script>
            CKEDITOR.replace('text');
        </script>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Edit">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>    
</div>
<?form_close(); ?>