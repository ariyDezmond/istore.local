<?php if (!empty($entries)): ?>
    <?php foreach ($entries as $e): ?>
        <div class="reviews_inner_item">
            <p><?= $e['text'] ?></p>
            <h6><?= $e['name'] ?>, <?= date('d.m.Y H:i', strtotime($e['date'])) ?></h6>
        </div>
    <?php endforeach; ?>
    <a href="javascript:" class="more_reviews">Еще отзывы</a>
<?php else: ?>
    <p>Отзывов еще никто не добавлял. Будьте первым!</p>
<?php endif; ?>