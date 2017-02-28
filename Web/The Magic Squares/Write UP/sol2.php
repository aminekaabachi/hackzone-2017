<?php
set_time_limit(0);

$Z = 4;

$hobby = array();
$hobby = array_merge(range('A','Z'),range('a','z'),range('0','9'));
foreach ($hobby as $char1)
foreach ($hobby as $char2)
foreach ($hobby as $char3)
foreach ($hobby as $char4) {

						$text = $char1.$char2.$char3.$char4;
echo $text."\n";
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

$sol = [146, 226, 199 , 58]; // a partir du programme jcpicker

 if ($crypt[0] == $sol[0] && $crypt[1] == $sol[1] && $crypt[2] == $sol[2] && $crypt[3] == $sol[3]) {
	echo $text;
	exit;
 }
}
?>