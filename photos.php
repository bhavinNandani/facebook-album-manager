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
<html>
	<head>
	    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<style>
			div.gallery {
			border: 1px solid #ccc;
			}
			div.gallery:hover {
			border: 1px solid #777;
			}
			div.gallery img {
			width: 100%;
			height: auto;
			}
			div.desc {
			padding: 15px;
			text-align: center;
			}
			* {
			box-sizing: border-box;
			}
			.responsive {
			padding: 0 6px;
			float: left;
			width: 24.99999%;
			}
			@media only screen and (max-width: 700px) {
			.responsive {
			width: 49.99999%;
			margin: 6px 0;
			}
			}
			@media only screen and (max-width: 500px) {
			.responsive {
			width: 100%;
			}
			}
			.clearfix:after {
			content: "";
			display: table;
			clear: both;
			}
		</style>
	</head>
	<body>
		<a href = "index.php">HOME</a>
		<h2>Responsive Image Gallery</h2>
		<h4>Resize the browser window to see the effect.</h4>
		<h4>
		Album name :<?php 
			echo $_GET['album_name'];
			?>
		<h4>
		<div class="container">
			<div class = "row">
				<div class="col-lg-12 ">
					<div class="card-columns">
						<?php
							// Render all photos
							foreach($fbPhotoData as $data){
							    $imageData = end($data['images']);
							    $imgSource = isset($imageData['source'])?$imageData['source']:'';
							    $name = isset($data['name'])?$data['name']:'';
							    
							//    echo "<div class='fb-album'>";
							 //   echo "<img src='{$imgSource}' alt=''  height='200' width='250'>";
							  //  echo "<p>{$name}</p>";
							//    echo "</div>";
							?>
						<div class="card">
							<?php    echo "<a href='#'>";
								echo "<img class='card-img-top' src='$imgSource' alt='Card image' height='230px' width='120px' alt='Card image cap'/></a> "; ?>
							<div class="card-body">
								<?php	echo "  <h5 class='card-title'>{$name}</h5>"; 
									//echo "<div class='responsive'><div class='gallery'>";
									  //  echo "<a target='_blank' href='{$imgSource}'>";
									//      echo "<img src='{$imgSource}' alt=''  height='200' width='250'>";
									 //   echo "</a><div class='desc'>{$name}</div> </div></div>";
									
									?>
							</div>
							<div class="card-footer">
<!--								<small class="text-muted"><a href='{$link}' target='_blank'>View on Facebook</a></p></small>-->
							</div>
						</div>
						<?php
							}
							?>
					</div>
				</div>
			</div>
		</div>
			<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	</body>
</html>