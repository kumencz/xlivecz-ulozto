<?php
// ###############################################################
// ##                                                           ##
// ##   http://sites.google.com/site/pavelbaco/                 ##
// ##   Copyright (C) 2012  Pavel Bačo   (killerman)            ##
// ##   Copyright (C) 2012  Jakub Pecháček (kumen)              ##
// ##                                                           ##
// ###############################################################

$item_URL = "http://uloz.to".urldecode($_GET["url"]);
$input_URL = urldecode($_GET["url"]);

$HTTP_SCRIPT_ROOT = current(explode('scripts/', 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/')).'scripts/';
echo "<?xml version='1.0' encoding='UTF8' ?>\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";

extract($_POST);
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$item_URL);
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$html = curl_exec($ch);
curl_close($ch);

$ItemsOut = "\n<channel>\n<title>Uloz.to</title>";

  $cook = explode('Set-Cookie: ULOSESSID', $html);
  foreach ($cook as $name) {
    $t1 = explode('=', $name);
    $t2 = explode(';', $t1[1]);
    $ULOSESSID = $t2[0];
}

    $t1 = explode('Set-Cookie: uloztoid=', $html);
    $t2 = explode(';', $t1[1]);
    $uloztoid = $t2[0];

    $t1 = explode('<div class="freeDownloadForm"><form action="', $html);
    $t2 = explode('"', $t1[1]);
    $link = "http://uloz.to".$t2[0];

    $t1 = explode('<img  src="http://xapca', $html);
    $t2 = explode('"', $t1[1]);
    $captcha_url = "http://xapca".$t2[0];

    $t1 = explode('<input type="hidden" name="timestamp" value="', $html);
    $t2 = explode('"', $t1[1]);
    $timestamp = $t2[0];

    $t1 = explode('<input type="hidden" name="salt" value="', $html);
    $t2 = explode('"', $t1[1]);
    $salt = $t2[0];

    $t1 = explode('<input type="hidden" name="hash" value="', $html);
    $t2 = explode('"', $t1[1]);
    $hash = $t2[0];

    $t1 = explode('<div><input type="hidden" name="_token_" id="frmfreeDownloadForm-_token_" value="', $html);
    $t2 = explode('"', $t1[1]);
    $token = $t2[0];

    $t1 = explode('<input type="hidden" name="ts" id="frmfreeDownloadForm-ts" value="', $html);
    $t2 = explode('"', $t1[1]);
    $ts = $t2[0];

    $t1 = explode('<input type="hidden" name="cid" id="frmfreeDownloadForm-cid" value="', $html);
    $t2 = explode('"', $t1[1]);
    $cid = $t2[0];

    $t1 = explode('<input type="hidden" name="sign" id="frmfreeDownloadForm-sign" value="', $html);
    $t2 = explode('"', $t1[1]);
    $sign = $t2[0];


    $ItemsOut .= "
		<item>
			<title>Zadej kód z obrázku</title>
			<pubDate>Opište písmena z obrázku (stačí malými písmeny)</pubDate>
			<link>rss_command://search</link>
			<search url=\"".$HTTP_SCRIPT_ROOT."xLiveCZ/ulozto/ulozto_link_final_2.php?query=%s,".$timestamp.",".$salt.",".$hash.",".$token.",".$ts.",".$cid.",".$sign.",".$uloztoid.",".$ULOSESSID.",".$link."\" />
			<media:thumbnail url=\"".$captcha_url."\" />
		</item>\n
		<item>
			<title>Načíst jiný obrázek</title>
			<pubDate>Načte jiný obrázek na opsání kódu (pokud je nečitelný)</pubDate>
			<link>".$HTTP_SCRIPT_ROOT."xLiveCZ/ulozto/ulozto_link.php?url=".$input_URL."</link>
		</item>\n";

$ItemsOut .= "</channel>\n</rss>";
echo $ItemsOut;
?>
