<?php
header ('Content-Type: image/png');
$data = [ ];
$width = isset($_GET["width"]) ? $_GET["width"] : 675;
$height = isset($_GET["height"]) ? $_GET["height"] : 270;

$im = @imagecreatetruecolor($width, $height)
      or die('Cannot Initialize new GD image stream');
$black = imagecolorallocate($im, 0, 0, 0);
$white = imagecolorallocate($im, 255, 255, 255);
$gray = imagecolorallocate($im, 128, 128, 128);
$red = imagecolorallocate($im, 255, 0, 0);
$blue = imagecolorallocate($im, 0, 0, 255);
$dashed_gray = array($gray, $gray, $gray, $gray, $gray, $white, $white, $white, $white, $white);

$numberOfDays = isset($_GET["numberOfDays"]) ? $_GET["numberOfDays"] : 28;
$height_segments = 6;
$cell_x = $width/($numberOfDays+5);
$cell_y = $height/($height_segments+3);
$origin_x = $cell_x*3;
$origin_y = $cell_y*($height_segments+1);
imagefill($im, 0, 0, $white);
imagestringup($im, 5, $cell_x/2, $origin_y-(3*$cell_y)+50, "temperatura", $gray);
imagestring($im, 5, $origin_x+($numberOfDays*$cell_x)/2 - 30, $origin_y + $cell_y, "ilosc dni", $gray);
imagestring($im, 3, $origin_x-20, $origin_y-5-6*$cell_y, ".2", $black);
imagestring($im, 3, $origin_x-34, $origin_y-5-5*$cell_y, "37.0", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-4*$cell_y, ".8", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-3*$cell_y, ".6", $black);
imagestring($im, 3, $origin_x-20, $origin_y-5-2*$cell_y, ".4", $black);
imagestring($im, 3, $origin_x-34, $origin_y-5-1*$cell_y, "36.2", $black);
imageline($im, $origin_x-5, $origin_y, $origin_x+$numberOfDays*$cell_x+5, $origin_y, $black);
imageline($im, $origin_x, $origin_y+5, $origin_x, $origin_y-5-6*$cell_y, $black);
for($i = 1; $i <= $numberOfDays; $i+=1){
    imageline($im, $origin_x+$i*$cell_x, $origin_y+2, $origin_x+$i*$cell_x, $origin_y-2, $black);
    imagesetstyle($im, $dashed_gray);
    imageline($im, $origin_x+$i*$cell_x, $origin_y-2, $origin_x+$i*$cell_x, $origin_y-5-6*$cell_y, IMG_COLOR_STYLED);
    imagestring($im, 3, $origin_x+$i*$cell_x-5, $origin_y+10, $i, $black);
}
for($i = 1; $i <= 6; $i+=1){
    imageline($im, $origin_x+-2, $origin_y-$cell_y*$i, $origin_x+2, $origin_y-$cell_y*$i, $black);
    imagesetstyle($im, $dashed_gray);
    imageline($im, $origin_x+4, $origin_y-$cell_y*$i, $origin_x+$numberOfDays*$cell_x, $origin_y-$cell_y*$i, IMG_COLOR_STYLED);
    
}
imageline($im, $origin_x + 4, $origin_y-5*$cell_y, $origin_x+$numberOfDays*$cell_x, $origin_y-5*$cell_y, $red);

include("hidden.php");
$mysqli = mysqli_connect($db_hostname, $db_username, $db_password, $db_name);
$result = mysqli_query($mysqli, "SELECT * FROM dane");
$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
foreach($rows as $row){
    $data[$row["dzien"]] = $row["wartosc"];
}

foreach($data as $i => $temp){
    if($temp <= 36 || $temp >= 37){
        imageellipse($im, $origin_x+$i*$cell_x, $origin_y, 8, 8, $red);  
    }else{
        imageellipse($im, $origin_x+$i*$cell_x, $origin_y-($temp-36)*5*$cell_y, 5, 5, $blue);
        if(isset($data[$i+1]) && ($data[$i+1] > 36 && $data[$i+1] < 37)){
            imageline($im, $origin_x+$i*$cell_x, $origin_y-($temp-36)*5*$cell_y, $origin_x+($i+1)*$cell_x, $origin_y-($data[$i+1]-36)*5*$cell_y, $blue);
            // imageline($im, $origin_x+$i*$cell_x, $origin_y-($temp-36)*5*$cell_y, $origin_x+($i+1)*$cell_x, $data[$i+1], $blue);
        }
    }
}
for($i = 1; $i <= $numberOfDays; $i++){
    if(!isset($data[$i]))
    imageellipse($im, $origin_x+$i*$cell_x, $origin_y, 8, 8, $gray);  
}
imagepng($im);
imagedestroy($im);
?>