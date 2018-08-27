<?php
	require_once "config.php";
	
	try {
		$accessToken = $helper->getAccessToken();
		  $_SESSION['FBRLH_state']=$_GET['state'];
	} catch (\Facebook\Exceptions\FacebookResponseException $e) {
		echo "Response Exception: " . $e->getMessage();
		exit();
	} catch (\Facebook\Exceptions\FacebookSDKException $e) {
		echo "SDK Exception: " . $e->getMessage();
		exit();
	}
	
	if (!$accessToken) {
		header('Location: login.php');
		exit();
	}
	
	$oAuth2Client = $FB->getOAuth2Client();
	if (!$accessToken->isLongLived())
		$accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
	
	 
	$response = $FB->get("/me?fields=id, name, email,picture.type(large)", $accessToken);
	$userData = $response->getGraphNode()->asArray();
	$_SESSION['userData'] = $userData;
	
	
	/*
	 for ( $i = 0; $i < sizeof($_SESSION['albumName']['albums']); $i++)
	     {
	           $response4 = $FB->get("".$_SESSION['albumName']['albums'][$i]['id']."?fields=photos") ;  
	           $albumId = $response4->getGraphNode()->asArray();
	           $_SESSION['album'.$i] = $albumId;
	        
	           $response5 = $FB->get("".$_SESSION['albumName']['albums'][$i]['cover_photo']['id']."?fields=images") ;  
	           $coverId = $response5->getGraphNode()->asArray();
	           $_SESSION['cover'.$i] = $coverId;
	           
	       }
							            
	*/
	
	   //-----
	   // Get photo albums of Facebook page using Facebook Graph API
	   $fields = "id,name,description,link,cover_photo,count";
	   
	   $graph_album_link = "https://graph.facebook.com/v3.1/me/albums?fields={$fields}&access_token={$accessToken}";
	   
	   $jsonData = file_get_contents($graph_album_link);
	   $fbAlbumObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
	   
	   // Facebook albums content
	   $_SESSION['fbAlbumData'] = $fbAlbumObj['data'];
	   
	//-------
	
	$_SESSION['access_token'] = (string) $accessToken;
	header('Location: index.php');
	exit();
	?>
