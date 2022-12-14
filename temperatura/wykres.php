<?php
header ('Content-Type: image/png');
$data = [
    '1' => 36.5,
    '2' => 36.6,
    '3' => 36.4,
    '4' => 36.2,
    '5' => 36.7,
    '6' => 36.0,
    '7' => 35.5,
    '8' => 35.2,
    '9' => 36.1,
    '10' => 36.3,
    '11' => 36.7,
    '13' => 36.3,
    '14' => 33,
    '15' => 36.4,
    '16' => 36.3,
    '17' => 36.7,
    '18' => 36.4,
    '19' => 36.3,
    '20' => 36.7,
    '21' => 36.4,
    '22' => 36.3,
    '23' => 36.7,
    '24' => 36.4,
    '25' => 36.4,
    '26' => 36.3,
    '27' => 36.7,
    '28' => 36.4,
];
$width = isset($_GET["width"]) ? $_GET["width"] : 800;
$height = isset($_GET["height"]) ? $_GET["height"] : 300;

$im = @imagecreatetruecolor($width, $height)
      or die('Cannot Initialize new GD image stream');
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$gray = imagecolorallocate($im, 128, 128, 128);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$dashed_gray = array($gray, $gray, $gray, $gray, $gray, $white, $white, $white, $white, $white);

$origin_x = 100;
$origin_y = 210;
$numberOfDays = isset($_GET["numberOfDays"]) ? $_GET["numberOfDays"] : 28;
imagefill($im, 0, 0, $white);
imagestringup($im, 5, 10, 170, "temperatura", $gray);
imagestring($im, 3, $origin_x-20, $origin_y-5-180, ".2", $black);
imagestring($im, 3, $origin_x-34, $origin_y-5-150, "37.0", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-120, ".8", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-90, ".6", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-60, ".4", $black);
imagestring($im, 3, $origin_x-34, $origin_y-5-30, "36.2", $black);
imageline($im, $origin_x-5, $origin_y, $origin_x+$numberOfDays*20+5, $origin_y, $black);
imageline($im, $origin_x, $origin_y+5, $origin_x, $origin_y-185, $black);
for($i = 1; $i <= $numberOfDays; $i+=1){
    imageline($im, $origin_x+$i*20, $origin_y+2, $origin_x+$i*20, $origin_y-2, $black);
    imagesetstyle($im, $dashed_gray);
    imageline($im, $origin_x+$i*20, $origin_y-2, $origin_x+$i*20, $origin_y-185, IMG_COLOR_STYLED);
    imagestring($im, 3, $origin_x+$i*20-5, $origin_y+10, $i, $black);
}
for($i = 1; $i <= 6; $i+=1){
    imageline($im, $origin_x+-2, $origin_y-30*$i, $origin_x+2, $origin_y-30*$i, $black);
    imagesetstyle($im, $dashed_gray);
    imageline($im, $origin_x+4, $origin_y-30*$i, $origin_x+$numberOfDays*20, $origin_y-30*$i, IMG_COLOR_STYLED);
    
}
imageline($im, $origin_x + 4, $origin_y-150, $origin_x+$numberOfDays*20, $origin_y-150, $red);

foreach($data as $i => $temp){
    if($temp <= 36 || $temp >= 37){
        imageellipse($im, $origin_x+$i*20, $origin_y, 8, 8, $red);  
    }else{
        imageellipse($im, $origin_x+$i*20, $origin_y-($temp-36)*150, 5, 5, $blue);
        if(isset($data[$i+1]) && ($data[$i+1] > 36 && $data[$i+1] < 37)){
            imageline($im, $origin_x+$i*20, $origin_y-($temp-36)*150, $origin_x+($i+1)*20, $origin_y-($data[$i+1]-36)*150, $blue);
            // imageline($im, $origin_x+$i*20, $origin_y-($temp-36)*150, $origin_x+($i+1)*20, $data[$i+1], $blue);
        }
    }
}
for($i = 1; $i <= $numberOfDays; $i++){
    if(!isset($data[$i]))
    imageellipse($im, $origin_x+$i*20, $origin_y, 8, 8, $gray);  
}
imagepng($im);
imagedestroy($im);
?>