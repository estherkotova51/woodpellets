<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>

<?php confirm_staff_logged_in(); ?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>  ADMIN ||<?= companyD("compName"); ?></title>
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

				<!-- blog-left-sidebar end -->
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 animated fadeInDown">

                 <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner9" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A Product Tag</button></a></p>
					<?php 
						$per_page=25;
						if (isset($_GET["pt"])) {
							$page = $_GET["pt"];
						} else {
							$page=1;
						}
						// Page will start from 0 and Multiple by Per Page
						$start_from = ($page-1) * $per_page;
						$query = "SELECT * from producttag ORDER BY tagId DESC LIMIT $start_from, $per_page";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);
					?>

					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>All Product Tags</h1>
							<!-- single-product start -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Keywords</th>
										<th scope="col">Tag Group(s)</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
									<tbody>
										<tr> 
											<td><?php echo $rowItem['tagId']; ?> </td>
											<td><p><?php echo $rowItem['tagKeywords']; ?></p> </td>
											<td>
                                                <p><?php echo $rowItem['tagCategory']; ?></p>
                                                <p><?php echo $rowItem['tagProduct']; ?></p>
                                                <p><?php echo $rowItem['tagBlog']; ?></p> 
											</td>
												
												<td> 
												<?php 
													if ($rowItem['tagDisplay'] == 0) {
														echo '<a href="approve.php?tagapp='.$rowItem['tagId'].'" class="buttons1">Approve</a>';
													}else{
														echo '<a href="approve.php?tagsus='.$rowItem['tagId'].'" class="buttons2">Suspend</a>';
													}
													echo '<br/><br/><br/><a href="edittag.php?edtag='.$rowItem['tagId'].'" class="buttons1">Edit Tag</a>';
												?>
												</td>
												<hr/>
										</tr>
									</tbody>	
								<!-- single-product end -->		
								<?php } // end while loop?>	
							</table>		
						</div>
						<!-- pagination start -->
						<div class="shop-pagination">
							<?php 
								$query = "SELECT * from producttag where tagDisplay=1";
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
											  echo '<li><a href="producttags.php?pt='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="producttags.php?pt='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="producttags.php?pt='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
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
	</div>

<?php include_once("footer.php"); ?>

	<div class="modal fade" id="cowner9" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
	  <div class="modal-dialog" role="document">
	      <div class="modal-content">
	          
	          <div class="modal-header" style="background-color:#298042; color: #fff; text-align: center;">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
	              <h5 class="modal-title" id="modalLabel" >ADD A Product Tags </h5>
	          </div>  <!-- modal-header -->
	          
              <div class="modal-body" style="background-color:#f0f0f0;">
              <p>You can add product tags for single or multiple categories</p>
	          <form  action="#" method="post" enctype="multipart/form-data">
                
                <div class="form-group" style="text-align: left;">
                    <p>ADD based on product Category</p>
                    <select name="categories" id="categories" class="form-control">
                        <option value="">Select a Category</option>
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
                        <option value="">Select a Product Name</option>
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
                        <option value="">Select a Blog Category</option>
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
					<textarea class="form-control" wrap="soft" rows="10" name="tagKeywords" id="tagKeywords" placeholder="Please include any other specifications we have to pay attention to." required></textarea>
					
				</div>
				<input  type="text" name="display" value="1" hidden>
									
				<input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="submittag" id="submitnow" value="Submit" />
	          </form>

	          </div>   <!-- modal-body -->
	          
	          <div class="modal-footer" style="background-color:#298042; color: #fff;">
	              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
	          </div>
	      </div> <!-- modal-content -->
	  </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->

	<?php

		if (isset($_POST['submittag'])) {

            $categories  = escapeString($_POST['categories']);
            $prodname  = escapeString($_POST['prodname']);
            $blogcattitle  = escapeString($_POST['blogcattitle']);
            $tagKeywords  = escapeString($_POST['tagKeywords']);
            $display  = escapeString($_POST['display']);

            $query  = "INSERT INTO ";
            $query .= " producttag ( " ;
            $query .= " tagKeywords, tagCategory, tagProduct, tagBlog, tagDisplay ";
            $query .= " ) VALUES ( ";
            $query .= " '{$tagKeywords}', '{$categories}', '{$prodname}', '{$blogcattitle}', '{$display}' ";
            $query .= " )";

            $result = mysqli_query($connect, $query);
            confirm_query($result);

            if ($result) {
                //success
                $_SESSION["message"] = "Your entry was successfully created.";
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
