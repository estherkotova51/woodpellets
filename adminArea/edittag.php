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
						if (isset($_GET["edtag"])) {
							$page = $_GET["edtag"];
							$query = "SELECT * from producttag WHERE tagId = '$page'   LIMIT 1";
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
								
                                <form  action="#" method="post" enctype="multipart/form-data">
                
                                    <div class="form-group" style="text-align: left;">
                                        <p>ADD based on product Category</p>
                                        <select name="categories" id="categories" class="form-control">
                                            <option value="<?php echo $rowItem['tagCategory'] ?>"><?php echo $rowItem['tagCategory'] ?></option>
                                            <option value="">Leave this Field Empty</option>
                                            <option value="allcategories">All Categories</option>
                                            <?php
                                                $query = "SELECT * FROM categories ORDER BY catid asc";
                                                $run_query = mysqli_query($connect, $query);
                                                confirm_query($run_query);
                                                $num_rows = mysqli_num_rows($run_query);
                                            ?>
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
                                        <p>ADD based on Product Name</p>
                                        <select name="prodname" id="prodname" class="form-control">
                                            <option value="<?php echo $rowItem['tagProduct'] ?>"><?php echo $rowItem['tagProduct'] ?></option>
                                            <option value="">Leave this Field Empty</option>
                                            <option value="allprodname">All Product Names</option>
                                            <?php
                                                $query = "SELECT * FROM pillshome ORDER BY prod_id asc";
                                                $run_query = mysqli_query($connect, $query);
                                                confirm_query($run_query);
                                                $num_rows = mysqli_num_rows($run_query);
                                            ?>
                                            <?php 
                                                if ($num_rows > 0) {
                                                    while ($row = mysqli_fetch_array($run_query)) {
                                                        echo'<option value="'.$row['prodname'].'">'.$row['prodname'].'</option>';
                                                    }
                                                }else{
                                                    echo'<option value="">Category not available</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group" style="text-align: left;">
                                        <p>ADD based on Blog Category</p>
                                        <select name="blogcattitle" id="blogcattitle" class="form-control">
                                            <option value="<?php echo $rowItem['tagBlog'] ?>"><?php echo $rowItem['tagBlog'] ?></option>
                                            <option value="">Leave this Field Empty</option>
                                            <option value="allblogpost">All Blog Categories</option>
                                            <?php
                                                $query = "SELECT * FROM blogcat ORDER BY blogcatid asc";
                                                $run_query = mysqli_query($connect, $query);
                                                confirm_query($run_query);
                                                $num_rows = mysqli_num_rows($run_query);
                                            ?>
                                            <?php 
                                                if ($num_rows > 0) {
                                                    while ($row = mysqli_fetch_array($run_query)) {
                                                        echo'<option value="'.$row['blogcattitle'].'">'.$row['blogcattitle'].'</option>';
                                                    }
                                                }else{
                                                    echo'<option value="">Blog category not available</option>';
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group has-feedback" style="text-align: left;">
                                        <label for="description"> Keywords (Place a comma " , " at the end of each keyword) </label> 
                                        <textarea class="form-control ckeditor" wrap="soft" rows="10" name="tagKeywords" id="tagKeywords" placeholder="Please include any other specifications we have to pay attention to." required><?php echo $rowItem['tagKeywords'] ?></textarea>
                                        
                                    </div>
                                    <input  type="text" name="display" value="1" hidden>
                                                        
                                    <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="submittagedit" id="submitnow" value="Submit" />
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

	if (isset($_POST['submittagedit'])) {
	
            $categories  = escapeString($_POST['categories']);
            $prodname  = escapeString($_POST['prodname']);
            $blogcattitle  = escapeString($_POST['blogcattitle']);
            $tagKeywords  = escapeString($_POST['tagKeywords']);
            $display  = escapeString($_POST['display']);
			$tagId = escapeString($_GET['edtag']);

            $query  = "UPDATE producttag SET ";
            
            $query .= " tagKeywords='{$tagKeywords}', tagCategory='{$categories}', tagProduct='{$prodname}', tagBlog='{$blogcattitle}', tagDisplay='{$display}' WHERE tagId = '$tagId' ";

			$result = mysqli_query($connect, $query);
			confirm_query($result);

			if ($result) {
				//success
				$_SESSION["message"] = "Tag Successfully edited.";
				echo "<script>window.open('producttags.php', '_self')</script>";
			}else{
				// failure
				$message = "Entry creation failed, please check that all fields are correct before you submit.";
				echo "<script>window.open('producttags.php', '_self')</script>";
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
