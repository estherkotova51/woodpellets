<?php require_once("../includes/layouts/session.php"); ?>
<?php require("../includes/layouts/db_connect.php"); ?>
<?php require_once("../includes/layouts/functions.php") ?>

<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
 	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">
	    <title>  ADMIN ||<?= companyD("compName"); ?></title>
		<meta name="description" content="MUSUD is providing the best solution to achieve the 17 sustainable development GOALS for better livings conditions.">
	    <meta name="description" content="">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    
	    <!-- favicon
		============================================ -->		
	    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		<!-- google fonts -->
		<link href='https://fonts.googleapis.com/css?family=Poppins:400,300,500,600,700' rel='stylesheet' type='text/css'>
		<!-- all css here -->
		<!-- bootstrap v3.3.6 css -->
	    <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- animate css -->
	    <link rel="stylesheet" href="css/animate.css">
		<!-- pe-icon-7-stroke -->
		<link rel="stylesheet" href="css/pe-icon-7-stroke.min.css">
		<!-- jquery-ui.min css -->
	    <link rel="stylesheet" href="css/jquery-ui.min.css">
	    <!-- Image Zoom CSS
		============================================ -->
	    <link rel="stylesheet" href="css/img-zoom/jquery.simpleLens.css">
		<!-- meanmenu css -->
	    <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- nivo slider CSS
		============================================ -->
		<link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css" />
		<link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen" />
		<!-- owl.carousel css -->
	    <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- font-awesome css -->
	    <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- style css -->
		<link rel="stylesheet" href="style.css">
		<!-- responsive css -->
	    <link rel="stylesheet" href="css/responsive.css">
		<!-- modernizr css -->
	    <script src="js/vendor/modernizr-2.8.3.min.js"></script>
	</head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
     
	<?php include_once("header-topAdmin.php"); ?>
	<!-- entry-header-area start -->
	<div class="entry-header-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="entry-header">
						<h1 class="entry-title">My Account</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- entry-header-area end -->
	<!-- my-account-area start -->
	<div class="my-account-area">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<form action="#">
						<div class="form-fields">
							<h2>Login</h2>
							<p>
								<label>Username or email address <span class="required">*</span></label>
								<input type="text" />
							</p>
							<p>
								<label>Password <span class="required">*</span></label>
								<input type="password" />
							</p>
						</div>
						<div class="form-action">
							<input type="submit" value="Login" />
							<label><input type="checkbox" />  Remember me </label>
						</div>
					</form>
				</div>
				<div class="col-md-6">
					<form action="#">
						<div class="form-fields">
							<h2>Register</h2>
							<p>
								<label>Admin Name  <span class="required">*</span></label>
								<input type="text" />
							</p>
							<p>
								<label>Password <span class="required">*</span></label>
								<input type="password" />
							</p>
						</div>
						<div class="form-action">
							<input type="submit" value="Register" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- my-account-area end -->
<?php include_once("footer.php"); ?>

<!-- all js here -->
		<!-- jquery latest version -->
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
		<!-- bootstrap js -->
        <script src="js/bootstrap.min.js"></script>
        <!-- parallax js -->
        <script src="js/parallax.min.js"></script>
		<!-- owl.carousel js -->
        <script src="js/owl.carousel.min.js"></script>
        <!-- Img Zoom js -->
		<script src="js/img-zoom/jquery.simpleLens.min.js"></script>
		<!-- meanmenu js -->
        <script src="js/jquery.meanmenu.js"></script>
		<!-- jquery.countdown js -->
        <script src="js/jquery.countdown.min.js"></script>
		<!-- Nivo slider js
		============================================ --> 		
		<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
		<script src="lib/home.js" type="text/javascript"></script>
		<!-- jquery-ui js -->
        <script src="js/jquery-ui.min.js"></script>
		<!-- sticky js -->
        <script src="js/sticky.js"></script>
		<!-- plugins js -->
        <script src="js/plugins.js"></script>
		<!-- main js -->
        <script src="js/main.js"></script>
    </body>
</html>
