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
            <label for="name">Название</label>
            <input required name='name' value="<?= $entry['name'] ?>" type="text" class="form-control" id="name" placeholder="">
        </div>
        <div class="form-group">
            <label for="category">Категория товаров</label>
            <select name="category" class="form-control" id="category">
                <option value="0" selected>Нет</option>
                <?php foreach ($categories as $c): ?>
                    <option <?php
                    if ($c['id'] == $entry['category_id']) {
                        echo 'selected';
                    }
                    ?> value="<?= $c['id'] ?>"><?= $c['text'] ?></option>
                    <?php endforeach; ?>
            </select>
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