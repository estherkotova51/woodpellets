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

                    <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner9" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> ADD A Notification</button></a></p>
					<?php 
						$per_page=25;
						if (isset($_GET["pt"])) {
							$page = $_GET["pt"];
						} else {
							$page=1;
						}
						// Page will start from 0 and Multiple by Per Page
						$start_from = ($page-1) * $per_page;
						$query = "SELECT * from notifications ORDER BY noId DESC LIMIT $start_from, $per_page";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);
					?>

					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>All Notifications</h1>
							<!-- single-product start -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">No.</th>
										<th scope="col">Product Name</th>
										<th scope="col">Purchaser(s)</th>
										<th scope="col">Action</th>
									</tr>
								</thead>
								<?php while ($rowItem = mysqli_fetch_assoc($run_query)) { ?>
									<tbody>
										<tr> 
											<td><?php echo $rowItem['noId']; ?> </td>
											<td><p><?php echo $rowItem['noByProd']; ?></p> </td>
											<td>
                                                <p><?php echo $rowItem['noByName']; ?></p>
                                                <p><?php echo $rowItem['noByCity']; ?></p>
                                                <p><?php echo $rowItem['noByQty']; ?></p> 
											</td>
												
												<td> 
												<?php 
													if ($rowItem['noBydisplay'] == 0) {
														echo '<a href="approve.php?notapp='.$rowItem['noId'].'" class="buttons1">Approve</a>';
													}else{
														echo '<a href="approve.php?notsus='.$rowItem['noId'].'" class="buttons2">Suspend</a>';
													}
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
								$query = "SELECT * from notifications where noId=1";
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
											  echo '<li><a href="notifications.php?pt='.$k.'&'.$u.' "><i class="fa fa-angle-left"></i></a></li>';
											}
											
											for ($i=1; $i<=$total_pages; $i++) {
												if ($i==$page) {
													echo '<li class="active"><span>'.$i.'</span></li>';
												} else{
													echo '<li><a href="notifications.php?pt='.$i. '&'.$u.'">'.$i.'</a></li>';
												}
											
											}

											if ($page != $total_pages) {
												$j = $page+1;
												  echo '<li><a href="notifications.php?pt='.$j.'&'.$u.' "><i class="fa fa-angle-right"></i></a></li>';
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
	              <h5 class="modal-title" id="modalLabel" >Notifications </h5>
	          </div>  <!-- modal-header -->
	          
              <div class="modal-body" style="background-color:#f0f0f0;">
              
	          <form  action="#" method="post" enctype="multipart/form-data">

                <div class="form-group" style="text-align: left;">
                    <p>Select Purchased Product Name</p>
                    <select name="prodname" id="prodname" class="form-control">
                        <option value="">Select a Product Name</option>
                        <?php
                            $query = "SELECT * FROM pillshome ORDER BY prod_id asc";
                            $run_query = mysqli_query($connect, $query);
                            confirm_query($run_query);
                            $num_rows = mysqli_num_rows($run_query);
                        ?>
                        <?php 
                            if ($num_rows > 0) {
                                while ($row = mysqli_fetch_array($run_query)) {
                                    echo '<option value="'.$row['prodname'].'">'.$row['prodname'].'</option>';
                                }
                            }
                        ?>
                    </select>
                                
                </div>


		        <div class="form-group row" style="text-align: left;">
                    <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="purname" > Purchaser Name</label>
                            <p href="" data-toggle="tooltip" data-placement="top" title="Please enter Old Price">
                                    <input style="width:100%;" class="form-control" type="text" id="purname" name="purname"  placeholder="Purchaser Name"  required/>
                            </p>
                    </div>
                    <div class="form-group col-sm-4" style="text-align: left;">
                        <label for="purcity">Purchaser City</label>
                            <p href="" data-toggle="tooltip" data-placement="top" title="Please enter New Price">
                                <input style="width:100%;" class="form-control" type="text" id="purcity" name="purcity"  placeholder="Purchaser City"  required/>
                            </p>
                    </div>
                    <div class="form-group col-sm-4" style="text-align: left;">
                        <label for="purqty">Purchased Quantity</label>
                            <p href="" data-toggle="tooltip" data-placement="top" title="Please enter New Price">
                                <input style="width:100%;" class="form-control" type="text" id="purqty" name="purqty"  placeholder="Purchased Quantity"  required/>
                            </p>
                    </div>
                </div>
                <input  type="hidden" name="display" value="1" >
                <input  type="hidden" name="date" value="<?php $dated = date('Y-m-d H:i:s'); echo $dated; ?>" >
									
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

            $prodname  = escapeString($_POST['prodname']); 
            $purname  = escapeString($_POST['purname']); 
            $purcity  = escapeString($_POST['purcity']); 
            $purqty  = escapeString($_POST['purqty']); 
            $display  = escapeString($_POST['display']); 
            $date  = escapeString($_POST['date']); 

            

            $query  = "INSERT INTO ";
            $query .= " notifications ( " ;
            $query .= " noByName, noByCity, noByQty, noByProd, noByDura, noBydisplay ";
            $query .= " ) VALUES ( ";
            $query .= " '{$purname}', '{$purcity}', '{$purqty}', '{$prodname}', '{$date}', '{$display}' ";
            $query .= " )";

            $result = mysqli_query($connect, $query);
            confirm_query($result);

            if ($result) {
                //success
                $_SESSION["message"] = "Your entry was successfully created.";
                echo "<script>window.open('notifications.php', '_self')</script>";
            }else{
                // failure
                $message = "Entry creation failed, please check that all fields are correct before you submit.";
                echo "<script>window.open('notifications.php', '_self')</script>";
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
