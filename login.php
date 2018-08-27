<?php
	require_once "config.php";
	
	if (isset($_SESSION['access_token'])) {
		header('Location: index.php');
		exit();
	}
	
	$redirectURL = "https://newfbbhavin.000webhostapp.com/fb-callback.php";
	$permissions = ['email'];
	$loginURL = $helper->getLoginUrl($redirectURL, $permissions);
	
	?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Spectral by HTML5 UP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<noscript>
			<link rel="stylesheet" href="assets/css/noscript.css" />
		</noscript>
		<style>
			a:link {
			text-decoration: none;
			}
		</style>
	</head>
	<body class="landing is-preload">
		<!-- Page Wrapper -->
		<div id="page-wrapper">
			<!-- Header -->
			<header id="header" class="alt">
				<h1><a href="index.html">Spectral</a></h1>
				<nav id="nav">
					<ul>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Github Repo.</span></a>
						</li>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Menu</span></a>
						</li>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Menu</span></a>
						</li>
					</ul>
				</nav>
			</header>
			<!-- Banner -->
			<section id="banner">
				<div class="inner">
					<h2>Facebook Album Manager</h2>
					<p>Another fine responsive
						site template freebie
						.
					</p>
					<ul class="actions special">
						<li> <a href= <?php echo $loginURL; ?> style="text-decoration: none;"><button type='button'  class='btn btn-default btn-sm bg-primary'><span class='glyphicon glyphicon-save-file'></span>LOG IN TO FACEBOOK</button></a>&nbsp;&nbsp;&nbsp;</li>
						</button>
					</ul>
				</div>
			</section>
		</div>
		crafted by <a href="http://html5up.net">HTML5 UP</a>
		<!-- Scripts -->
		<script src="assets/js/jquery.min.js"></script>			
		<script src="assets/js/breakpoints.min.js"></script>		
		<script src="assets/js/main.js"></script>
	</body>
</html>
