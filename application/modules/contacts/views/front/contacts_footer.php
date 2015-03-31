<div class="contacts">
    <div class="wrapper">
        <h3 class="main_title">Контакты</h3>

        <div class="contacts_col_1 contacts_col">
            <p><?= $entry['social_text'] ?></p>
            <div class="social_icons">
                <?php if ($entry['social_vk']): ?>
                    <a href="http://vk.com/<?= $entry['social_vk'] ?>" class="vk"></a>
                <?php endif; ?>
                <?php if ($entry['social_fb']): ?>
                    <a href="http://fb.com/<?= $entry['social_fb'] ?>" class="fc"></a>
                <?php endif; ?>
                <?php if ($entry['social_tw']): ?>
                    <a href="http://twitter.com/<?= $entry['social_tw'] ?>" class="tw"></a>
                <?php endif; ?>
                <?php if ($entry['social_ok']): ?>
                    <a href="http://ok.ru/<?= $entry['social_ok'] ?>" class="ok"></a>
                <?php endif; ?>
                <?php if ($entry['social_insta']): ?>
                    <a href="http://instagram.com/<?= $entry['social_insta'] ?>" class="insta"></a>
                <?php endif; ?>
            </div>
        </div>

        <div class="contacts_col_2 contacts_col">
            <p>Адрес: <?= $entry['adress'] ?></p>
            <p>Тел: <?= $entry['phone'] ?></p>
            <p>E-mail: <?= $entry['email'] ?></p>
        </div>

        <div class="contacts_col_3 contacts_col">
            <span>Посмотреть на карте</span>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB83YhiUJ6TXml08s-fBd1oMof0nNboIhg"></script>
            <script type="text/javascript">
                function initialize() {
                    var myLatlng = new google.maps.LatLng(<?= $entry['coords'] ?>);
                    var mapOptions = {
                        zoom: 13,
                        center: myLatlng
                    }
                    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'TravelShop'
                    });
                    google.maps.event.addListener(marker, "dragend", function (event) {
                        var point = marker.getPosition();// новые координаты маркера: point.lat() и point.lng()
                        $('#coords').val(point);
                    });
                }
                google.maps.event.addDomListener(window, 'load', initialize);
            </script>
            <div class="map">
                <div id="map-canvas"></div>
            </div>
        </div>

    </div><!-- /wrapper -->
</div><!-- /contacts -->