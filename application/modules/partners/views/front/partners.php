<?php if (!empty($entries)): ?>
    <div class="wrapper">
        <h3 class="main_title">ПАРТНЕРЫ</h3>
        <div class="flexslider">
            <ul class="slides partners_slider">
                <?php
                foreach ($entries as $entry): ?>
                    <li>
                        <div class="partners_item_wrapper">
                            <?php for ($i = 0; $i < 6; $i++): ?>
                                <?php if (isset($entry[$i])): ?>
                                    <img src="/images/partners/<?= $entry[$i]['image'] ?>" alt="">
                                <?php endif; ?>
                            <?php endfor; ?>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div><!-- /flexslider -->
    </div>
<?php endif; ?>