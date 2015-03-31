<div class="row">
    <div class="col-md-12">
        <a href="/admin/<?= $module ?>">
            <button type="button" class="btn btn-default btn-default"><span class='glyphicon glyphicon-step-backward'></span> Назад к списку</button>
        </a>
    </div>
</div>
<div class="page-header">
    <h2>Добавление записи в модуль "<?= $module_name ?>"</h2>
</div>
<?= form_open_multipart('admin/' . $module . '/add') ?>
<div class="row" style="margin-bottom: 10px;">
    <div class="col-md-12">
        <button type="submit" class="btn btn-default">Добавить</button>
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
            <input required name='name' value="<?= set_value('name') ?>" type="text" class="form-control" id="name" placeholder="Название">
        </div>
        <label for="status">Статус</label>
        <div class="input-group">
            <input required name='status' value="<?= set_value('status') ?>" type="number"  min="1" max="7" class="form-control" id="status" placeholder="Введите количество звезд">
            <span class="input-group-addon"><span class="glyphicon glyphicon-star-empty"></span></span>
        </div>
        <div class="form-group">
            <label for="site">Сайт</label>
            <input name='site' value="<?= set_value('site') ?>" type="url" class="form-control" id="site" placeholder="www.site.com">
        </div>
        <div class="form-group">
            <label for="phone">Телефон</label>
            <input required name='phone' value="<?= set_value('phone') ?>" type="text" class="form-control" id="phone" placeholder="">
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input name='email' value="<?= set_value('email') ?>" type="email" class="form-control" id="email" placeholder="">
        </div>
        <div class="form-group">
            <label for="fax">Fax</label>
            <input name='fax' value="<?= set_value('fax') ?>" type="text" class="form-control" id="fax" placeholder="">
        </div>
        <div class="form-group">
            <label for="rooms">Количество номеров</label>
            <input required name='rooms' value="<?= set_value('rooms') ?>" type="number" class="form-control" id="rooms" placeholder="">
        </div>
        <label for="distoport">Расстояние до аэропорта</label>
        <div class="input-group">
            <input required name='distoport' value="<?= set_value('distoport') ?>" type="number" class="form-control" id="distoport" placeholder="">
            <span class="input-group-addon">км</span>
        </div>
        <div class="form-group">
            <label for="beachl">Пляжная линия</label>
            <input required name='beachl' value="<?= set_value('beachl') ?>" type="text" class="form-control" id="beachl" placeholder="">
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="image">Главное изображение</label><br/>
            <input required name='image' type="file" class="btn-file" id="image">
            <p class="help-block">Выберите главное фото</p>
        </div>
        <div class="checkbox">
            <label>
                <input name='active' type="checkbox"> Активен
            </label>
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Информация об отеле</label>
            <textarea name="text" id="text" rows="30">
                <?= set_value('text') ?>
            </textarea>
        </div>
        <script>
            CKEDITOR.replace('text');
        </script>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Add">
        <button type="submit" class="btn btn-default">Добавить</button>
    </div>    
</div>
<?form_close(); ?>