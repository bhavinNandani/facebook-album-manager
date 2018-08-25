<?php 
  require_once 'easyGoogle.php';
  
if(!session_id()){
    session_start();
    
// Get access token from session

}?>
<?php if($_GET["type"] == 'all')
{
    foreach($_SESSION['fbAlbumData'] as $data)
    {
        $id = isset($data['id'])?$data['id']:''; //album Id
        $name2 = isset($data['name'])?$data['name']:''; //album name
        $access_token = $_SESSION['access_token'];
        $graphPhoLink = 'https://graph.facebook.com/v3.1/'.$id.'/photos?access_token='.$access_token.'&limit=999&fields=source,images,name';
        $jsonData = file_get_contents($graphPhoLink);
        $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
        $fbPhotoData = $fbPhotoObj['data'];
        
         $i = 0;
        
        
        if($googledrive->isLoggedIn() != true){
    	    echo $googledrive->easy_login();
        	
        }
        else{
        	$parent = $googledrive->easy_createFolder('facebook_'.$_SESSION['userData']['name'].'_albums');
            $child = $googledrive->easy_createChildFolder($parent,$name2);
            $childsChild = $googledrive->easy_createChildFolder($child,date('m/d/Y h:i:s a', time()));
        
            // Render all photos
            foreach($fbPhotoData as $data)
            {
                $imageData = end($data['images']);
                $imgSource = isset($imageData['source'])?$imageData['source']:'';
                $name = isset($data['name'])?$data['name']:'';
                
                
                array_push($googleData,($imgSource));
            //    print_r ($googleData);
              
                
            }
              $googledrive->easy_upload($childsChild, $googleData);
        
        }
        
    }
}
else
{ ?>
    <?php  
    // Get album id from url
    $album_id = isset($_GET['album_id'])?$_GET['album_id']:header("Location: index.php");
    $album_name = isset($_GET['album_name'])?$_GET['album_name']:header("Location: index.php");
    
    $access_token = $_SESSION['access_token'];
    
    // Get photos of Facebook page album using Facebook Graph API
    $graphPhoLink = "https://graph.facebook.com/v3.1/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
    
    //$graphPhoLink = "https://graph.facebook.com/v3.1/{$album_id}?fields=id,name,count,photos.limit(1000){images}&access_token={$access_token}";
     
    $jsonData = file_get_contents($graphPhoLink);
    $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
    
    // Facebook photos content
    $fbPhotoData = $fbPhotoObj['data'];
    
    $googleData = array();
    $i = 0;
    
    if($googledrive->isLoggedIn() != true){
    	echo $googledrive->easy_login();
    	
    }
    else{
    	$parent = $googledrive->easy_createFolder('facebook_'.$_SESSION['userData']['name'].'_albums');
        $child = $googledrive->easy_createChildFolder($parent,$album_name);
        $childsChild = $googledrive->easy_createChildFolder($child,date('m/d/Y h:i:s a', time()));
    
        // Render all photos
        foreach($fbPhotoData as $data)
        {
            $imageData = end($data['images']);
            $imgSource = isset($imageData['source'])?$imageData['source']:'';
            $name = isset($data['name'])?$data['name']:'';
            
            
            array_push($googleData,($imgSource));
        //    print_r ($googleData);
          
            
        }
          $googledrive->easy_upload($childsChild, $googleData);
    
    }


}//end of $Get check
?>
<script>
window.alert("Album uploaded successfully");
 //window.setTimeout( function(){ window.location = "../index.php";  }, 10 );
</script>

  



