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
<?php include_once("header-topAdmin.php"); ?>

<div class="clear"></div>
<div class="shop-area" style="margin-top:30px;">
		<div class="container">
			<div class="row">
				<!-- shop-left-sidebar start -->
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 animated fadeInUp">
					<!-- widget-categories start -->
					<?php require_once('adminsidenav.php'); ?>
					<!-- widget-categories end -->
				</div>

				<?php 
				$per_page=21;
					if (isset($_GET["pills"])) {

					$page = $_GET["pills"];

					}

					else {

					$page=1;
					}
					// Page will start from 0 and Multiple by Per Page
					$start_from = ($page-1) * $per_page;

					$query = "SELECT * from pillshome where display = 1 ORDER BY prod_id DESC LIMIT $start_from, $per_page";
					$run_query = mysqli_query($connect, $query);
	   				confirm_query($run_query);

			?>
				<!-- blog-left-sidebar end -->
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 animated fadeInDown">
					
					<div class="clear"></div>
					<div class="row">
						<div class="grid-view">
							<!-- single-product start -->
							<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
							<div class="col-lg-4 col-md-4 col-sm-4">
								<div class="single-product">
									<div class="product-img">
										<a href="#.">
											<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
											<img class="secondary-image" src="../extrabox/img/product/<?php echo $rowItem['photo2']; ?>" alt="" />
										</a>
										<div class="actions">
											<div class="action-buttons">
												<div class="add-to-links">
													<div class="add-to-wishlist">
														<a href="delete_this_property.php?delete=<?php echo $rowItem['prod_id']; ?>" data-toggle="tooltip" title="Delete"><i class="fa fa-remove"></i>
														</a>
													</div>
													<div class="compare-button">
														<a href="edit.php?edit=<?php echo $rowItem['prod_id']; ?>" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
													</div>									
												</div>
											</div>
										</div>							
									</div>
									<div class="product-content">
										<h2 class="product-name"><a href="#."><?php echo $rowItem['prodname']; ?></a></h2>
										
										<div class="price-box">
											<span class="new-price">$<?php echo $rowItem['new_price']; ?></span>
											<span class="old-price">$<?php echo $rowItem['old_price']; ?></span>
										</div>
									</div>
								</div>
							</div>
							<!-- single-product end -->		
							<?php } // end while loop?>			

						</div>
					</div>
					<!-- pagination start -->
					<div class="shop-pagination">
						<!-- <div class="pagination">
							<ul>
								<li class="active">1</li>
								<li><a href="#.">2</a></li>
								<li><a href="#.">3</a></li>
								<li><a href="#."><i class="fa fa-chevron-right"></i></a></li>
							</ul>
						</div> -->	
						<?php 
							$query = "SELECT * from pillshome where display='1'";
							$result = mysqli_query($connect, $query);
							// Count the total records
							$total_records = mysqli_num_rows($result);

							//Using ceil function to divide the total records on per page
							$total_pages = ceil($total_records / $per_page);
						?>
							<!-- Pagination -->
							<div class="pagination">
								<ul>
									<?php 
										if ($page<=$total_pages) {

											if ($page != 1) {
											$k = $page-1;
											  echo '<li><a href="index.php?pills='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="index.php?pills='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="index.php?pills='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
												}	
										}
									?>
								</ul>
							</div>					
					</div>
					<!-- pagination end -->
				</div>
			</div>
		</div>
	</div>

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
