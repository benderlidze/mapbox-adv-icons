<?php
error_reporting(E_ALL|E_STRICT);
ini_set('display_errors', true);
header("Access-Control-Allow-Origin: *");


if(isset($_GET['lat'])){
	$lat = $_GET['lat'];
	$lon = $_GET['lon'];
	$zoomLevel = $_GET['zoomLevel'];
	$epoch = $_GET['epoch'];
	$radius = $_GET['radius'];
	
	
	$url = "https://ms.sc-jpl.com/web/getPlaylist";
	$postdata = '{
		"requestGeoPoint":
		{"lat":'.$lat.',"lon":'.$lon.'},
		"zoomLevel":'.$zoomLevel.',
		"tileSetId":{"flavor":"default","epoch":'.$epoch.',"type":1},
		"radiusMeters":'.$radius.',
		"maximumFuzzRadius":0
	}';
	
	
	//$postdata='{"requestGeoPoint":{"lat":31.3717087370554,"lon":-99.52508966336131},"zoomLevel":5.767746505856351,"tileSetId":{"flavor":"default","epoch":1627321287000,"type":1},"radiusMeters":82512.13993793353,"maximumFuzzRadius":0}';
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);
	curl_close($ch);
}else{
	
	$postdata = '{}';
	$url = "https://ms.sc-jpl.com/web/getLatestTileSet";
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	$result = curl_exec($ch);
	curl_close($ch);
}

?>