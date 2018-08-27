<?php
	$id = $_GET["id"] ;
	
	$zipCheck='images/'.$id.'.zip';
	$zipPath='images/'.$id.'';
	
	if(!is_dir($zipCheck))
	{
	  unlink($zipCheck);
	}
	 deleteDir($zipPath);
	  
	  
	   function deleteDir($dirPath) {
	    if (! is_dir($dirPath)) {
	      //  throw new InvalidArgumentException("$dirPath must be a directory");
	    }
	    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
	        $dirPath .= '/';
	    }
	    $files = glob($dirPath . '*', GLOB_MARK);
	    foreach ($files as $file) {
	        if (is_dir($file)) {
	            deleteDir($file);
	        } else {
	            unlink($file);
	        }
	    }
	    rmdir($dirPath);
	}
	  
	?>
<script>
	window.alert("All zip has been Zip removed");
	window.setTimeout( function(){                 window.location = "/../index.php";             }, 1 );
</script>
