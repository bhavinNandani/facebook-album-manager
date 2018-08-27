<?php
	require_once 'easy_googledrive.php';
	$googledrive = new easy_googledrive(array(
	'ClientId'=>'{google drive client id}',
	'ClientSecret'=>'{google drive client secret}',
	'AccessType' => 'offline',
	'RedirectUri' => '{Application redirected URL }'
	));
	
	$googledrive->easy_initialize();
	$googledrive->easy_token();
	
	
	?>
