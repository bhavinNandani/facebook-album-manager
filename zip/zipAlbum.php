<?php 
	if(!session_id()){
	    session_start();
	}
	// Get access token from session
	$access_token = $_SESSION['access_token'];?>
<?php  
	// Get album id from url
	if($_GET["type"] == 'all')
	{
	    
	    foreach($_SESSION['fbAlbumData'] as $data)
	    {
	        $id = isset($data['id'])?$data['id']:'';    ///albumId
	        $name2 = isset($data['name'])?$data['name']:''; //albumName
	
	        $graphPhoLink = 'https://graph.facebook.com/v3.1/'.$id.'/photos?access_token='.$access_token.'&limit=999&fields=source,images,name';
	        $jsonData = file_get_contents($graphPhoLink);
	        $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
	        
	        // Facebook photos content
	        $fbPhotoData = $fbPhotoObj['data'];
	       
	        $zipData = array();
	        $i = 0;
	        
	    //    $zip2 = new ZipArchive;
	    //    $res2 = $zip2->open('images/'.$_SESSION['userData']['id'].'.zip', ZipArchive::CREATE);
	        
	        // Render all photos
	        foreach($fbPhotoData as $data2)
	        {
	            $imageData = end($data2['images']);
	            $imgSource = isset($imageData['source'])?$imageData['source']:'';
	            //$name = isset($data2['name'])?$data2['name']:''; //caption
	            $i++;
	     
	            if(!dir('images/'.$_SESSION['userData']['id']))
	            {
	                mkdir('images/'.$_SESSION['userData']['id']);
	            }
	            else
	            {
	             //   echo "directory exists";
	            }
	        	$dataa = file_get_contents($imgSource);
	        	$fileName = $name2.'/'.$i.'.jpg';
	        	
	     
	        	$zip = new ZipArchive;
	        	$res = $zip->open('images/'.$_SESSION['userData']['id'].'/'.$name2.'.zip', ZipArchive::CREATE );
	        
	
	        	if ($res === TRUE) {
	        		$zip->addFromString($fileName, $dataa);
	        		$zip->close();
	      
	        	} else {
	        	
	        	}
	        
	        } //end of for loop album zip
	    }
	    
	    list_zipfiles('images/'.$_SESSION['userData']['id'].'/');
	}
	else
	{
	    $album_id = isset($_GET['album_id'])?$_GET['album_id']:header("Location: index.php");
	    $album_name = isset($_GET['album_name'])?$_GET['album_name']:header("Location: index.php");
	    
	    
	    // Get photos of Facebook page album using Facebook Graph API
	    //$graphPhoLink = "https://graph.facebook.com/v3.1/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";
	    
	    
	    $graphPhoLink = 'https://graph.facebook.com/v3.1/'.$album_id.'/photos?access_token='.$access_token.'&limit=9999&fields=source,images,name';
	    $jsonData = file_get_contents($graphPhoLink);
	    $fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);
	    
	    // Facebook photos content
	    $fbPhotoData = $fbPhotoObj['data'];
	    
	    $zipData = array();
	    $i = 0;
	    
	    // Render all photos
	    foreach($fbPhotoData as $data)
	    {
	        $imageData = end($data['images']);
	        $imgSource = isset($imageData['source'])?$imageData['source']:'';
	        $name = isset($data['name'])?$data['name']:'';
	        $i++;
	        if(!dir('images/'.$_SESSION['userData']['id']))
	        {
	            mkdir('images/'.$_SESSION['userData']['id']);
	        }
	    	$dataa = file_get_contents($imgSource);
	    	$fileName = $album_name.'/'.$i.'.jpg';
	    	$zip = new ZipArchive;
	    	$res = $zip->open('images/'.$_SESSION['userData']['id'].'/'.$album_name.'.zip', ZipArchive::CREATE);
	    	if ($res === TRUE) {
	    		$zip->addFromString($fileName, $dataa);
	    		$zip->close();
	    	
	    	} else {
	    	
	    	}
	    
	    }
	    
	
	}
	?>
<?php
	function list_zipfiles($mydirectory) {
		
		$zip = new ZipArchive;
		// directory we want to scan
		$dircontents = scandir($mydirectory);
		$files = array();
		// list the contents
		echo '';
		foreach ($dircontents as $file) {
			$extension = pathinfo($file, PATHINFO_EXTENSION);
			if ($extension == 'zip') {
			//	echo "$mydirectory";
			//	echo "$file ";
	        
	        		$dataa = file_get_contents($mydirectory.$file);
	        		 if ($zip->open('images/'.$_SESSION['userData']['id'].'.zip',ZipArchive::CREATE) === TRUE)
	        		 {
	                //$zip->addFile($mydirectory.$file);
	                $zip->addFromString($_SESSION['userData']['id'].'/'.$file,$dataa);
	           
	            	}
	             $zip->close();
	              //  echo 'ok';
	            } else {
	              //  echo 'failed';
	            }
			//	echo "<br><br><br><br>";
			}
		}
	?>
<script>
	window.alert("zip created");
	window.setTimeout( function(){                 window.location = "/../index.php";             }, 1 );
</script>
