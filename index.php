<?php
	//set_time_limit(5000);
	//index.php
	    session_start();
	    require_once 'googleDrive/easyGoogle.php';
		require_once __DIR__ . '/vendor/autoload.php';
	//	require_once 'User.php'; // for adding user data to the database
		require_once 'Function.php'; //function file
		if (!isset($_SESSION['access_token'])) {
			header('Location: login.php');
			exit();
		}
	
	?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>FB-ALBUM</title>
	</head>
	<body>
		<?php // Start of navbar ?>
		<nav class="navbar navbar-expand-lg  bg-light ">
			<a class="navbar-brand" href="#"><img  src='icon/fbMain.png'  alt='Logo' style='width:25px'></a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav mr-auto justify-content-center">
					<li class="nav-item active">
						<a href="index.php">
							<p class="text-center">Assignment</p>
						</a>
					</li>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<li class="nav-item"><a href="#"></a></li>
					<?php 	if (isset($_SESSION['access_token'])) 
						{ 
						    ?>
					<li class="nav-item "><a href="#"><button type='button' class="btn btn-outline-primary btn-sm"><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>connected</button></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<?php } else
						{ ?>
					<li class="nav-item"><a href="#"><button type='button'  class='btn btn-outline-danger btn-sm'><i class="fa fa-facebook-official fa-2x" aria-hidden="true"></i>NOT Connected</button></a></li>
					&nbsp;&nbsp;&nbsp;&nbsp;
					<?php } ?>
					<li class="nav-item"><a href="#"></a></li>
					<?php 	if($googledrive->isLoggedIn())
						{ ?>
					<li class="nav-item "><a href="#"><button type='button' class="btn btn-outline-primary btn-sm"><i class="fa fa-google fa-2x" aria-hidden="true"></i>connected</button></a></li>
					<?php } else 
						{ ?>
					<li class="nav-item"><a href="<?php echo $googledrive->easy_login() ; ?>"><button type='button'  class='btn btn-outline-danger btn-sm'><i class="fa fa-google fa-2x" aria-hidden="true"></i>Not connected</button></a></li>
					<?php }
						$zipAllLink = "zip/zipAlbum.php?type=all";    
						$googleDriveAll = "googleDrive/upload.php?type=all"; 
						?>
						
				</ul>
				<ul class="nav navbar-nav navbar-right">
				    <li class="nav-item active">
						    <?php $id = $_SESSION['userData']['id']?>
						<?php echo"<a href='zip/removeZip.php?id=$id'>"; ?>
							<p class="text-center">REMOVE</p>
						</a>
					</li>
					
				
					<li>&nbsp;&nbsp;&nbsp;</li>
					<?php
						$zipCheck='zip/images/'.$_SESSION['userData']['id'].'.zip';
						if(file_exists($zipCheck))
						{
						  echo " <a href= '$zipCheck' download><button type='button'  class='btn btn-default btn-sm bg-primary'><span class='glyphicon glyphicon-save-file'></span>Download All</button></a>&nbsp;&nbsp;&nbsp;";  	
						}
						else
						{	
						 echo " <a href= '$zipAllLink' ><button type='button'  class='btn btn-default btn-sm'><span class='glyphicon glyphicon-save-file'></span>Zip All</button></a>&nbsp;&nbsp;&nbsp;";  	
						 
						}
						?>
						<li>&nbsp;&nbsp;&nbsp;</li>
