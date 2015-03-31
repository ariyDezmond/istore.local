<div class="news_and_blog">
    <div class="wrapper">
        <h3 class="main_title"><?= $entry['name'] ?></h3>
        <span><?= date('d.m.Y H:i', strtotime($entry['date'])) ?></span>
        <div class="clear"></div>
        <img src="/images/blog/<?= $entry['image'] ?>" alt="<?= $entry['name'] ?>">
        <?= $entry['text'] ?>
    </div>
</div>