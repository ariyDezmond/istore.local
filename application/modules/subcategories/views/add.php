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
            <label for="text">Название</label>
            <input name='text' value="<?= set_value('text') ?>" type="text" class="form-control name" id="text" placeholder="">
        </div>
        <div class="form-group">
            <label for="url">ЧПУ</label>
            <input name='url' value="<?= set_value('url') ?>" type="text" class="form-control name_translit" id="url" placeholder="">
        </div>
        <label for="category">Категория</label>
        <div class="form-group">
            <select name="category" class="form-control" id="category">
                <?foreach($categories as $category):?>
                    <option value='<?=$category['id']?>'><?=$category['name']?></option>
                <?endforeach;?>
            </select>
        </div>
        <div class="checkbox">
            <label>
                <input name='active' type="checkbox"> Активен
            </label>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label><br/>
            <input required name='image' type="file" class="btn-file" id="image">
            <p class="help-block">Выберите картинку</p>
        </div>
        
        
    </div>
    <div class="col-md-6">
        <button type="button" id="hideMeta" class="btn btn-default">Meta</button>
        <div id="meta">
            <div class="form-group">
                <label for="title">Title</label>
                <input name='title' value="<?= set_value('title') ?>" type="text" class="form-control" id="title" placeholder="">
            </div>
            <div class="form-group">
                <label for="desc">Мета description</label>
                <textarea name='desc' rows="5" class="form-control" id="desc" placeholder=""><?= set_value('desc') ?></textarea>
            </div>
            <div class="form-group">
                <label for="keyw">Мета keywords</label>
                <textarea name='keyw' rows="3" class="form-control" id="keyw" placeholder=""><?= set_value('keyw') ?></textarea>
            </div>
        </div>
    </div>
</div
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Add">
        <button type="submit" class="btn btn-default">Добавить</button>
    </div>    
</div>
<?form_close(); ?>

<script>
    $(function(){
        $("#hideMeta").toggle(function(){
            $("#meta").hide();
        },
        function(){
            $("#meta").show();
        });
    });
</script>