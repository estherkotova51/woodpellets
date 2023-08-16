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
    <script src="js/vendor/jquery-1.12.0.min.js"></script>
    <script src="ckeditor/ckeditor.js"></script>
  	
    <script type="text/javascript">

		$(document).ready(function(){
			$('#categories').on('change', function(){
				var categoriesID = $(this).val();
				if (categoriesID) {
					$.ajax({
						type: 'POST',
						url : 'SProcessor.php',
						data: 'categ='+categoriesID,
						success:function(html){
							$('#subcategories').html(html);
						}
					});
				}else{
					$('#subcategories').html('<option value="">Select a Category first</option>');
				}
			});

		});
	</script>
</head>
<body>
<?php include_once("header-topAdmin.php"); ?>



<div class="shop-area" style="margin-top:30px;"><!--Start Shop Area-->
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<!-- widget-categories start -->
					<?php require_once('adminsidenav.php'); ?>
					<!-- widget-categories end -->
				</div>
				<form  action="postingspro.php" method="post" id="proform" name="theformx" enctype="multipart/form-data" >
					<div class="col-md-6">
						<div class="row">
			
							<div class="col-xs-12">
							
								
									<!-- Progress Bar -->
										<p style="text-align:center; color:#fff; font-size:24px; background-color: #3657c9; padding: 15px 10px;">ADD A PRODUCT</p>

										<h2 style="text-align:center">PRODUCTS DETAILS</h2>
										
										<?php
											$query = "SELECT * FROM categories ORDER BY catid asc";
											$run_query = mysqli_query($connect, $query);
											confirm_query($run_query);
											$num_rows = mysqli_num_rows($run_query);
										?>
										<div class="form-group" style="text-align: left;">
											<p>Select product's Category</p>
											<select name="categories" id="categories" class="form-control">
												<option value="">Select a Category</option>
												<?php 
													if ($num_rows > 0) {
														while ($row = mysqli_fetch_array($run_query)) {
															echo'<option value="'.$row['categ'].'">'.$row['categ'].'</option>';
														}
													}else{
														echo'<option value="">Category not available</option>';
													}
												?>
											</select>
										</div>
										<div class="form-group" style="text-align: left;">
											<p>Select product's Sub-category</p>
											<select name="subcategories" id="subcategories" class="form-control">
												<option value="">Select a Subcategory</option>
											</select>
										</div>
										<div class="form-group" style="text-align: left;">
											<label for="productname">Product Name</label>
												<p href="" data-toggle="tooltip" data-placement="top" title="Please enter Product Name">
														<input style="width:100%;" class="form-control" type="text" id="productname" name="productname"  placeholder="Product Name"  required/>
												</p>
										</div>

										<div class="form-group row" style="text-align: left;">
											<div class="form-group col-sm-4" style="text-align: left;">
												 <label for="oldprice" > Old Price</label>
													<p href="" data-toggle="tooltip" data-placement="top" title="Please enter Old Price">
															<input style="width:100%;" class="form-control" type="number" id="oldprice" name="oldprice" step="0.01" placeholder="Old Price"  required/>
													</p>
											</div>
											<div class="form-group col-sm-4" style="text-align: left;">
												<label for="newprice">New Price</label>
													<p href="" data-toggle="tooltip" data-placement="top" title="Please enter New Price">
														<input style="width:100%;" class="form-control" type="number" id="newprice" name="newprice" step="0.01" placeholder="New Price"  required/>
													</p>
											</div>
										</div>

					            <div class="form-group has-feedback" style="text-align: left;">
												<label for="sideeffects"> Minimum Order </label> 
												<p href="" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
													<input class="form-control" type="text" name="sideeffects" id="sideeffects" placeholder="Enter Minimum Order.">
												</p>
											</div>

											<h5>-----------Products' Variable Prices (Optional) Some or all fields Can be left empty -----------</h5>
                				<p>Enter details consistently: Quantity of product <i>(20 Units)</i> => Discounted Price <i>(200)</i> Do not enter any Currency sign ($...) </p>

												<?php for($i=0; $i<=4; $i++){?>
														<div class="form-group row" style="margin-bottom: 0px; text-align: left;">
															<div class="form-group col-sm-6" style="text-align: left; margin-bottom: 1px;">

																<div class="input-group">
																		<input style="width:100%;" class="form-control" type="text" name="quantity[]"/>
																		<div class="input-group-addon">=></div>
																</div>
													
															</div>
															<div class="form-group col-sm-6" style="text-align: left; margin:0 0 1px -20px;">
																<div class="input-group">
																	<div class="input-group-addon">$</div>
																				<input style="width:100%;" class="form-control" type="number" step="0.01" name="vprice[]"/>
																				<input type="number" name="id[]" hidden/>
																</div>
															</div>
														</div>
													<?php	}  ?>
				            <h3>--------------------------------------------------------</h3>

										<br/>
										<div class="form-group has-feedback" style="text-align: left;">
											<label for="purpose"> Benefits (1 purpose per line)  </label> 
											<p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
												<textarea class="form-control ckeditor" wrap="soft" rows="10" name="purpose" id="purpose" placeholder="Please include any other specifications we have to pay attention to."></textarea>
											</p>
										</div>
				                        <div class="form-group has-feedback" style="text-align: left;">
											<label for="description"> Description </label> 
											<p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
												<textarea class="form-control ckeditor" wrap="soft" rows="10" name="description" id="description" placeholder="Please include any other specifications we have to pay attention to."></textarea>
											</p>
										</div>
										<input  type="text" name="display" value="1" hidden>
										<br/>
										<br/>

							</div>

						</div>

					</div>

					<div class="col-md-3">
						<label for="photo" > Photos </label><span><i> Add a minimum of 2 photos</i></span>

						<input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" required style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>
						<input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" required style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>
						<input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>
						<input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>


						<input type="submit" name="submit" class="action-button" id="submitnow" value="ADD PRODUCT" style="width:100%; padding:10px 10px; margin-bottom: 5px; background-color: #DE6144; color:#fff; border:none;"/>
					</div>
				</form>
			</div>
		
		</div>
	</div>
</div><!--Start Shop Area-->
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