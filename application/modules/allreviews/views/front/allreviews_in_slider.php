<?php foreach ($entries as $e): ?>
    <li>
        <div class="reviews_item_wrapper">
            <?php for ($i = 0; $i < 4; $i++): ?>
                <?php if (isset($e[$i])): ?>
                    <div class="reviews_item <?php
                    if ($i == 1 || $i == 3) {
                        echo 'reviews_item_2';
                    }
                    ?>">
                        <div class="reviews_icon"> <img src="/img/miniIcon.png" alt=""></div>
                        <h6><?= $e[$i]['name'] ?></h6>
                        <div class="clear"></div>
                        <p><?= mb_strimwidth(strip_tags($e[$i]['text']), 0, 200, "..."); ?></p>
                    </div><!-- /reviews_item -->
                <?php endif; ?>
            <?php endfor; ?>
        </div><!-- /reviews_item_wrapper -->
    </li>
<?php endforeach; ?>