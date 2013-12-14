<?php
// ###############################################################
// ##                                                           ##
// ##	http://sites.google.com/site/pavelbaco/                 ##
// ##	Copyright (C) 2012,2013  Pavel Bačo   (killerman)		##
// ##	Copyright (C) 2012,2013  Jakub Pecháček (kumen) 		##
// ##                                                           ##
// ## This file is a part of xLiveCZ, this project doesnt have  ##
// ## any support from Xtreamer company and just be design for  ##
// ## realtek based players									    ##
// ###############################################################
//counter start
$file = "ulozto_counter.txt";
$count_my_page = ("/var/www/baco/".$file);
$hits = file($count_my_page);
$hits[0] ++;
$fp = fopen($count_my_page , "w");
fputs($fp , "$hits[0]");
fclose($fp);
//counter end
$key = $_POST["key"];
$kn = $_POST["kn"];


$t1 = explode('","', $kn);

$cnt = 0;
$cnt2 = 0;
$items = array();
foreach($t1 as $option)
{
	$t1 = explode('":"', $option);
	$items[$cnt2][$cnt] = decrypt($key, $t1[1]);
	$cnt ++;
	if($cnt == 5)
	{
		$cnt2 ++;
		$cnt = 0;
	}
}
echo "start==";
foreach($items as $option)
{
	$item_URL = $option[0];
	$size = $name = $lenght = $image = "";
	$t1 = explode('class="fileReset">', $option[4]);
	$t2 = explode('<img src="', $t1[1]);
	$t3 = explode('"', $t2[1]);
	$image = $t3[0];

	$t1 = explode('<div class="fileInfo">', $option[4]);
	$t2 = explode('<span class="fileSize">', $t1[1]);
	$t3 = explode(' <', $t2[1]);
	$size = $t3[0];
	$t4 = explode('>', $t3[1]);

	if($t4[0] == 'span class="fileTime"')
	{
		echo $t4[0];
		$t5 = explode('span class="fileTime">', $t3[1]);
		$t6 = explode('</span></span>', $t5[1]);
		$lenght = $t6[0];
	}else
	{
		$lenght = "???";
	}



	$t1 = explode('<div class="fileName">', $option[4]);
	$t2 = explode('">', $t1[1]);
	$t3 = explode('</a>', $t2[1]);
	$name = $t3[0];

	echo "|name:|".$name.";/;|size:|".$size.";/;|lenght:|".$lenght.";/;|image:|".$image.";/;|URL:|".$item_URL.";///;";
}
echo "==end";

function decrypt($key, $code)
{
	$bin = pack('H*', $code);
	$ot = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $bin, MCRYPT_MODE_ECB);
	$out = str_replace(array('?'),array(''),$ot);
return $out;
}
?>
