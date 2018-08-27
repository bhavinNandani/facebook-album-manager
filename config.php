<?php
	session_start();	
	require_once __DIR__ . '/vendor/autoload.php';	
	$FB = new \Facebook\Facebook([
		'app_id' => '{Your facebook id here}',
		'app_secret' => '{Your facebook app secret}',
		'default_graph_version' => 'v3.1'
	]);
	$helper = $FB->getRedirectLoginHelper();
?>
