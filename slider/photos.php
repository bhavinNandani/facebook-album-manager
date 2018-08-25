<?php 
if(!session_id()){
    session_start();
}
?>
<?php


// Get album id from url
$album_id = isset($_GET['album_id'])?$_GET['album_id']:header("Location: index.php");
$album_name = isset($_GET['album_name'])?$_GET['album_name']:header("Location: index.php");

// Get access token from session
$access_token = $_SESSION['access_token'];

// Get photos of Facebook page album using Facebook Graph API
//$graphPhoLink = "https://graph.facebook.com/v3.1/{$album_id}/photos?fields=source,images,name&access_token={$access_token}";

$graphPhoLink = 'https://graph.facebook.com/v3.1/'.$album_id.'/photos?access_token='.$access_token.'&limit=100&fields=source,images,name';
$jsonData = file_get_contents($graphPhoLink);
$fbPhotoObj = json_decode($jsonData, true, 512, JSON_BIGINT_AS_STRING);

// Facebook photos content
$fbPhotoData = $fbPhotoObj['data'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Full-featured Image Viewer/Gallery Plugin Example</title>
    <link href="css/lightgallery.css" rel="stylesheet">
    </head>
    <body>
        <h1>Full-featured Image Viewer/Gallery Plugin Example</h1>
        <div class="jquery-script-ads" style="margin:30px auto"><script type="text/javascript"><!--

//-->
</script>

</div>

<h4>Album name :<?php 
    echo $_GET['album_name'];
?>
<h4>





<?php
// Render all photos
$i = 0;
foreach($fbPhotoData as $data){
    $imageData = end($data['images']);
    $imgSource = isset($imageData['source'])?$imageData['source']:'';
    $name = isset($data['name'])?$data['name']:'';
    
    
    	$dataa = file_get_contents($imgSource);
    	$fileName = $album_name.'/'.$i.'.jpg';
    	
    	//($fileName, $dataa);
//    echo "<div class='fb-album'>";
 //   echo "<img src='{$imgSource}' alt=''  height='200' width='250'>";
  //  echo "<p>{$name}</p>";
//    echo "</div>";
   
echo "     <div class='demo-gallery'>";
      echo "      <ul id='lightgallery' class='list-unstyled row'>";
            echo "    <li class='col-xs-6 col-sm-4 col-md-3' data-responsive=$imgSource data-src='{$imgSource}' data-sub-html='<h4>Fading Light</h4><p>TAG HERE</p>'>";
                  echo "  <a href=''>";
                    echo "    <img class='img-responsive' src='{$imgSource}'></a></li>";
	
	
	

}
 print_r($dataRes) ;


?>
 </ul>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script>
        <script type="text/javascript">
        $(document).ready(function(){
            $('#lightgallery').lightGallery();
        });
        </script>
        <script src="js/lightgallery-all.min.js"></script>
    </body>
    <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</html>

