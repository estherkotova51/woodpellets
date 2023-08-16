<?php require_once("../includes/layouts/session.php"); ?>
<?php require("../includes/layouts/db_connect.php"); ?>
<?php require_once("../includes/layouts/functions.php"); //date_default_timezone_set('America/Chicago'); ?> 
<!DOCTYPE html>
<html lang="en">

	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">

	    <title>EveSpotExtracts | EveSpotExtracts | Transport & Logistics</title>
	    <!-- Web Fonts -->
        <!-- <link href='http://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,500,400italic,700,700italic,900,900italic,500italic' rel='stylesheet' type='text/css'> -->
       	<!-- <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'> -->
       	<!-- Bootstrap Core CSS -->
	    <link href="css/bootstrap.min.css" rel="stylesheet">
	    <!-- Flaticon CSS -->
	    <link href="fonts/flaticon/flaticon.css" rel="stylesheet">
	    <!-- font-awesome CSS -->
	    <link href="css/font-awesome.min.css" rel="stylesheet">
	    <!-- Offcanvas CSS -->
	    <link href="css/off-canvas.css" rel="stylesheet">
	    <!-- animate CSS -->
	    <link href="css/animate.css" rel="stylesheet">
	    <!-- language CSS -->
	    <link href="css/language-select.css" rel="stylesheet">
	    <!-- owl.carousel CSS -->
	    <link href="owl.carousel/assets/owl.carousel.css" rel="stylesheet">
		<!-- magnific-popup -->
    	<link href="css/magnific-popup.css" rel="stylesheet">
	    <!-- Template Core Styles -->
	    <link href="css/template.css" rel="stylesheet">
	    <!-- Main Menu Styles -->
	    <link href="css/menu.css" rel="stylesheet">
	    <!-- Custom CSS -->
	    <link href="css/style.css" rel="stylesheet">
	    <!-- Responsive CSS -->
	    <link href="css/responsive.css" rel="stylesheet">


	    <!-- external links -->
	    <link href="css2/font-awesome.min.css" rel="stylesheet">
	    <!-- Offcanvas CSS -->
	    <link href="css2/hippo-off-canvas.css" rel="stylesheet">
	    <!-- animate CSS -->
	    <link href="css2/animate.css" rel="stylesheet">
	    <!-- language CSS -->
	    <link href="css2/language-select.css" rel="stylesheet">

    	<!-- <link href="css2/menu.css" rel="stylesheet"> -->
    	<!-- Template Common Styles -->
    	<link href="css2/template.css" rel="stylesheet">
	    <!-- Custom CSS -->
	    <link href="css2/style.css" rel="stylesheet">
	    <!-- Responsive CSS -->
	    <link href="css2/responsive.css" rel="stylesheet">
	    
	    <!--<link rel="stylesheet" href="../assets/css/jquery-ui.css">-->
	    <link rel="stylesheet" type="text/css" href="js/datetimepicker-master/jquery.datetimepicker.css" />

	    <script src="js/vendor/modernizr-2.8.1.min.js"></script>
	    <!-- HTML5 Shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	    <!--[if lt IE 9]>
		    <script src="js/vendor/html5shim.js"></script>
		    <script src="js/vendor/respond.min.js"></script>
	    <![endif]-->
	</head>


	<body id="page-top">
		<div id="st-container" class="st-container">
		    <div class="st-pusher">
	        	<div class="st-content">
					<header class="header">
				  		<nav class="top-bar">
				  			<div class="container">
				  				<div class="row">
				  					<div class="col-sm-4 col-xs-12">
					  					<div class="call-to-action">
					  						<ul class="list-inline">
					  							<li><a href="#"><strong><?= companyD("compPhone"); ?></strong></a></li>
					  							<li><a href="#"><strong><?= companyD("compEmail"); ?></strong></a></li>
					  						</ul>
					  					</div><!-- /.call-to-action -->
				  					</div><!-- /.col-sm-6 -->

				  					<div class="col-sm-4 col-xs-12">
					  					<div class="logo text-center">
					  						<h1><a href="index.php"><img src="../../extrabox/img/logo/<?= companyD("compLogo"); ?>" alt=""></a><span style="color:#000;">EveSpotExtracts</span></h1>
					  					</div>
				  					</div>

				  					<div class="col-sm-4">
					  					<div class="topbar-right">
						  					<div class="lang-support pull-right">
												<ul class="social-links list-inline pull-right">
												<?php
													if (isset($_SESSION['username'])) {
														echo '<li><a href="staff_log_out.php">Log out</a></li>';

													}else{
														echo '<li><a href="staff_log_in.php">Log in </a></li>';
														//echo '<li><a href="staff_reg.php"> Sign Up</a></li>';
													}
												?>
	
					  							</ul>
											</div>

					  						
					  					</div><!-- /.social-links -->
				  					</div><!-- /.col-sm-6 -->
				  				</div><!-- /.row -->
				  			</div><!-- /.container -->
				  		</nav><!-- /.top-bar -->
				  		<div>
				  			<?php 
				  				if (isset($_SESSION["message"])) {
								echo message(); 
								} 
							?>
						</div>
				  		<div class="container mainnav">
				  		<?php if (isset($_SESSION['username'])) { ?>
				  			<div class="navbar-header">
		                        
		                        <div id="search">
							    <button type="button" class="close">×</button>
							    <form action="../../track-your-shipment" method="POST">
							        <input type="search" name="trackcode" placeholder="Enter tracking code here" />
							        <button type="submit" name="submit" class="btn btn-primary btn-lg">Track here</button>
							    </form>
								</div>
							</div>
							<nav class="navbar navbar-default" role="navigation">
									<span class="search-button visible-xs"><a href="#search">Tracking code <i class="fa fa-search"></i></a></span>
									
									<!-- offcanvas-trigger -->
				                        <button type="button" class="navbar-toggle collapsed visible-xs visible-sm" >
				                          <span class="sr-only">Toggle navigation</span>
				                          <i class="fa fa-bars"></i>
				                        </button>

									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse navbar-collapse">

						                <span class="search-button pull-right"><a href="#search">Tracking code <i class="fa fa-search"></i></a></span>

										<ul class="nav navbar-nav hidden-sm">
											<li class="active"><a href="index.php">Packages</a></li>
											<li class="active"><a href="../../shipment/requestshipping.php">Shipping request</a></li>
											<li class="active"><a href="../index.php">Return to product area</a></li>
	                                       
										</ul>
									</div><!-- /.navbar-collapse -->
									
							</nav>
						<?php }else{echo "";}  ?>
						</div><!-- /.container -->
					</header>