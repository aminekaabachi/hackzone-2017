<?php
set_time_limit(0);

$Z = 4;
$image = imagecreate(64*3,64*3);
$result = imagecreatefromjpeg("Imager.jpg");

    ob_start();
 imagejpeg($result);
  $res = ob_get_contents();
    ob_end_clean();
	
$im1 = imagecreate(64,64);
$im2 = imagecreate(64,64);
$im3 = imagecreate(64,64);
$im4 = imagecreate(64,64);
$im5 = imagecreate(64,64);
$im6 = imagecreate(64,64);
$hobby = array();
$hobby = array_merge(range('a','z'),range('A','Z'),range('0','9'));
foreach ($hobby as $char1)
foreach ($hobby as $char2)
foreach ($hobby as $char3)
foreach ($hobby as $char4) {

						$text = $char1.$char2.$char3.$char4;

$a = hash("sha256",$text);

$c = "";
for ($k = 0;$k < $Z;$k++) {
	$m = 0;
	for($i = $k;$i <= strlen($a)- $Z + 1;$i = $i + $Z - 1)
		$m += $m + ord($a[$i+$k]);
	$m = $m / (strlen($a)/$Z);
	$c .= chr($m);
}
$b = md5($text);
$d = "";
for ($k = 0;$k < $Z;$k++) {
	$m = 0;
	for($i = $k;$i <= strlen($b)- $Z + 1;$i = $i + $Z - 1)
		$m += $m + ord($a[$i+$k]);
	$m = $m / (strlen($a)/$Z);
	$d .= chr($m);
}
$crypt = [0,0,0,0];
for ($k = 0;$k < $Z;$k++)
	$crypt[$k] = ((ord($c[$k])+ord($d[$k]))/2);

imagecolorallocate($image, 255, 255, 255);
imagecolorallocate($im1, intval($crypt[0]), intval($crypt[1]), intval($crypt[2]));
imagecolorallocate($im2, intval($crypt[1]), intval($crypt[2]), intval($crypt[3]));
imagecolorallocate($im3, intval($crypt[2]), intval($crypt[3]), intval($crypt[1]));
imagecolorallocate($im4, intval($crypt[0]), intval($crypt[1]), intval($crypt[2]));
imagecolorallocate($im5, intval($crypt[3]), intval($crypt[0]), intval($crypt[2]));
imagecolorallocate($im6, intval($crypt[3]), intval($crypt[1]), intval($crypt[2]));

imagecopy($image,$im1,64,0,0,0,64,64);
imagecopy($image,$im2,0,64,0,0,64,64);
imagecopy($image,$im3,128,64,0,0,64,64);
imagecopy($image,$im4,0,128,0,0,64,64);
imagecopy($image,$im5,64,128,0,0,64,64);
imagecopy($image,$im6,128,128,0,0,64,64);
    ob_start();
 imagejpeg($image);
  $out = ob_get_contents();
    ob_end_clean();
 if (md5($out) == md5($res)) {
	echo $text;
	exit;
 }
}
?>