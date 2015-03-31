<?php

function getExtension($filename) {
    return end(explode(".", $filename));
}

function getImage($link, $type) {
    $filename = $link;
    $percent = 0.5;
    if (getExtension($filename) == 'jpg' || getExtension($filename) == 'jpeg') {
        header('Content-type: image/jpeg');
    }
    if (getExtension($filename) == 'png') {
        header('Content-type: image/png');
    }
    if (getExtension($filename) == 'gif') {
        header('Content-type: image/gif');
    }

    list($width, $height) = getimagesize($filename);
    switch ($type) {
        case 1: //images for point (миниатюры)
            $newwidth = 130;
            $newheight = 60;
            break;
    }
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    if (getExtension($filename) == 'jpg' || getExtension($filename) == 'jpeg') {
        $source = imagecreatefromjpeg($filename);
    }
    if (getExtension($filename) == 'png') {
        $source = imagecreatefrompng($filename);
    }
    if (getExtension($filename) == 'gif') {
        $source = imagecreatefromgif($filename);
    }

    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    if (getExtension($filename) == 'jpg' || getExtension($filename) == 'jpeg') {
        imagejpeg($thumb);
    }
    if (getExtension($filename) == 'png') {
        imagepng($thumb);
    }
    if (getExtension($filename) == 'gif') {
        imagegif($thumb);
    }
}

if ($_GET['key'] and ! $_GET['type'])
    getImage($_GET['key']);
elseif ($_GET['key'] and $_GET['type'])
    getImage($_GET['key'], $_GET['type']);
?>