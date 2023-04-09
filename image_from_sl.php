<?php
$data = 'http://asset-cdn.glb.agni.lindenlab.com/?texture_id=' . urlencode($_GET['uuid']);
$im = imagecreatefromstring(file_get_contents($data));
if ($im !== false) {
    header('Content-Type: image/jpeg');
    imagejpeg($im);
    imagedestroy($im);
}
else {
    echo 'An error occurred.';
}