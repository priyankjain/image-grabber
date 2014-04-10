<?php
function curl($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_NOBODY,false);
    curl_setopt($curl, CURLOPT_HEADER,false);
    curl_setopt($curl, CURLOPT_TIMEOUT, 100);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close($curl);
    return $result;
}
$num=0;
$file=fopen("images.csv","r");
$path=getcwd();
while(!feof($file))
{	
	$num++;
	$url=fgets($file);
	$urls=explode(",",$url);
	$cleanurl=end($urls);
	$bits=explode("/",$cleanurl);
	$name=end($bits);
	$cleanurl="http://www.airventuri.com/images/acc/Air-Venturi-Scuba-Tank-Adapter--Hose-Assembly-1-8-BSPP-Female-Connector-Gauge_AV-00038.jpg";
	$imagestring=curl($cleanurl);
	$exts=explode(".",$name);
	$extension=$exts[1];
	$name=$path.'/images/'.$name;
	echo $name;
	if($extension=="jpeg" || $extension=="jpg")
	imagejpeg(imagecreatefromstring($imagestring),$name);
	else if($extension=="gif")
	imagegif(imagecreatefromstring($imagestring),$name);
	else if($extension=="png")
	imagepng(imagecreatefromstring($imagestring),$name);
	else if($extension=="webp")
	imagewebp(imagecreatefromstring($imagestring),$name);
	else if($extension=="xbm")
	imagexbm(imagecreatefromstring($imagestring),$name);
	else if($extension=="wbmp")
	imagewbmp(imagecreatefromstring($imagestring),$name);
	else if($extension=="gd")
	imagegd(imagecreatefromstring($imagestring),$name);
	else if($extension=="gd2")
	imagegd2(imagecreatefromstring($imagestring),$name);
	if(is_writeable($name)) echo 'Yes';else echo 'no';
	echo "Line".$num." : ".$name.'<br/>';	
}
fclose($file);
?>