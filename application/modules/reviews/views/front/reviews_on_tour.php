<h5 class="hotel_title_2">Отзывы</h5>

<div class="reviews_page reviews_page_2">
    <div class="reviews_inner">
        <?php if (!empty($entries)): ?>
            <?php foreach ($entries as $entry): ?>
                <div class="reviews_inner_item" class="short_review">
                    <span><?= date('d.m.Y H:i', strtotime($entry['date'])) ?></span>
                    <h6 class="shortcomings" style="color: black;"><?= $entry['name'] ?></h6>
                    <?php if ($entry['worths']): ?>
                        <h6 class="shortcomings" style="color: #1BBE1C">Достоинства:</h6>
                        <p><?= mb_strimwidth(strip_tags($entry['worths']), 0, 250, "..."); ?></p>
                    <?php endif; ?>
                    <?php if ($entry['flaws']): ?>
                        <h6 class="shortcomings">Недостатки:</h6>
                        <p><?= mb_strimwidth(strip_tags($entry['flaws']), 0, 250, "..."); ?></p>
                    <?php endif; ?>
                    <?php if (strlen($entry['flaws']) || strlen($entry['worths']) > 250): ?>
                        <a href="" class="view_all">прочитать отзыв полностью</a>
                    <?php endif; ?>
                </div>
                <div style="display: none;" class="reviews_inner_item full_review">
                    <span><?= date('d.m.Y H:i', strtotime($entry['date'])) ?></span>
                    <h6 class="shortcomings" style="color: black;"><?= $entry['name'] ?></h6>
                    <?php if ($entry['worths']): ?>
                        <h6 class="shortcomings" style="color: #1BBE1C">Достоинства:</h6>
                        <p><?= $entry['worths'] ?></p>
                    <?php endif; ?>
                    <?php if ($entry['flaws']): ?>
                        <h6 class="shortcomings">Недостатки:</h6>
                        <p><?= $entry['flaws'] ?></p>
                    <?php endif; ?>
                    <a href="" class="view_all show_all">скрыть</a>
                </div>
            <?php endforeach; ?>
            <a href="" onclick="return false;" class="more_reviews">Загрузить еще</a>
        <?php else: ?>
            <p>Отзывов еще никто не добавлял. Будьте первым!</p>
        <?php endif; ?>
    </div>
</div>