<script>
    $(document).ready(function () {
        $.ajax({
            url: '/<?= $module ?>/read',
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
<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Имя</div>
            <div class="panel-body">
                <?= $entry['name'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">E-mail</div>
            <div class="panel-body">
                <a href="mailto:<?= $entry['email'] ?>"><?= $entry['email'] ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6" style="clear: both;">
        <div class="panel panel-default">
            <div class="panel-heading">Телефон</div>
            <div class="panel-body">
                <?= $entry['phone'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Тур</div>
            <div class="panel-body">
                <a target="_blank" href="<?= base_url() . 'tours/' . $tour['url'] ?>"><?= $tour['name'] ?></a>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Дата отправки</div>
            <div class="panel-body">
                <?= date('d.m.Y h:i', strtotime($entry['date'])) ?>
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
</div>