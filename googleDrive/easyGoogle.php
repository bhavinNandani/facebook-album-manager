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

/*if($googledrive->isLoggedIn() != true){
	echo $googledrive->easy_login();
	
}else{
	
	$parent = $googledrive->easy_createFolder('facebook_'.'dishitpala'.'_albums');
	$child = $googledrive->easy_createChildFolder($parent,'Profile_Picture');
	$childsChild = $googledrive->easy_createChildFolder($child,date('m/d/Y h:i:s a', time()));
    */
//	$googledrive->easy_upload($childsChild,['photo.png','https://scontent.famd1-1.fna.fbcdn.net/v/t31.0-0/c0.0.853.316/p480x480/11709969_861248903958371_8420225119561361857_o.jpg?_nc_cat=0&oh=32be1aaf95bf8ef4ba676d4c167811cd&oe=5C0AE9B4']);
	
//}
?>
