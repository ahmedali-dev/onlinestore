<?php
require_once __DIR__ . "/../../database/users.php";
trait cpa
{

    function cpa()
    {

        $userRepo = new userRepo();
        $model = $userRepo->getmodel();
        $_SESSION['cpa'] = $model->random(6);



        $font = __DIR__ . "/Roboto-Black.ttf";
        $img = imagecreate(300, 50);
        $black = imagecolorallocate($img, 0, 0, 0);
        $white = imagecolorallocate($img, 255, 255, 255);
        $red  = imagecolorallocate($img, 255, 51, 0);

        $height = imagesy($img) / 2.2;
        $tsize = imagettfbbox(30, 0, $font, $_SESSION['cpa']);

        $x = $tsize[0] + (imagesx($img) / 2) - ($tsize[4] / 2) - 5;
        $y = $tsize[1] + (imagesy($img) / 2) - ($tsize[5] / 2) - 10;

        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($img, rand(0, 300), rand(0, 50), $white);
        }

        imagettftext($img, 30, 0, $x, $y, $red, $font, $_SESSION['cpa']);

        imagepng($img, __DIR__ . '/../../../public/assets/img/cpa.png');
        header("Content-Type: image/png");
        imagepng($img);
    }
}