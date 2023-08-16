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

				<!-- blog-left-sidebar end -->
				<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 animated fadeInDown">
					<p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner8" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD BLOG CATEGORY</button></a></p>

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner9" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A BLOG POST</button></a></p>
					<?php 
						$per_page=6;
						if (isset($_GET["bl"])) {
							$page = $_GET["bl"];
						} else {
							$page=1;
						}
						// Page will start from 0 and Multiple by Per Page
						$start_from = ($page-1) * $per_page;
						$query = "SELECT * from blog ORDER BY blogid DESC LIMIT $start_from, $per_page";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);
					?>

					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>All Blog Post</h1>
							<!-- single-product start -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Title</th>
										<th scope="col">Main Text</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
									<tbody>
										<tr> 
											<td><?php echo $rowItem['blogid']; ?> </td>
											<td><img src="../extrabox/img/blog/<?php echo $rowItem['image']; ?>"> </td>
											<td>
												<h3><?php echo $rowItem['posttitle']; ?></h3>
												<p><?php echo $rowItem['blogmessage']; ?>  <span>|<?php echo $rowItem['postedby']; ?></span> </p> 
											</td>
												
												<td> 
												<?php 
													if ($rowItem['display'] == 0) {
														echo '<a href="approve.php?blogapp='.$rowItem['blogid'].'" class="buttons1">Approve</a>';
													}else{
														echo '<a href="approve.php?blogsus='.$rowItem['blogid'].'" class="buttons2">Suspend</a>';
													}
													echo '<br/><br/><br/><a href="editblog.php?edblog='.$rowItem['blogid'].'" class="buttons1">Edit Blog</a>';
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
								$query = "SELECT * from blog ";
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
											  echo '<li><a href="blogadmin.php?bl='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="blogadmin.php?bl='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="blogadmin.php?bl='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
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

	<div class="modal fade" id="cowner8" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
      <div class="modal-dialog" role="document">
          <div class="modal-content">
              
              <div class="modal-header" style="background-color:#298042; color: #fff; text-align: center;">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
                  <h5 class="modal-title" id="modalLabel" >ADD BLOG CATEGORY</h5>
              </div>  <!-- modal-header -->
              
              <div class="modal-body" style="background-color:#f0f0f0;">
              <form  action="#" method="post">
              <div class="form-group" style="text-align: left;">
                      <label for="blogcat" > Blog Category:</label>
                      <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your Blog Category">
                          <input style="width:100%;" class="form-control" type="text" id="blogcat" name="blogcat"  placeholder="Blog Category"  required/>
                      </p>
                  </div>
                  <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="blogcatsend" value="SUBMIT BLOG CATEGORY" />
              </form>

              </div>   <!-- modal-body -->
              
              <div class="modal-footer" style="background-color:#298042; color: #fff;">
                  <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
              </div>
          </div> <!-- modal-content -->
      </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->

	<div class="modal fade" id="cowner9" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
	  <div class="modal-dialog" role="document">
	      <div class="modal-content">
	          
	          <div class="modal-header" style="background-color:#298042; color: #fff; text-align: center;">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
	              <h5 class="modal-title" id="modalLabel" >ADD A BLOG POST </h5>
	          </div>  <!-- modal-header -->
	          
	          <div class="modal-body" style="background-color:#f0f0f0;">
	          <form  action="<?= $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
	          	<?php
					$query = "SELECT * FROM blogcat ORDER BY blogcatid asc";
					$run_query = mysqli_query($connect, $query);
					confirm_query($run_query);
					$num_rows = mysqli_num_rows($run_query);
				?>
				<div class="form-group" style="text-align: left;">
					<p>Select Blog's Category</p>
					<select name="categories" id="blogcat" class="form-control">
						<option value="">Select a Category</option>
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
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Title">
		                        <input style="width:100%;" class="form-control" type="text" id="type" name="posttitle"  placeholder="Please enter Title"  required/>
		                    </p>
					</div>
					<div class="form-group col-sm-4" style="text-align: left;">
						 <label for="postedby" > Posted by</label>
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Posted by" id="postedby">
		                        <input class="form-control" type="text" name="postedby" value="" placeholder="Please enter Name"  required />
		                    </p>
					</div>
					<div class="form-group col-sm-4" style="text-align: left;">
		                 <label for="productname">Photo</label>
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please select a photo">
		                        <input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" />
		                    </p>
		            </div>
		        </div>

		        <div class="form-group has-feedback" style="text-align: left;">
					<label for="description"> Message </label> 
					<textarea class="form-control ckeditor" wrap="soft" rows="10" name="tesText" id="tesText" placeholder="Please include any other specifications we have to pay attention to." required></textarea>
					
				</div>
				<input  type="text" name="display" value="1" hidden>
				<input  type="text" name="delete" value="1" hidden>
				<input type="text" name="date" value="<?php echo date("j M, Y"); ?>" hidden>

				<br/><br/>
					
				<input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="submitblog" id="submitnow" value="Submit" />
	          </form>

	          </div>   <!-- modal-body -->
	          
	          <div class="modal-footer" style="background-color:#298042; color: #fff;">
	              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
	          </div>
	      </div> <!-- modal-content -->
	  </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->

	<?php 

    if (isset($_POST['blogcatsend'])) {

        $blogcat = escapeString($_POST['blogcat']);
        if (empty($blogcat)) {
            $_SESSION['message'] = "Sorry! Category field can't be EMPTY.";
            echo "<script> window.open('blogadmin.php');</script>";
        }else{
            $insert_c = "insert into blogcat ";
            $insert_c .= "(blogcattitle ";
            $insert_c .= ") values ( ";
            $insert_c .= " '$blogcat') ";
            $run_c = mysqli_query($connect, $insert_c);
            confirm_query($insert_c);
            $_SESSION['message'] = "blog category received.";
            echo "<script>window.open('blogadmin', '_self')</script>";
        }
    }
	?>
	<?php

		if (isset($_POST['submitblog'])) {

			if (isset($_FILES['photo'])) {
				$saveddate = date("mdy-hms");
				$name_array = $_FILES['photo']['name'];
				$tmp_name_array = $_FILES['photo']['tmp_name'];
				
				$type_array = $_FILES['photo']['type'];
				$size_array = $_FILES['photo']['size'];
				$error_array = $_FILES['photo']['error'];

				for ($i=0; $i < count($tmp_name_array); $i++) { 
					
					$new_name[$i] = $saveddate."_".$name_array[$i];

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
				$description = escapeString($_POST['tesText']);
				$display = escapeString($_POST['display']);
				$delete = escapeString($_POST['delete']);
				$date = escapeString($_POST['dated']);
				$postedby = $_POST['postedby'];

				// Checking submitted photos and passing through an empty string checker in other to avoid errors.
				if (isset($new_name[0]) && !is_numeric($new_name[0])) {
				  	$new_name[0] ;
					} else{
					$new_name[0]  = "blogpost.jpg";
				}

				$query  = "INSERT INTO ";
				$query .= " blog ( " ;
				$query .= "category, posttitle, dated, image, blogmessage, del, display, postedby";
				$query .= " ) VALUES ( ";
				$query .= " '{$categories}', '{$posttitle}', '{$date}', '{$new_name[0]}', '{$description}', '{$delete}', '{$display}', '{$postedby}' ";
				$query .= " )";

				$result = mysqli_query($connect, $query);
				confirm_query($result);

				if ($result) {
					//success
					$_SESSION["message"] = "Your entry was successfully created.";
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
