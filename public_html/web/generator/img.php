<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require "gd-text/Box.php";
require "gd-text/Color.php";
require "gd-text/TextWrapping.php";
require "gd-text/VerticalAlignment.php";
require "gd-text/HorizontalAlignment.php";
use GDText\Box;
use GDText\Color;

$color_hex = hexToRgb($_POST['color']);

$im = imagecreatefromjpeg('images/'.$_POST['fon'].'.jpg');
//$backgroundColor = imagecolorallocate($im, 0, 18, 64);
//imagefill($im, 0, 0, $backgroundColor);

$box = new Box($im);
$box->setFontFace(__DIR__.'/fonts/myriad-set-pro_bold.ttf'); // http://www.dafont.com/minecraftia.font
$box->setFontColor(new Color($color_hex['red'], $color_hex['green'], $color_hex['blue']));
$box->setTextShadow(new Color(0, 0, 0, 50), 2, 2);
$box->setFontSize($_POST['size']*6);
$box->setLineHeight(1.2);
//$box->enableDebug();
$box->setBox(100, 100, 1800, 1800);
$box->setTextAlign($_POST['centr'], 'center');
$box->draw($_POST['text']);


$file = 'tmp/generated.png';

imagepng($im, $file, 9, PNG_ALL_FILTERS);
//imagepng($img, 'tmp/generated.jpg'); //, 'tmp/generated.jpg'
// Контент-тип означающий скачивание
header("Content-Type: application/octet-stream");
// Размер в байтах
header("Accept-Ranges: bytes");
// Размер файла
header("Content-Length: ".filesize($file));
// Расположение скачиваемого файла
header("Content-Disposition: attachment; filename=".$file);  
// Прочитать файл
readfile($file);
//echo '<img src="tmp/generated.jpg" width=900>';
imagedestroy($im);
return;

function hexToRgb($color) {
    // проверяем наличие # в начале, если есть, то отрезаем ее
    if ($color[0] == '#') {
        $color = substr($color, 1);
    }
   
    // разбираем строку на массив
    if (strlen($color) == 6) { // если hex цвет в полной форме - 6 символов
        list($red, $green, $blue) = array(
            $color[0] . $color[1],
            $color[2] . $color[3],
            $color[4] . $color[5]
        );
    } elseif (strlen($color) == 3) { // если hex цвет в сокращенной форме - 3 символа
        list($red, $green, $blue) = array(
            $color[0]. $color[0],
            $color[1]. $color[1],
            $color[2]. $color[2]
        );
    }else{
        return false; 
    }
 
    // переводим шестнадцатиричные числа в десятичные
    $red = hexdec($red); 
    $green = hexdec($green);
    $blue = hexdec($blue);
     
    // вернем результат
    return array(
        'red' => $red, 
        'green' => $green, 
        'blue' => $blue
    );
}
?>