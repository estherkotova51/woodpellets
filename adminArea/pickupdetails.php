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



<div class="shop-area" style="margin-top:30px;"><!--Start Shop Area-->
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<!-- widget-categories start -->
					<?php require_once('adminsidenav.php'); ?>
					<!-- widget-categories end -->
				</div>
				<form  action="#" method="post" id="proform" name="theformx"  >
					<div class="col-md-6">
						<div class="row">
			
							<div class="col-xs-12">
							
								
									<!-- Progress Bar -->
										<p style="text-align:center; color:#fff; font-size:24px; background-color: #298042; padding: 15px 10px;">EDIT PICK UP DETAILS</p>

										
										<?php
										    global $connect;

											$query = "SELECT * FROM pickup ORDER BY payopt ASC";
											$run_query = mysqli_query($connect, $query);
											confirm_query($run_query);
											$num_rows = mysqli_num_rows($run_query);
										?>
										<div class="form-group" style="text-align: left;">
											<p>Select Payment Medium</p>
											<select name="payopt" id="payopt" class="form-control">
												<option value="">Select a Medium</option>
												<?php 
													if ($num_rows > 0) {
														while ($row = mysqli_fetch_array($run_query)) {
															echo'<option value="'.$row['payopt'].'">'.$row['payopt'].'</option>';
														}
													}else{
														echo'<option value="">Category not available</option>';
													}
												?>
											</select>
										</div>
										<div class="form-group" style="text-align: left;">
			                                 <label for="firstN"> First Name</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter First Name">
			                                        <input style="width:100%;" class="form-control" type="text" id="firstN" name="firstN"  placeholder="First Name" required/>
			                                    </p>
			                            </div>

			                            <div class="form-group" style="text-align: left;">
			                                 <label for="lastN"> Last/Other Name</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Last Name/Other Names">
			                                        <input style="width:100%;" class="form-control" type="text" id="lastN" name="lastN"  placeholder="Last/Other Name"  required/>
			                                    </p>
			                            </div>

			                            <div class="form-group" style="text-align: left;">
											 <label for="city"> City</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter City">
			                                        <input style="width:100%;" class="form-control" type="text" id="city" name="city"  placeholder="City"  required/>
			                                    </p>
										</div>

			                        	<div class="form-group" style="text-align: left;">
											 <label for="state"> State</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter State">
			                                        <input style="width:100%;" class="form-control" type="text" id="state" name="state"  placeholder="State"  required/>
			                                    </p>
										</div>
										<div class="form-group" style="text-align: left;">
			                                 <label for="zipcode"> Zipcode</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Zip Code">
			                                        <input style="width:100%;" class="form-control" type="text" id="zipcode" name="zipcode"  placeholder="Zip Code"  required/>
			                                    </p>
			                            </div>

			                            <div class="form-group" style="text-align: left;">
			                                 <label for="country"> Country</label>
			                                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Country">
			                                        <input style="width:100%;" class="form-control" type="text" id="country" name="country"  placeholder="Country"  required/>
			                                    </p>
			                            </div>

				                        
										<br/>
										<input type="submit" name="savepick" class="action-button" id="savepick" value="SAVE" style="width:100%; padding:10px 10px; margin-bottom: 5px; background-color: #11caa2; color:#fff; border:none;"/>
							</div>

						</div>

					</div>
				</form>

				<!-- BITCOIN -->
					<div class="col-md-3">
						<button  data-dismiss="modal" data-toggle="modal" data-target="#cowner15" style="width:100%; padding:10px 10px; margin-bottom: 5px; background-color: #683e08; color:#fff; border:none;">EDIT BITCOIN WALLET</button>
						
                      <button  data-dismiss="modal" data-toggle="modal" data-target="#cowner96" style="width:100%; padding:10px 10px; margin-bottom: 5px; background-color: #683eab; color:#fff; border:none;">EDIT PAYPAL ADDRESS</button>


						<!-- Modal for PAYPAL ADDRESS -->
    
					      <div class="modal fade" id="cowner96" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
					          <div class="modal-dialog" role="document">
					              <div class="modal-content">
					                  
					                  <div class="modal-header" style="background-color:#683eab; color: #fff; text-align: center;">
					                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;"><span aria-hidden="true">&times;</span></button>
					                      <h5 class="modal-title" id="modalLabel" style="color: #fff;">NEW PAYPAL ADDRESS</h5>
					                  </div>  <!-- modal-header -->
					                  
					                  <div class="modal-body" style="background-color:#f0f0f0;">
					                  <form  action="#" method="post">
					                  <div class="form-group" style="text-align: left;">
					                          <label for="c_name" > NEW PAYPAL ADDRESS:</label>
					                          <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your NEW PAYPAL ADDRESS">
					                              <input style="width:100%;" class="form-control" type="text" id="c_pay" name="payaddress"  placeholder="NEW PAYPAL ADDRESS"  required/>
					                          </p>
					                      </div>
					                     
					                          <input style="width:100%; background-color:#683eab; color: #fff;" class="btn btn-default" type="submit" name="newpay" value="CHANGE PAYPAL ADDRESS" />
					                  </form>

					                  </div>   <!-- modal-body -->
					                  
					                  <div class="modal-footer" style="background-color:#683eab; color: #fff;">
					                      <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#683eab; color: #fff; border: 1px solid #fff;"> Close</button>
					                  </div>
					              </div> <!-- modal-content -->
					          </div>  <!-- modal-dialog -->
					      </div>  
					<!-- End Modal for PAYPAL ADDRESS -->
                      
						<!-- Modal for Bitcoin Wallet -->
    
					      <div class="modal fade" id="cowner15" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
					          <div class="modal-dialog" role="document">
					              <div class="modal-content">
					                  
					                  <div class="modal-header" style="background-color:#cc7102; color: #fff; text-align: center;">
					                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;"><span aria-hidden="true">&times;</span></button>
					                      <h5 class="modal-title" id="modalLabel" style="color: #fff;">NEW BITCOIN WALLET</h5>
					                  </div>  <!-- modal-header -->
					                  
					                  <div class="modal-body" style="background-color:#f0f0f0;">
					                  <form  action="#" method="post">
					                  <div class="form-group" style="text-align: left;">
					                          <label for="c_name" > NEW BITCOIN WALLET:</label>
					                          <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter your NEW BITCOIN WALLET">
					                              <input style="width:100%;" class="form-control" type="text" id="c_name" name="bitaddress"  placeholder="NEW BITCOIN WALLET"  required/>
					                          </p>
					                      </div>
					                     
					                          <input style="width:100%; background-color:#683e08; color: #fff;" class="btn btn-default" type="submit" name="newbitc" value="CHANGE BITCOIN WALLET" />
					                  </form>

					                  </div>   <!-- modal-body -->
					                  
					                  <div class="modal-footer" style="background-color:#cc7102; color: #fff;">
					                      <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#cc7102; color: #fff; border: 1px solid #fff;"> Close</button>
					                  </div>
					              </div> <!-- modal-content -->
					          </div>  <!-- modal-dialog -->
					      </div>  
					<!-- End Modal for Bitcoin Wallet -->


						<?php 

							if (isset($_POST['savepick']) && !empty(isset($_POST['payopt'])) ) {
								
								$firstN  = escapeString($_POST['firstN']);
								$lastN   = escapeString($_POST['lastN']);
								$city   = escapeString($_POST['city']);
								$state   = escapeString($_POST['state']);
								$zipcode = escapeString($_POST['zipcode']);
								$country = escapeString($_POST['country']);

								$payopt  = escapeString($_POST['payopt']);

								$query  = "UPDATE pickup SET firstN='$firstN', lastN='$lastN', city='$city', state='$state', zipcode='$zipcode', country='$country' WHERE payopt='$payopt' ";

								$result = mysqli_query($connect, $query);
								confirm_query($result);

								if ($result) {
									//success
									$_SESSION["message"] = "Your PickUp was successfully Edited.";
								   	echo "<script>window.open('pickupdetails.php', '_self' )</script>";
								}else{
									// failure
									echo  "<p style='color:red; border:1px solid red; padding: 10px 20px;'>Please select a Payment Medium</p>";
								}

							}

							if (isset($_POST['newbitc'])) {
								
								$bitaddress  = escapeString($_POST['bitaddress']);

								$query  = "UPDATE bitaddress SET newbitaddress='$bitaddress' ";

								$result = mysqli_query($connect, $query);
								confirm_query($result);

								if ($result) {
									//success
									$_SESSION["message"] = "Your New Bitcoin Wallet was successfully Edited.";
								   	echo "<script>window.open('pickupdetails.php', '_self' )</script>";
								}else{
									// failure
									echo  "<p style='color:red; border:1px solid red; padding: 10px 20px;'>Update failed.</p>";
								}

							}
                      
                      if (isset($_POST['newpay'])) {
								
								$payaddress  = escapeString($_POST['payaddress']);

								$query  = "UPDATE payaddress SET newpayaddress='$payaddress' ";

								$result = mysqli_query($connect, $query);
								confirm_query($result);

								if ($result) {
									//success
									$_SESSION["message"] = "Your New Paypal address was successfully Edited.";
								   	echo "<script>window.open('pickupdetails.php', '_self' )</script>";
								}else{
									// failure
									echo  "<p style='color:red; border:1px solid red; padding: 10px 20px;'>Update failed.</p>";
								}

							}

						?>
					</div>
				
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


