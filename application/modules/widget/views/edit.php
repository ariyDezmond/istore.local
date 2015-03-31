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
<?= form_open_multipart(base_url() . 'admin/' . $module . '/edit/' . $entry['id']) ?>
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
            <label for="title">Название</label>
            <input required name='title' value="<?= $entry['title'] ?>" type="text" class="form-control" id="title" placeholder="Название">
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="text">Значение виджета</label>
            <textarea style="width: 100%" rows="10" name="text" id="text"><?= $entry['text'] ?></textarea>
            <script>
                CKEDITOR.replace('text', {
                    startupMode: 'source'
                });
            </script>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Edit">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>    
</div>
<?form_close(); ?>