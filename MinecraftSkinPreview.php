<?php
$url = null;

if(isset($_GET['pseudo']) && $_GET['pseudo'] != null)
	$url = 'http://s3.amazonaws.com/MinecraftSkins/' . $_GET['pseudo'] . '.png';
else if(isset($_GET['skin']) && $_GET['skin'] != null)
	$url = $_GET['skin'];

if(is404($url) || $url == null)
	$url = 'char.png';

$skin = imagecreatefrompng($url);
$preview = imagecreatetruecolor(16, 32);

$transparent = imagecolorallocatealpha($preview, 255, 255, 255, 127);
imagefill($preview, 0, 0, $transparent);

//face
imagecopy($preview, $skin, 4, 0, 8, 8, 8, 8);

//chest
imagecopy($preview, $skin, 4, 8, 20, 20, 8, 12);

//arms
imagecopy($preview, $skin, 0, 8, 44, 20, 4, 12);
imagecopy($preview, $skin, 12, 8, 44, 20, 4, 12);

//legs
imagecopy($preview, $skin, 4, 20, 4, 20, 4, 12);
imagecopy($preview, $skin, 8, 20, 4, 20, 4, 12);
	
//armor
imagecopy($preview, $skin, 4, 0, 40, 8, 8, 8);

imagedestroy($skin);

$fullsize = imagecreatetruecolor(200, 400);
imagesavealpha($fullsize, true);
$transparent = imagecolorallocatealpha($fullsize, 255, 255, 255, 127);
imagefill($fullsize, 0, 0, $transparent);

imagecopyresized($fullsize, $preview, 0, 0, 0, 0, imagesx($fullsize), imagesy($fullsize), imagesx($preview), imagesy($preview));

header ("Content-type: image/png");
imagepng($fullsize);

function is404($url)
{
    $handle = curl_init($url);
    curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($handle);
    $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    curl_close($handle);

    if ($httpCode >= 200 && $httpCode < 300) {
        return false;
    } else {
        return true;
    }
}
?>