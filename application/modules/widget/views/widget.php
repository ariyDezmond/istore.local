<a href='/admin/widget/add'><button type="button" style='margin-bottom:20px;' class="btn btn-default btn-default">Добавить</button></a>
<table class="table table-bordered">
    <?php if (is_array($entries)) { ?>
        <tr>
            <td width="30px">#</td>
            <td width="30%">Название</td>
            <td width="30%">Значение виджета</td>
            <td>Порядок</td>
            <td width="30px">Редактировать</td>
            <td width="30px">Удалить</td>
        </tr>
        <?php
        foreach ($entries as $entry):
            ?>
            <tr>
                <td class="id" width="30px"><?= $entry['id'] ?></td>
                <td width="30%"><?= $entry['title'] ?></td>
                <td width="30%"><?= mb_strimwidth(strip_tags($entry['text']), 0, 100, "...") ?></td>
                <td>
                    <a href='/admin/widget/up/<?= $entry['id'] ?>'>
                        <span class="glyphicon glyphicon-arrow-up"></span>
                    </a>
                    <a href='/admin/widget/down/<?= $entry['id'] ?>'>
                        <span class="glyphicon glyphicon-arrow-down"></span>
                    </a>
                    (<?= $entry['order'] ?>)
                </td>
                <td width="30px"><a href='/admin/widget/edit/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-edit"></span></a></td>
                <td width="30px"><a href='/admin/widget/delete/<?= $entry['id'] ?>'><span class="glyphicon glyphicon-remove"></span></a></td>
            </tr>
            <?php
        endforeach;
    } else {
        echo '<div class="alert alert-danger" role="alert"><strong>Oops! </strong>Записей в базе не найдено</div>';
    }
    ?>
</table>
