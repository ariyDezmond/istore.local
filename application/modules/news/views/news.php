<a href='/admin/<?= $module ?>/add'><button type="button" style='margin-bottom:20px;' class="btn btn-default btn-default">Добавить</button></a>
<table class="table table-bordered">
    <?php if (is_array($entries)) { ?>
        <tr>
            <td width="30px">#</td>
            <td width="30%">Название</td>
            <td width="30%">ЧПУ</td>
            <td>Миниатюра</td>
            <td width="30%">Текст</td>
            <td>Дата</td>
            <td>Активен</td>
            <td>Порядок</td>
            <td width="30px">Редактировать</td>
            <td width="30px">Удалить</td>
        </tr>
        <?php
        foreach ($entries as $entry):
            ?>
            <tr>
                <td class="id" width="30px"><?= $entry['id'] ?></td>
                <td width="30%"><?= $entry['name'] ?></td>
                <td width="30%"><?= mb_strimwidth($entry['url'], 0, 30, "...") ?></td>
                <td width="20px"><img width="50px" src='/images/<?= $module ?>/<?= $entry['image'] ?>'></td>
                <td><?= mb_strimwidth(strip_tags($entry['text']), 0, 50, "..."); ?></td>
                <td><?= date('d.m.Y H:i', strtotime($entry['date'])) ?></td>
                <td width="30px"><?php
                    if ($entry['active'] == 'on') {
                        echo '<span style="-webkit-user-select: none;" class="label label-success active">да</span>';
                    } else {
                        echo '<span style="-webkit-user-select: none;" class="label label-danger active">нет</span>';
                    }
                    ?></td>
                <td><a href='/admin/<?= $module ?>/up/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-arrow-up"></span></a><a href='/admin/<?= $module ?>/down/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-arrow-down"></span></a> (<?= $entry['order'] ?>)</td>
                <td width="30px"><a href='/admin/<?= $module ?>/edit/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-edit"></span></a></td>
                <td width="30px"><a href='/admin/<?= $module ?>/delete/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Oops! </strong>Записей в базе не найдено</div>';
    }
    ?>
</table>