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
            <label for="text">Название</label>
            <input required name='text' value="<?= $entry['text'] ?>" type="text" class="form-control" id="text" placeholder="">
        </div>
        <div class="form-group">
            <label for="url">ЧПУ</label>
            <input name='url' value="<?= $entry['url'] ?>" type="text" class="form-control" id="url" placeholder="">
        </div>
        <label for="category">Категория</label>
        <div class="form-group">
            <select name="category" class="form-control" id="category">
                <?foreach($categories as $category):?>
                    <option <?if($category['id'] == $entry['category_id']):?>selected<?endif;?> value='<?=$category['id']?>'><?=$category['text']?></option>
                <?endforeach;?>
            </select>
        </div>

        <div class="checkbox">
            <label>
                <input name='active' <?php
                if ($entry['active'] == 'on') {
                    echo 'checked';
                }
                ?> type="checkbox"> Активен
            </label>
        </div>
        <div class="form-group">
            <label for="image">Изображение</label><br/>
            <div class="well"><img width="200px" style="border: 1px solid black; background-color: grey;" src="/images/<?= $module ?>/<?= $entry['image'] ?>"></div>
            <input name='image' type="file" class="btn-file" id="image">
            <p class="help-block">Выберите главное фото</p>
        </div>
        
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="title">Title</label>
            <input name='title' value="<?= $entry['title'] ?>" type="text" class="form-control" id="title" placeholder="">
        </div>
        <div class="form-group">
            <label for="desc">Мета description</label>
            <textarea name='desc' rows="5" class="form-control" id="desc" placeholder=""><?= $entry['desc'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="keyw">Мета keywords</label>
            <textarea name='keyw' rows="3" class="form-control" id="keyw" placeholder=""><?= $entry['keyw'] ?></textarea>
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