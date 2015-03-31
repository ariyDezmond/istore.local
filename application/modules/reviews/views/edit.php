<script>
    $(document).ready(function () {
        $.ajax({
            url: '/reviews/read',
            type: "POST",
            dataType: "html",
            data: {
                id: <?= $entry['id'] ?>
            },
            success: function (response) {
                console.log('Успех');
            },
            error: function (response) {
                console.log('Ошибка');
            }
        });
    });
</script>
<div style="margin-bottom: 20px;" class="row">
    <div class="col-md-12">
        <a href="/admin/<?= $module ?>">
            <button type="button" class="btn btn-default btn-default"><span class="glyphicon glyphicon-step-backward"></span> Назад к списку</button>
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
<label>
    <input name='active' <?php
    if ($entry['active'] == 'on') {
        echo 'checked';
    }
    ?> type="checkbox"> Активен
</label>
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Дата отправки</div>
            <div class="panel-body">
                <?= date('d.m.Y H:i', strtotime($entry['date'])) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">IP-адрес</div>
            <div class="panel-body">
                <?= $entry['ip'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Имя, Фамилия</div>
            <div class="panel-body">
                <input required name='name' value="<?= $entry['name'] ?>" type="text" class="form-control" id="name" placeholder="">
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Страница с комментарием</div>
            <div class="panel-body">
                <a target="_blank" href="/tours/<?= $tour['url'] ?>"><?= $tour['name'] ?></a>
            </div>
        </div>
    </div>
    <div style="clear: both;"></div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Достоинства</div>
            <div class="panel-body">
                <textarea name='worths' rows="5" class="form-control" id="worths" placeholder=""><?= $entry['worths'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Недостатки</div>
            <div class="panel-body">
                <textarea name='flaws' rows="5" class="form-control" id="flaws" placeholder=""><?= $entry['flaws'] ?></textarea>
            </div>
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