<?php if($googledrive->isLoggedIn())
   {
        echo "<a href= '$googleDriveAll' ><button type='button'  class='btn btn-default btn-sm bg-primary'><span class='glyphicon glyphicon-save-file'></span>&nbsp;&nbsp;Move to google</button></a>";
    } else 
   { 
       ?><a href="<?php echo $googledrive->easy_login() ; ?>"><button type='button'  class='btn btn-default btn-sm bg-light' ><span class='glyphicon glyphicon-save-file'></span>Move to google</button></a>
<?php	 } ?>
					
					<li>&nbsp;&nbsp;&nbsp;</li>
					<li><a href="logout.php"><i class="fa fa-sign-out fa-2x" aria-hidden="true"></i> LOGOUT</a></li>
				</ul>
			</div>
		</nav>
		<br/><br/><br/><br/><br/>
		<?php // end of navbar ?>
		<div class="container">
			<div class = "row">
				<div class="col-lg-12 ">
					<div class="card-columns">
						<?php
							// Render all photo albums
							
							foreach($_SESSION['fbAlbumData'] as $data)
							{
							    $id = isset($data['id'])?$data['id']:'';
							    $name = isset($data['name'])?$data['name']:'';
							    $description = isset($data['description'])?$data['description']:'';
							    $link = isset($data['link'])?$data['link']:'';
							    $cover_photo_id = isset($data['cover_photo']['id'])?$data['cover_photo']['id']:'';
							    $count = isset($data['count'])?$data['count']:'';
							   
							    $pictureLink = "photos.php?album_id={$id}&album_name={$name}";  
							    
							    $zipLink = "zip/zipAlbum.php?album_id={$id}&album_name={$name}";    
							    $googleDrive = "googleDrive/upload.php?album_id={$id}&album_name={$name}";    
							   
							    $zipFileLink='zip/images/'.$_SESSION['userData']['id'].'/'.$name.'.zip';
							       $myDrive = "https://drive.google.com/drive/my-drive";    
							
							?>
						<div class="card">
							<?php    echo "<a href='$pictureLink'><input type='checkbox' class='custom-control-input' id='customControlInline'>";
								echo "<img class='card-img-top' src='https://graph.facebook.com/v3.1/{$cover_photo_id}/picture?access_token={$_SESSION['access_token']}' alt='Card image' height='200px' width='120px' alt='Card image cap'/></a> "; ?>
							<div class="card-body">
								<?php	echo "  <h5 class='card-title'>{$name}</h5>"; 
									$photoCount = ($count > 1)?$count. 'Photos':$count. 'Photo';
									echo " <p class='card-text'>{$photoCount} / <a href='{$link}' target='_blank'>View on Facebook</a></p>";
									if(file_exists($zipFileLink))
										{
									      echo " <a href= '$zipFileLink' download><button type='button' onclick='move()'' class='btn btn-default btn-sm bg-primary'><span class='glyphicon glyphicon-save-file'></span>Download Zip  </button></a>&nbsp;&nbsp;&nbsp;";  	
										}
										else
										{	
										    echo " <a href= '$zipLink' ><button type='button'  class='btn btn-default btn-sm'><span class='glyphicon glyphicon-save-file'></span> Create Zip </button></a>&nbsp;&nbsp;&nbsp;";  	
										    
										}
									    //   echo "<a href= '$zipLink' >Zip </a>";
									    // echo " <a href= '$googleDrive' ><button type='button'  class='btn btn-default btn-sm'><span class='glyphicon glyphicon-save-file'></span>move to google</button></a>"; 
									     	if($googledrive->isLoggedIn())
									               					{
									               					     echo "<a href= '$googleDrive' ><button type='button'  class='btn btn-default btn-sm bg-primary'><span class='glyphicon glyphicon-save-file'></span>&nbsp;&nbsp;Move to google</button></a>";
									               					 } else 
									               					{ 
									               					    ?><a href="<?php echo $googledrive->easy_login() ; ?>"><button type='button'  class='btn btn-default btn-sm bg-light' ><span class='glyphicon glyphicon-save-file'></span>Move to google</button></a>
								<?php	 } ?>
							</div>
							<div class="card-footer">
								<?php
									if($googledrive->isLoggedIn())
									            					{
									            					     ?>	<small class="text-muted"><a href= '<?php echo $myDrive; ?>' target = "_blank">Check Drive</a></small>
								<?php	 } else 
									{ 
									    	?><small class="text-muted"><a href= '<?php echo $googledrive->easy_login() ; ?>' >Check Drive</a></small>
								<?php	 } ?>
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