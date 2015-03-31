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
            <div class="panel-heading">Страна и город</div>
            <div class="panel-body">
                <?= $entry['country'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Количество комнат</div>
            <div class="panel-body">
                <?= $entry['rooms'] ?>
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
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Цена за сутки</div>
            <div class="panel-body">
                <?= $entry['price'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Имя, Фамилия</div>
            <div class="panel-body">
                <?= $entry['name'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Телефон</div>
            <div class="panel-body">
                <?= $entry['phone'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Количество звезд</div>
            <div class="panel-body">
                <?= $entry['stars'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Количество мест</div>
            <div class="panel-body">
                <?= $entry['places'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-heading">Количество дней</div>
            <div class="panel-body">
                <?= $entry['days'] ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Дополнительная информация</div>
            <div class="panel-body">
                <?= $entry['text'] ?>
            </div>
        </div>
    </div>
</div>