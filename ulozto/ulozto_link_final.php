<?php
// ###############################################################
// ##                                                           ##
// ##   http://sites.google.com/site/pavelbaco/                 ##
// ##   Copyright (C) 2012  Pavel Bačo   (killerman)            ##
// ##   Copyright (C) 2012  Jakub Pecháček (kumen)              ##
// ##                                                           ##
// ###############################################################
$query= $_GET["query"];

if($query) {
    $queryArr = explode(',', $query);
    $captcha_value = $queryArr[0];
    $timestamp = $queryArr[1];
    $salt = $queryArr[2];
    $hash = $queryArr[3];
    $token = $queryArr[4];
    $ts = $queryArr[5];
    $cid = $queryArr[6];
    $sign = $queryArr[7];
    $uloztoid = $queryArr[8];
    $ULOSESSID = $queryArr[9];
    $url = $queryArr[10];
}

extract($_POST);

//set POST variables
$fields = array(
    'timestamp' => $timestamp,
    'salt' => $salt,
    'hash' => $hash,
    'captcha_value' => $captcha_value,
    '_token_' => $token,
    'ts' => $ts,
    'cid' => $cid,
    'sign' => $sign,
    );

//url-ify the data for the POST
$fields_string = "";
foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
rtrim($fields_string,'&');
//open connection
$ch = curl_init();

//set the url, number of POST vars, POST data
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HTTPHEADER, array('Content-length: '.strlen($fields_string),'Content-Type: application/x-www-form-urlencoded','X-Requested-With: XMLHttpRequest','Origin: http://uloz.to','Connection: keep-alive','Cookie: uloztoid='.$uloztoid.'; ULOSESSID='.$ULOSESSID.'; uloztoid2='.$uloztoid.';'));
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
//execute post
$result=curl_exec($ch);
curl_close($ch);
echo $result;
//close connection

echo "<?xml version='1.0' encoding='utf-8' ?>\n";
echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\n";
$ItemsOut = "<channel>\n<title>Uloz.to</title>";


$t1 = explode('{"status":"ok","version":"xapca","url":"', $result);
$t2 = explode('"}', $t1[1]);
$lnk = $t2[0];
$link = str_replace("\/","\\",$lnk);

$ItemsOut .= "
		<item>
			<title>Přehrát video</title>
			<link>".$link."</link>
			<pubDate>Potvrďte pro začátek přehrávání</pubDate>
			<enclosure type=\"video/mp4\" url=\"".$link."\"/>
		</item>\n";


$ItemsOut .= "</channel>\n</rss>";

echo $ItemsOut;
?>
