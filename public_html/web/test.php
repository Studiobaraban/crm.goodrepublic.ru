<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        function wordWrapAnnotation($image, $draw, $text, $maxWidth)
        {
            $words = preg_split('%\s%', $text, -1, PREG_SPLIT_NO_EMPTY);
            $lines = array();
            $i = 0;
            $lineHeight = 0;
            while (count($words) > 0)
            {
                $metrics = $image->queryFontMetrics($draw, implode(' ', array_slice($words, 0, ++$i)));
                $lineHeight = max($metrics['textHeight'], $lineHeight);

                if ($metrics['textWidth'] > $maxWidth or count($words) < $i)
                {
                    $lines[] = implode(' ', array_slice($words, 0, --$i));
                    $words = array_slice($words, $i);
                    $i = 0;
                }
            }

            return array($lines, $lineHeight);
        }

        function createImageFromText($text){

            $maxWidth = 180;
            $font = 'fonts/myriad-set-pro_bold.ttf';
            $fontSize = 50;
            $filename = 'text.png';
            $padding = 10;

            /* Create a new Imagick object */
            $image = new Imagick();
            $image->newImage(1, 1, 'none'); // none = transparent
            $image->setImageFormat("png");

            /* Create an ImagickDraw object */
            $draw = new ImagickDraw();

            /* Set the font */
            $draw->setFont($font);
            $draw->setFontSize($fontSize);

            list($lines, $lineHeight) = wordWrapAnnotation($image, $draw, $text, $maxWidth);
            $image->newImage($maxWidth+$padding, $padding+ count($lines)*$lineHeight, 'none'); // none = transparent    

            for($i = 0; $i < count($lines); $i++)
                $image->annotateImage($draw, $padding, + ($i+1)*$lineHeight, 0, $lines[$i]);

            //$image->writeImage($filename);
            return $image;
            
        }
/*
        createImageFromText('Новая')->writeImage('text.png');

        //Set the Content Type
        header ('Content-type: image/png');
        //\Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        //\Yii::$app->response->headers->add('content-type','image/png');


		// шаблонное изображение
		$dest = imagecreatefrompng('text.png');

		// обложка
		$src = imagecreatefromjpeg('txtfon.jpg');

		// настройка прозрачности и фильтров
		imagealphablending($dest, false);
		imagesavealpha($dest, true);

		// объединение изображений
		imagecopymerge($dest, $src, 10, 9, 0, 0, 181, 180, 100);
        
		// отображаем изображение		
		//$dest = imagecreatefrompng ('text.png');
		

        //\Yii::$app->response->data = //
        imagepng ($dest);

		// очищаем память
		imagedestroy($dest);
		imagedestroy($src);

*/
    $img = imagecreatefromjpeg('txtfon.jpg');
    $color = imageColorAllocate($img, 0, 0, 0);
    $size = getimagesize('txtfon.jpg');
    $font = 'fonts/myriad-set-pro_bold.ttf';
    $text = isset($_GET['text']) ? $_GET['text'] : "TEXT TEXT\nTEXT\nTEXT";
    $text_size = 50;
    //$lines = substr_count($text, "\n") + 1;

    $text_box = imageftbbox($text_size, 0, $font, $text);

    $width = $text_box[2] - $text_box[0];
    $height = $text_box[1] + $text_box[5];

    $x = ($size[0] - $width)/2;
    $y = ($size[1] - ($height))/2;
//var_dump($width,$height,$lines);
    imagettftext($img, $text_size, 0, $x, $y, $color, $font, $text);
    header("Content-type: image/png");
    imagepng($img);
    imagedestroy($img);

?>