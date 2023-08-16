<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>

<?php confirm_staff_logged_in(); ?>
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
<?php include_once("header-topAdmin.php"); ?>

<br/><br/><br/>


	
	<h3 style="text-align:center;">Please be SURE of this ACTON?</h3>
<br/><br/><br/>
	<?php

		global $connect;
			
		if (isset($_GET['delete'])) {
			$property = $_GET['delete'];

			$query = "SELECT * from pillshome where prod_id = '$property' and display = 1 LIMIT 1 ";
				$run_query = mysqli_query($connect, $query);
	   				confirm_query($run_query);
	?>

						 	<div class="col-md-9 ">
								<div class="row">
									<div class="shop-products">
									<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
										<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4 animated fadeInUp">
											<div class="single-product">
												<div class="product-img">
													<a href="#">
														<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo2']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
														<img class="secondary-image" src="../extrabox/img/product/<?php echo $rowItem['photo']; ?>" alt="" />
													</a>
																		
												</div>
												<div class="product-content">
													<h2 class="product-name"><a href="#"><?php echo $rowItem['prodname']; ?></a></h2>
													
													<div class="price-box">
														<span class="new-price">$<?php echo $rowItem['new_price']; ?></span>
														<span class="old-price">$<?php echo $rowItem['old_price']; ?></span>
													</div> 
												</div><br/><br/><br/>
											<form  action="" method="post" id="proformpanels" name="theform" enctype="multipart/form-data">
												<a href="" class="cancel" style="border: 1px solid #000; padding:5px 15px; text-align:center; background-color: #00ff00; color:#fff;"> RETURN</a>

												<input type="submit" name="submit" class="action-button submitEdit" value="DELETE" style="padding:5px 15px; text-align:center; background-color: #ff0000; color:#fff; margin-left: 20px; border: 1px solid #ff0000;" />
											</form>

											</div>
										</div>
											
										<?php } // end while loop?>	
									</div>
								</div>
							</div><br/><br/><br/><br/><br/>
<?php } //<!-- End of if --> ?>


<?php
	if (isset($_POST['submit'])) {
		
		$query  = "UPDATE pillshome SET display=0 WHERE prod_id=$property ";

		$result = mysqli_query($connect, $query);
		confirm_query($result);

		if ($result) {
			//success
			$_SESSION["message"] = "Your Property was successfully Deleted.";
		   	echo "<script>window.open('/', '_self' )</script>";
		}else{
			// failure
			$message = "Property deletion failed, please try again.";
		}
	} else{
		// This is probably a GET request
			//echo "<script>window.open('myaccount.php', '_self' )</script>";
	}
?>

<?php //include_once("footer.php"); ?>

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
