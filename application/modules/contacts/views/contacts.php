<div class="page-header">
    <h2>Редактирование модуля "<?= $module_name ?>"</h2>
</div>
<div class="row" style="margin-bottom: 5px;">
    <div class="col-md-12">
        <?= validation_errors(); ?>
        <?php
        if ($this->session->userdata('error')) {
            echo $this->session->userdata('error');
        }
        $this->session->unset_userdata('error');
        ?>
    </div>
</div>
<?= form_open_multipart('admin/' . $module . '/edit/1') ?>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="adress">Адрес</label>
            <input required name='adress' value="<?= $entry['adress'] ?>" type="text" class="form-control" id="adress" placeholder="ул. Байтик-Батыра 109">
        </div>
        <div class="form-group">
            <label for="phone">Телефон(ы)</label>
            <input required name='phone' value="<?= $entry['phone'] ?>" type="text" class="form-control" id="phone" placeholder="+996 312 541 789">
        </div>
        <div class="form-group">
            <label for="email">E-mail адрес</label>
            <input required name='email' value="<?= $entry['email'] ?>" type="email" class="form-control" id="email" placeholder="email@domain.com">
        </div>
        <div class="page-header">
            <h2>Ссылки на соц. сети</h2>
        </div>
        <div class="form-group">
            <label for="text">Текст</label>
            <textarea required name='social_text' class="form-control" id="text"><?= $entry['social_text'] ?></textarea>
        </div>
        <div class="input-group">
            <span class="input-group-addon">vk.com/</span>
            <input name="social_vk" type="text" placeholder="" class="form-control" value="<?= $entry['social_vk'] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">fb.com/</span>
            <input name="social_fb" type="text" placeholder="" class="form-control" value="<?= $entry['social_fb'] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">twitter.com/</span>
            <input name="social_tw" type="text" placeholder="" class="form-control" value="<?= $entry['social_tw'] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">ok.ru/</span>
            <input name="social_ok" type="text" placeholder="" class="form-control" value="<?= $entry['social_ok'] ?>">
        </div>
        <div class="input-group">
            <span class="input-group-addon">instagram.com/</span>
            <input name="social_insta" type="text" placeholder="" class="form-control" value="<?= $entry['social_insta'] ?>">
        </div>
    </div>
    <div class="col-md-6">
        <label for="email">Адрес на карте</label>
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
                    draggable: true,
                    position: myLatlng,
                    map: map,
                    title: 'Перетащи!'
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
        <input id="coords" type="hidden" name="coords" value="(<?= $entry['coords'] ?>)">
    </div>
</div>
<div class="row" style="margin-top: 10px;">
    <div class="col-md-12">
        <input type="hidden" name="do" value="<?= $module ?>Edit">
        <button type="submit" class="btn btn-default">Сохранить</button>
    </div>
</div>
