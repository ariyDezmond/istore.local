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
        <div class="checkbox">
            <label>
                <input name='active' type="checkbox"> Активен
            </label>
        </div>
        <div class="form-group">
            <label for="name">Категория</label><br/>
            <input name='name' value="<?= set_value('name') ?>" type="text" class="form-control name">
        </div>
        <div class="form-group">
            <label for="url">ЧПУ</label><br/>
            <input name='url' value="<?= set_value('url') ?>" type="text" class="form-control name_translit">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Текст</label>
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