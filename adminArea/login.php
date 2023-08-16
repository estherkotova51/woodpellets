<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>
<?php //confirm_logged_in(); ?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>  ADMIN || <?= companyD("compName"); ?></title>
    <meta name="description" content="<?= companyD("compDescription"); ?>">
<link rel="icon" type="image/png" href="images/favicon.png">
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
<?php //include_once("header-top.php"); ?>


<?php //include_once("menu-area.php"); ?>

<?php $c_email = ""; ?>
<?php
	if (isset($_POST['sendAdmin'])) {
		// Process the form
		// Attempt login

		$s_email = $_POST["emailAdmin"];
		$s_pass = $_POST["passAdmin"];

		$sel_c = "SELECT * from adminlog where adm_pwd='$s_pass' AND adm_email='$s_email'";
		$run_c = mysqli_query($connect, $sel_c);

		$check_customer = attempt_login_staff($s_email, $s_pass);
		
			if($check_customer) {
					$_SESSION['c_email'] = $s_email;
					$_SESSION['message'] = 'You Logged In Successfully, Thanks';

					$update_login_time = "UPDATE adminlog SET llogin=now() WHERE adm_email='{$s_email}' LIMIT 1";
					$run_update_login_time = mysqli_query($connect, $update_login_time);

					echo "<script>alert('You Logged In Successfully, Thanks')</script>";

					echo "<script>window.open('postw.php', '_self')</script>";
			}else{
				echo "<script>alert('Password and/or Username is incorrect, Please try again!')</script>";
				$_SESSION['message'] = 'Your Log In Failed, Thanks for trying again!';
				echo "<script>window.open('login.php', '_self')</script>";
				exit();
		}
	}
?>

<!-- pages-title-start -->
		<section class="contact-img-areaAdmin">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div class="con-text">
                            <h2 class="page-title">Admin Area</h2>
                            <p>Log in</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
		<!-- pages-title-end -->

<div class="login-page page fix"><!--start login Area-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4 col-md-4"></div>
			<div class="col-sm-4 col-md-4">
				<div class="login">
					<form id="login-form" action="#" method="POST"><br/>
						<p>Please Enter your Credentials!</p>

						<label>Admin Name<span>*</span></label>
						<input type="text" name="emailAdmin" />
						<label>Password<span>*</span></label>
						<input type="password" name="passAdmin" />
						<div class="remember">
							<input type="checkbox" />
							<p>Remember me!</p>
						</div>
						<input type="submit" value="login" name="sendAdmin" />
					</form>
				</div>
			</div>
			<div class="col-sm-4 col-md-4"></div>
		</div>
	</div>
</div><!--End login Area-->





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