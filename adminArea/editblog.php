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
						if (isset($_GET["edblog"])) {
							$page = $_GET["edblog"];
							$query = "SELECT * from blog WHERE blogid = '$page'   LIMIT 1";
							$run_query = mysqli_query($connect, $query);
			   				confirm_query($run_query);
		   				}
					?>
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 animated fadeInUp">
					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>Edit Blog Post</h1>
							<!-- single-product start -->
							<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
								<div class="col-lg-12 col-md-12 col-sm-12 content">
								
							        <form  action="<?= $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data">
							          	<?php
											$query = "SELECT * FROM blogcat ORDER BY blogcatid asc";
											$run_query = mysqli_query($connect, $query);
											confirm_query($run_query);
											$num_rows = mysqli_num_rows($run_query);
										?>
										<div class="form-group" style="text-align: left;">
											<p>Select Blog's Category</p>
											<select name="categories" id="blogcat" class="form-control">
												<option value="<?php echo $rowItem['category']; ?>"><?php echo $rowItem['category']; ?></option>
												<?php 
													if ($num_rows > 0) {
														while ($row = mysqli_fetch_array($run_query)) {
															echo'<option value="'.$row['blogcattitle'].'">'.$row['blogcattitle'].'</option>';
														}
													}else{
														echo'<option value="">Category not available</option>';
													}
												?>
											</select>
										</div>
								        <div class="form-group row" style="text-align: left;">
								        	<div class="form-group col-sm-4" style="text-align: left;">
												 <label for="type" > Blog Title</label>
								                    <p href="" data-toggle="tooltip" data-placement="top" title="Please enter Title">
								                        <input style="width:100%;" class="form-control" type="text" id="type" name="posttitle" value="<?php echo $rowItem['posttitle']; ?>"  placeholder="Please enter Title"  required/>
								                    </p>
											</div>
											<div class="form-group col-sm-4" style="text-align: left;">
												 <label for="postedby" > Posted by</label>
								                    <p href="" data-toggle="tooltip" data-placement="top" title="Posted by" id="postedby">
								                        <input class="form-control" type="text" name="postedby" value="<?php echo $rowItem['postedby']; ?>" placeholder="Please enter Name"  required />
								                    </p>
											</div>
											<div class="form-group col-sm-4" style="text-align: left;">
								                 <label for="productname">Photo</label>
								                    <p href="" data-toggle="tooltip" data-placement="top" title="Please select a photo">
								                        <input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*"/>
								                    </p>
								            </div>
								        </div>

								        <div class="form-group has-feedback" style="text-align: left;">
											<label for="description"> Message </label> 
											<textarea class="form-control ckeditor" wrap="soft" rows="10" name="description" id="description" placeholder="Please include any other specifications we have to pay attention to." required><?php echo $rowItem['blogmessage']; ?></textarea>
											
										</div>
										<input  type="text" name="display" value="1" hidden>
										<input  type="text" name="delete" value="1" hidden>
										<input type="text" name="date" value="<?php echo date("j M, Y"); ?>" hidden>
										<input type="text" name="blogid" value="<?php echo $rowItem['blogid']; ?>" hidden>

										<br/><br/>
											
										<input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="submiteditblog"  id="submitnow" value="EDIT BLOG" />
							        </form>

								</div>
								
							<?php } // end while loop?>			
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>

<?php include_once("footer.php"); ?>

<?php

	if (isset($_POST['submiteditblog'])) {
		

		if (isset($_FILES['photo'])) {
			$saveddate = date("mdy-hms");
			$name_array = $_FILES['photo']['name'];
			$tmp_name_array = $_FILES['photo']['tmp_name'];
			
			$type_array = $_FILES['photo']['type'];
			$size_array = $_FILES['photo']['size'];
			$error_array = $_FILES['photo']['error'];

			for ($i=0; $i < count($tmp_name_array); $i++) { 

				if ($name_array[$i]!='') {
					$new_name[$i] = $saveddate."_".$name_array[$i];
				}else{
					$new_name[$i] = "";
				}
				
				$new_name[$i] = preg_replace('#[^a-z.0-9]#i', '', $new_name[$i]); // filter
				$name_ext = explode(".", $new_name[$i]); // Split file name into an array using the dot
				$new_name_Ext = end($name_ext); // Now target the last array element to get the file extension

				move_uploaded_file($tmp_name_array[$i], "../extrabox/img/blog/".$new_name[$i]);
			}

			// Collecting checked values from the form, and converting them from array to string using implode
			// while checking empty arrays and converting them into empty strings in other to avoid errors.
	    }	
	   		$categories = escapeString($_POST['categories']);
	   		$posttitle = escapeString($_POST['posttitle']);
			$description = escapeString($_POST['description']); 
			$display = escapeString($_POST['display']);
			$delete = escapeString($_POST['delete']);
			$date = escapeString($_POST['date']);
			$postedby = $_POST['postedby'];
			$blogid = $_POST['blogid'];

			$query = "SELECT * from blog WHERE blogid = '$blogid' LIMIT 1";
			$run_query = mysqli_query($connect, $query);
	   		confirm_query($run_query);

			$rowItem2 = mysqli_fetch_assoc($run_query);

			if (isset($new_name[0]) && !empty($new_name[0])) {
			  	$new_name[0];
				} else{
				$new_name[0]  = $rowItem2['image'];
			}

			// Checking submitted photos and passing through an empty string checker in other to avoid errors.
			// if (empty($name_array['name'])) {
			//   	$new_name[0]  = $rowItem2['image'];
			// 	} else{
			// 	$new_name[0];
			// }

			$query  = "UPDATE blog SET ";
			$query .= "category = '{$categories}', posttitle = '{$posttitle}', dated = '{$date}', image = '{$new_name[0]}', blogmessage = '{$description}', del = '{$delete}', display = '{$display}', postedby = '{$postedby}' WHERE blogid = '$blogid' ";

			$result = mysqli_query($connect, $query);
			confirm_query($result);

			if ($result) {
				//success
				$_SESSION["message"] = "Blog Successfully edited.";
				echo "<script>window.open('blogadmin.php', '_self')</script>";
			}else{
				// failure
				$message = "Entry creation failed, please check that all fields are correct before you submit.";
				echo "<script>window.open('blogadmin.php', '_self')</script>";
			}
	}
?>
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
