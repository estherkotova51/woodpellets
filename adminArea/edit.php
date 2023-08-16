<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>

<?php confirm_staff_logged_in(); ?>

<!DOCTYPE HTML>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>  ADMIN || <?= companyD("compName"); ?></title>
    <meta name="description" content="">
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
</head>
<body>
	<?php include_once("header-topAdmin.php"); ?>

	<br/><br/><br/>


	
	<h3 style="text-align:center;">ENSURE to save when done?</h3>
	<br/><br/><br/>
	<?php

		global $connect;
			
	if (isset($_GET['edit'])) {
		$property = $_GET['edit'];

		$query = "SELECT * from pillshome where prod_id = '$property' and display = 1 LIMIT 1 ";
		$run_query = mysqli_query($connect, $query);
   		confirm_query($run_query);
	?>

 	<div class="col-md-12 ">
		<div class="row">
			<div class="shop-products">
				<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
				<div class="col-lg-4 col-md-4 col-sm-4 col-lg-offset-1 col-md-offset-1 col-sm-offset-1 animated fadeInUp">
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
						</div><br/><br/>
						<div class="row">
							<div class="col-md-3 ">
								<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
							</div>
							<div class="col-md-3 ">
								<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo2']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
							</div>
							<div class="col-md-3 ">
								<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo3']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
							</div>
							<div class="col-md-3 ">
								<img class="primary-image" src="../extrabox/img/product/<?php echo $rowItem['photo4']; ?>" alt="<?php echo $rowItem['prodname']; ?>" />
							</div>
							
							</div>
						</div>
						
					

					</div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 animated fadeInDown">
					<form  action="proedit.php" method="post" id="proformpanels" name="theform" enctype="multipart/form-data">
						<?php
							$query = "SELECT * FROM categories where catid >= 1 ORDER BY catid asc";
							$run_query = mysqli_query($connect, $query);
							confirm_query($run_query);
							$num_rows = mysqli_num_rows($run_query);
						?>
						<div class="form-group" style="text-align: left;">
							<p>Select product's Category</p>
							<select name="categories" id="categories" class="form-control">
								<option value="<?php echo $rowItem['category']; ?>"><?php echo $rowItem['category']; ?></option>
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
						<div class="form-group" style="text-align: left; user-select: auto;">
							<p>Select product's Sub-category</p>
							<?php
								$query = "SELECT * FROM subcategories where subId >= 1 ORDER BY subId asc";
								$run_query = mysqli_query($connect, $query);
								confirm_query($run_query);
								$num_rows = mysqli_num_rows($run_query);
							?>
                             <select name="subcategories" id="subcategories" class="form-control" style="user-select: auto;">
                             	<option value="<?php echo $rowItem['subcategory']; ?>"><?php echo $rowItem['subcategory']; ?></option>
                             	<?php 
									if ($num_rows > 0) {
										while ($row = mysqli_fetch_array($run_query)) {
											echo'<option value="'.$row['subcategory'].'">'.$row['subcategory'].'</option>';
										}
									}else{
										echo'<option value="">Subcategory not available</option>';
									}
								?>	
                             </select>
                        </div>						
						<div class="form-group" style="text-align: left;">
	                        <label for="productname">New Name</label>
                            <p href="" data-toggle="tooltip" data-placement="top" title="Please enter Product Name">
                                <input style="width:100%;" class="form-control" type="text" id="productname" name="productname"  placeholder="Product Name" value="<?php echo $rowItem['prodname']; ?>" required/>

                                <input type="text" name="productid" value="<?php echo $rowItem['prod_id']; ?>" hidden/>
                            </p>
                        </div>

                        <div class="form-group row" style="text-align: left;">
                        	<div class="form-group col-sm-6" style="text-align: left;">
								 <label for="oldprice" > Old Price</label>
                                    <p href="" data-toggle="tooltip" data-placement="top" title="Please enter Old Price">
                                        <input style="width:100%;" class="form-control" type="number" id="oldprice" name="oldprice"  step="0.01" placeholder="Old Price"  value="<?php echo $rowItem['old_price']; ?>" required/>
                                    </p>
							</div>
							<div class="form-group col-sm-6" style="text-align: left;">
                                 <label for="newprice">New Price</label>
                                    <p href="" data-toggle="tooltip" data-placement="top" title="Please enter New Price">
                                        <input style="width:100%;" class="form-control" type="number" id="newprice" name="newprice"  step="0.01" placeholder="New Price" value="<?php echo $rowItem['new_price']; ?>" required/>
                                    </p>
                            </div>
                        </div>

                        <div class="form-group has-feedback" style="text-align: left;">
							<label for="sideeffects"> Minimum Order </label> 
							<p href="" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
								<input class="form-control" type="text" name="sideeffects" id="sideeffects" value="<?php //echo $rowItem['sideeffects']; ?>" placeholder="Enter Minimum Order.">
							</p>
						</div>

                        <?php 
							$query = "SELECT * from productvar where productId = '$property'"; 
							$check_query = mysqli_query($connect, $query);
							confirm_query($check_query);

							$numrow = mysqli_num_rows($check_query);?>

							
							<?php if ($numrow > 1) {?>
								<h5>-----------Products' Variable Prices (Optional) Some or all fields Can be left empty -----------</h5>
                				<p>Enter details consistently: Quantity of product <i>(20 Units)</i> => Discounted Price <i>(200)</i> Do not enter any Currency sign ($...) </p>
                			<?php } ?>	

							<?php 

							while ($row_cat = mysqli_fetch_assoc($check_query)){ ?>

								<div class="form-group row" style="margin-bottom: 0px; text-align: left;">
		                        	<div class="form-group col-sm-6" style="text-align: left; margin-bottom: 1px;">
	                                    <div class="input-group">
	                                        <input style="width:100%;" class="form-control" type="text" name="quantity[]"  value="<?php echo $row_cat['quantity']; ?>" />
	                                        <div class="input-group-addon">=></div>
	                                    </div>
									</div>
									<div class="form-group col-sm-6" style="text-align: left; margin-bottom: 1px;">
										<div class="input-group">
											<div class="input-group-addon">$</div>
	                                        <input style="width:100%;" class="form-control" type="number" step="0.01" name="vprice[]"  value="<?php echo $row_cat['price']; ?>" />
	                                        <input type="number" name="id[]"  value="<?php echo $row_cat['id']; ?>" hidden/>
		                                </div>
		                            </div>
		                        </div>
										
						<?php } ?>

						<br/>
						<div class="form-group has-feedback" style="text-align: left;">
							<label for="purpose"> Benifits (1 purpose per line) </label> 
							<p href="" data-toggle="tooltip" data-placement="top" title="Please enter purpose .">
								<textarea class="form-control ckeditor" wrap="soft" rows="10" name="purpose" id="purpose" placeholder="Please include any other specifications we have to pay attention to." ><?php echo $rowItem['purpose']; ?></textarea>
							</p>
						</div>

						<div class="form-group has-feedback" style="text-align: left;">
							<label for="description"> Description </label> 
							<p href="" data-toggle="tooltip" data-placement="top" title="Please enter Description .">
								<textarea class="form-control ckeditor" wrap="soft" rows="10" name="description" id="description" placeholder="Please include any other specifications we have to pay attention to." ><?php echo $rowItem['description']; ?></textarea>
							</p>
						</div>
                    

						<div class="form-group">
							<label for="photo" > Photos</label>

							<input class="form-control" type="file"  name="photo[]" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #298042; color:#fff;"/>

							<input class="form-control" type="file"  name="photo[]" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #298042; color:#fff;"/>
							<input class="form-control" type="file"  name="photo[]" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #298042; color:#fff;"/>
							<input class="form-control" type="file"  name="photo[]" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #298042; color:#fff;"/>
						</div>

						<a href="index.php" class="cancel" style="border: 1px solid #000; padding:5px 15px; text-align:center; background-color: #00ff00; color:#fff;"> CANCEL</a>

						<input type="submit" name="submitedit" class="action-button submitEdit" value="SAVE" style="padding:5px 15px; text-align:center; background-color: #ff0000; color:#fff; margin-left: 20px; border: 1px solid #ff0000;" />
					</form>
				</div>
					
				<?php } // end while loop?>	
			</div>
		</div>
	</div>
<?php } //<!-- End of if --> ?>

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