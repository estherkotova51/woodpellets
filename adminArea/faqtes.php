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
					<p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner8" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD FAQ</button></a></p>

              <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner9" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A TESTIMONIAL</button></a></p>
					<?php 
						$per_page=25;
						if (isset($_GET["tes"])) {
							$page = $_GET["tes"];
						}else {
							$page=1;
						}
						// Page will start from 0 and Multiple by Per Page
						$start_from = ($page-1) * $per_page;
						$query = "SELECT * from testimonials ORDER BY tesID DESC LIMIT $start_from, $per_page";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);

					?>

					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>All Testimonials</h1>
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
											<td><p><?php echo $rowItem['tesID']; ?></p> </td>
											<td>
												<p><?php echo $rowItem['tesTitle']; ?></p>
											</td>

											<td>
												<p><?php echo $rowItem['tesText']; ?>  <span>|<?php echo $rowItem['tesBy']; ?></span> </p>
											</td>
											<td>
											<?php 
												if ($rowItem['tesDisplay'] == 0) {
													echo '<a href="approve.php?tesapp='.$rowItem['tesID'].'" class="buttons1">Approve</a>';
												}else{
													echo '<a href="approve.php?tessus='.$rowItem['tesID'].'" class="buttons2">Suspend</a>';
												}
											?>
											</td>
										</tr>
									</tbody>	
								<?php } // end while loop?>	
							</table>		
						</div>
						<!-- pagination start -->
						<div class="shop-pagination">
							<?php 
								$query = "SELECT * from testimonials";
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
											  echo '<li><a href="faqtes.php?tes='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="faqtes.php?tes='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="faqtes.php?tes='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
												}	
										}
									?>
								</ul>
							</div>					
						</div>
						<!-- pagination end -->
					</div>

					<?php 
						$per_page=25;
						if (isset($_GET["faq"])) {
							$page = $_GET["faq"];
						}else {
							$page=1;
						}
						// Page will start from 0 and Multiple by Per Page
						$start_from = ($page-1) * $per_page;
						$query = "SELECT * from faq ORDER BY faqId DESC LIMIT $start_from, $per_page";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);
					?>
					<br/><br/><br/>
					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>FAQs</h1>
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
										<td><p><?php echo $rowItem['faqId']; ?></p> </td>
										<td><p><?php echo $rowItem['faqQ']; ?></p> </td>
										<td><p><?php echo $rowItem['faqA']; ?></p> </td>
										<td><?php 
											if ($rowItem['faqD'] == 0) {
												echo '<a href="approve.php?faqapp='.$rowItem['faqId'].'" class="buttons1">Approve</a>';
											}else{
												echo '<a href="approve.php?faqsus='.$rowItem['faqId'].'" class="buttons2">Suspend</a>';
											}
										?> </td>
										
									</tr>
								</tbody>		
							</div>
							<!-- single-product end -->		
							<?php } // end while loop?>	
							</table>		
						</div>
						<!-- pagination start -->
						<div class="shop-pagination">
							<?php 
								$query = "SELECT * from faq";
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
											  echo '<li><a href="faqtes.php?faq='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="faqtes.php?faq='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="faqtes.php?faq='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
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
	                      <h5 class="modal-title" id="modalLabel" >ADD FAQ</h5>
	                  </div>  <!-- modal-header -->
	                  
	                  <div class="modal-body" style="background-color:#f0f0f0;">
	                  <form  action="#" method="post">
	                  <div class="form-group" style="text-align: left;">
	                          <label for="faqQ" > Question:</label>
	                          <p href="" data-toggle="tooltip" data-placement="top" title="Please enter your Question">
	                              <input style="width:100%;" class="form-control" type="text" id="faqQ" name="faqQ"  placeholder="Question"  required/>
	                          </p>
	                      </div>
	                      <div class="form-group" style="text-align: left;">
			                  <label for="faqA">Answer: </label> 
						      <p href="" data-toggle="tooltip" data-placement="top" title="Please enter an answer">
						        <textarea class="form-control ckeditor" wrap="soft" rows="10" name="faqA" id="faqA"  placeholder="Please include any other specifications we have to pay attention to." required></textarea>
							     </p>
				            </div>
	                      <div class="form-group" style="text-align: left;">
	                          <input type="text" name="faqD" value="1" hidden/>
	                          </p>
	                      </div>
	                          <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="faqsend" value="SUBMIT FAQ" />
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
	              <h5 class="modal-title" id="modalLabel" >ADD A TESTIMONIAL </h5>
	          </div>  <!-- modal-header -->
	          
	          <div class="modal-body" style="background-color:#f0f0f0;">
	          <form  action="#" method="post">
	          <div class="form-group" style="text-align: left;">
	              <label for="tesTitle" > Testimonial Title:</label>
	              <p href="" data-toggle="tooltip" data-placement="top" title="Please enter a Title">
	                  <input style="width:100%;" class="form-control" type="text" id="tesTitle" name="tesTitle"  placeholder="Title"  required/>
	              </p>
	          </div>
	          <div class="form-group" style="text-align: left;">
	              <label for="tesBy" >Posted By:</label>
	              <p href="" data-toggle="tooltip" data-placement="top" title="Please enter your Name">
	                  <input style="width:100%;" class="form-control" type="text" id="tesBy" name="tesBy"  placeholder="Your Name"  required/>
	              </p>
	          </div>
	          <div class="form-group" style="text-align: left;">
                  <input type="text" name="tesDisplay" value="1" hidden/>
                  </p>
              </div>
	          <div class="form-group" style="text-align: left;">
                  <label for="tesText"> Testimonial </label> 
			      <p href="" data-toggle="tooltip" data-placement="top" title="Please enter Testimonial .">
			        <textarea class="form-control ckeditor" wrap="soft" rows="10" name="tesText" id="tesText" placeholder="Please include any other specifications we have to pay attention to." required></textarea>
				     </p>
	             </div>
	            <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="tessend" value="ADD A TESTIMONIAL" />
	          </form>

	          </div>   <!-- modal-body -->
	          
	          <div class="modal-footer" style="background-color:#298042; color: #fff;">
	              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
	          </div>
	      </div> <!-- modal-content -->
	  </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->

	<?php 

    if (isset($_POST['faqsend'])) {

        $faqQ = escapeString($_POST['faqQ']);
        $faqA = escapeString($_POST['faqA']);
        $faqD = escapeString($_POST['faqD']);
        if (empty($faqA)) {
            $_SESSION['message'] = "Sorry! Answer field can't be EMPTY.";
            echo "<script> window.open('faqtes.php');</script>";
        }else{
            $insert_c = "insert into faq ";
            $insert_c .= "(faqQ, faqA, faqD ";
            $insert_c .= ") values ( ";
            $insert_c .= " '$faqQ', '$faqA','$faqD') ";
            $run_c = mysqli_query($connect, $insert_c);
            confirm_query($insert_c);
            $_SESSION['message'] = "FAQ received.";
            echo "<script>window.open('faqtes', '_self')</script>";
        }
    }

    if (isset($_POST['tessend'])) {

        $tesTitle = escapeString($_POST['tesTitle']);
        $tesBy = escapeString($_POST['tesBy']);
        $tesDisplay = escapeString($_POST['tesDisplay']);
        $tesText = escapeString($_POST['tesText']);
        if (empty($tesBy)) {
            $_SESSION['message'] = "Sorry! Posed By field can't be EMPTY.";
            echo "<script> window.open('faqtes.php');</script>";
        }else{
            $insert_c = "insert into testimonials ";
            $insert_c .= "(tesTitle, tesBy, tesText, tesDisplay ";
            $insert_c .= ") values ( ";
            $insert_c .= " '$tesTitle', '$tesBy','$tesText', '$tesDisplay') ";
            $run_c = mysqli_query($connect, $insert_c);
            confirm_query($insert_c);
            $_SESSION['message'] = "Testimonial received.";
            echo "<script>window.open('faqtes', '_self')</script>";
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
