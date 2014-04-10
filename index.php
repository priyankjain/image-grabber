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
	$cleanurl=str_replace("\n","",$cleanurl);
	$bits=explode("/",$cleanurl);
	$name=end($bits);
	$imagestring=curl($cleanurl);
	$exts=explode(".",$name);
	$extension=$exts[1];
	$name=$path.'/images/'.$name;
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
	$created='not';
	if(file_exists($name)) $created='';

	echo "Line".$num." : ".$name.' Image '.$created.' created'.'<br/>';	
}
fclose($file);
?>