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
                    
					<?php 

						$query = "SELECT * from companyd ORDER BY compId DESC";
						$run_query = mysqli_query($connect, $query);
		   				confirm_query($run_query);
                        
                        $numrowsseen = mysqli_num_rows($run_query);

                        if ($numrowsseen != 0) {
                    ?>
							<p style="float:left; display:block; margin-right: 10px;"><a href="#?editcomp"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner10" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;">EDIT COMPANY DETAILS</button></a></p>
					<?php	
                    
                        } else {
					?>	
                        <p style="float:left; display:block; margin-right: 10px;"><a href="#"><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#cowner9" class="btn btn-default" style="background-color:#298c31; color: #fff; border: 1px solid #fff;"> COMPANY DETAILS</button></a></p>
					<?php	} ?>

					<div class="clear"></div>
					<div class="row">
						<div class="magic-area fix">
							<h1>All Company Details</h1>
							<!-- single-product start -->
							<table class="table table-bordered">
								<thead>
									<tr>
										<th scope="col">Items</th>
										<th scope="col">Details</th>
									</tr>
								</thead>
								<?php $rowItem = mysqli_fetch_assoc($run_query) ?>
									<tbody>
										<tr> 
											<td>
                                                Name:<br/>
                                                Email:<br/>
                                                Address:<br/>
                                                Phone:<br/>
                                                WhatsApp:<br/>
                                                Facebook:<br/>
                                                Instagram:<br/>
                                                Wickr:<br/>
                                                Snapchat:<br/>
                                                Telegram:<br/>
                                                Description:<br/>
                                        
                                            </td>
											<td>
                                                <?php echo $rowItem["compName"]?> <br/>
                                                <?php echo $rowItem["compEmail"]?> <br/>
                                                <?php echo $rowItem["compAddress"]?> <br/>
                                                <?php echo $rowItem["compPhone"]?> <br/>
                                                <?php echo $rowItem["compWhatsapp"]?> <br/>
                                                <?php echo $rowItem["compFacebook"]?> <br/>
                                                <?php echo $rowItem["compInstagram"]?> <br/>
                                                <?php echo $rowItem["compWickr"]?> <br/>
                                                <?php echo $rowItem["compSnapchat"]?> <br/>
                                                <?php echo $rowItem["compTelegram"]?> <br/>
                                                <?php echo $rowItem["compDescription"]?>
                                        
                                            </td>
										</tr>
									</tbody>	
								<!-- single-product end -->	
							</table>		
						</div>
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
	              <h5 class="modal-title" id="modalLabel" >ADD COMPANY DETAILS </h5>
	          </div>  <!-- modal-header -->
	          
	          <div class="modal-body" style="background-color:#f0f0f0;">
	          <form  action="#" method="POST" enctype="multipart/form-data">
	          	
		        <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-12" style="text-align: left;">
						 <label for="type">Name</label>
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Name">
		                        <input style="width:100%;" class="form-control" type="text" id="type" name="compName"  placeholder="Please enter Name"  required/>
		                    </p>
					</div>
					
		        </div>
                <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-6" style="text-align: left;">
						<label for="type">Address</label>
                        <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Address">
                            <input style="width:100%;" class="form-control" type="text" id="type" name="compAddress"  placeholder="Please enter Address"  required/>
                        </p>
					</div>
					<div class="form-group col-sm-6" style="text-align: left;">
						<label for="postedby">Email</label>
                        <p href="#" data-toggle="tooltip" data-placement="top" title="Email">
                            <input class="form-control" type="text" name="compEmail" placeholder="Please enter Email" required/>
                        </p>
					</div>
		        </div>

                <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-6" style="text-align: left;">
						<label for="type">Country Phone 1</label>
                        <select name="conphone1" class="form-control" required>
                            <option value="">Select a Country Phone 1</option>
                            <?php 
                                echo Allcountries()
                            ?>
                        </select>
					</div>
					<div class="form-group col-sm-6" style="text-align: left;">
						<label for="postedby" > Phone</label>
		                <p href="#" data-toggle="tooltip" data-placement="top" title="Phone">
		                    <input class="form-control" type="text" name="compPhone" placeholder="Please enter Phone" required/>
		                </p>
					</div>
		        </div>

                <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-6" style="text-align: left;">
						<label for="type">Country Phone 2 (Optional)</label>
                        <select name="conphone2" class="form-control">
                            <option value="">Select a Country Phone 2</option>
                            <?php 
                                echo Allcountries()
                            ?>
                        </select>
					</div>
					<div class="form-group col-sm-6" style="text-align: left;">
						<label for="postedby" > Phone 2 (Optional)</label>
		                    <input class="form-control" type="text" name="compPhone2" placeholder="Please enter Phone"/>
					</div>
		        </div>
                    <p>The following filed are optional</p>
                <div class="form-group row" style="text-align: left;">
					<div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > WhatsApp</label>
		                    <input class="form-control" type="text" name="compWhatsapp" placeholder="Enter Details"/>
					</div>
                    <div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > Facebook</label>
		                    <input class="form-control" type="text" name="compFacebook" placeholder="Enter Details"/>
					</div>
                    <div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > Instagram</label>
		                    <input class="form-control" type="text" name="compInstagram" placeholder="Enter Details"/>
					</div>

                    <div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > Wickr</label>
		                    <input class="form-control" type="text" name="compWickr" placeholder="Enter Details"/>
					</div>
                    <div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > Snapchat</label>
		                    <input class="form-control" type="text" name="compSnapchat" placeholder="Enter Details"/>
					</div>
                    <div class="form-group col-sm-4" style="text-align: left;">
						<label for="postedby" > Telegram</label>
		                    <input class="form-control" type="text" name="compTelegram" placeholder="Enter Details"/>
					</div>
		        </div>

		        <div class="form-group has-feedback" style="text-align: left;">
					<label for="description"> Description </label> 
					<textarea class="form-control ckeditor" wrap="soft" rows="10" name="compDescription" placeholder="Please include any other specifications we have to pay attention to." required></textarea>
					
				</div>
				<br/>
                <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-12" style="text-align: left;">
						 <label for="type">Photo</label>
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Name">
                            <input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" required style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>
		                    </p>
					</div>
		        </div>
					
				<input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="submitcomp" value="Submit" />
	          </form>

	          </div>   <!-- modal-body -->
	          
	          <div class="modal-footer" style="background-color:#298042; color: #fff;">
	              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
	          </div>
	      </div> <!-- modal-content -->
	  </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->

    <?php

        if (isset($_POST['submitcomp'])) {

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

					move_uploaded_file($tmp_name_array[$i], "../extrabox/img/logo/".$new_name[$i]);
				}

				// Collecting checked values from the form, and converting them from array to string using implode
				// while checking empty arrays and converting them into empty strings in other to avoid errors.
		  	}
            
            $compName = escapeString($_POST['compName']);
            $compEmail = escapeString($_POST['compEmail']);
            $compAddress = escapeString($_POST['compAddress']);

            $conphone1 = escapeString($_POST['conphone1']);
            $compPhone = escapeString($_POST['compPhone']);

            $conphone2 = escapeString($_POST['conphone2']);
            $compPhone2 = escapeString($_POST['compPhone2']);

            $compPhoneAll = $conphone1." :> ".$compPhone." || ".$conphone2." :> ".$compPhone2;

            $compWhatsapp = escapeString($_POST['compWhatsapp']);
            $compFacebook = escapeString($_POST['compFacebook']);
            $compInstagram = escapeString($_POST['compInstagram']);
            $compWickr = escapeString($_POST['compWickr']);
            $compSnapchat = escapeString($_POST['compSnapchat']);
            $compTelegram = escapeString($_POST['compTelegram']);
            $compDescription = escapeString($_POST['compDescription']);

            $query = "INSERT INTO ";
            $query .= " companyd ( " ;
            $query .= "compName, compEmail, compAddress, compPhone, compWhatsapp, compFacebook, compInstagram, compWickr, compSnapchat, compTelegram, compDescription, compLogo";
            $query .= " ) VALUES ( ";
            $query .= " '{$compName}', '{$compEmail}', '{$compAddress}', '{$compPhoneAll}', '{$compWhatsapp}', '{$compFacebook}', '{$compInstagram}', '{$compWickr}', '{$compSnapchat}', '{$compTelegram}', '{$compDescription}', '{$new_name[0]}' ";
            $query .= " )";

            $result = mysqli_query($connect, $query);
            confirm_query($result);

            if ($result) {
                //success
                $_SESSION["message"] = "Your entry was successfully created.";
                echo "<script>window.open('company.php', '_self')</script>";
            }else{
                // failure
                $message = "Entry creation failed, please check that all fields are correct before you submit.";
                echo "<script>window.open('company.php', '_self')</script>";
            }
        }

    ?>

    <?php 
   
        $query = "SELECT * FROM companyd";
        $run_query = mysqli_query($connect, $query);
        confirm_query($run_query);

        $rowItem = mysqli_fetch_assoc($run_query);
        
    ?>
    <div class="modal fade" id="cowner10" tabindex="-1" role="dialog" aria-labelledby="modalLabel" style="top:40px; z-index: 999999;">
	    <div class="modal-dialog" role="document">
	      <div class="modal-content">
	          
	          <div class="modal-header" style="background-color:#298042; color: #fff; text-align: center;">
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: red;"><span aria-hidden="true">&times;</span></button>
	              <h5 class="modal-title" id="modalLabel" >EDIT COMPANY DETAILS </h5>
	          </div>  <!-- modal-header -->
	          
	          <div class="modal-body" style="background-color:#f0f0f0;">
                <form  action="#" method="POST" enctype="multipart/form-data">
                    
                    <div class="form-group row" style="text-align: left;">
                        <div class="form-group col-sm-12" style="text-align: left;">
                            <label for="type">Name</label>
                                <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Name">
                                    <input style="width:100%;" class="form-control" type="text" value="<?php echo $rowItem['compName']; ?>" name="ecompName"  placeholder="Please enter Name"  required/>
                                </p>
                        </div>
                        
                    </div>
                    <div class="form-group row" style="text-align: left;">
                        <div class="form-group col-sm-6" style="text-align: left;">
                            <label for="type">Address</label>
                            <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Address">
                                <input style="width:100%;" class="form-control" type="text" value="<?php echo $rowItem['compAddress']; ?>" name="ecompAddress"  placeholder="Please enter Address"  required/>
                            </p>
                        </div>
                        <div class="form-group col-sm-6" style="text-align: left;">
                            <label for="postedby">Email</label>
                            <p href="#" data-toggle="tooltip" data-placement="top" title="Email">
                                <input class="form-control" type="text" value="<?php echo $rowItem['compEmail']; ?>" name="ecompEmail" placeholder="Please enter Email" required/>
                            </p>
                        </div>
                    </div>

                    <div class="form-group row" style="text-align: left;">
                        
                        <div class="form-group col-sm-12" style="text-align: left;">
                            <label for="postedby" > Phone</label>
                            <p href="#" data-toggle="tooltip" data-placement="top" title="Phone">
                                <input class="form-control" type="text" name="ecompPhone" value="<?php echo $rowItem['compPhone']; ?>" placeholder="Please enter Phone" required/>
                            </p>
                        </div>
                    </div>

                        <p>The following filed are optional</p>
                    <div class="form-group row" style="text-align: left;">
                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > WhatsApp</label>
                                <input class="form-control" type="text"  value="<?php echo $rowItem['compWhatsapp']; ?>" name="ecompWhatsapp" placeholder="Enter Details"/>
                        </div>
                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > Facebook</label>
                                <input class="form-control" type="text" value="<?php echo $rowItem['compFacebook']; ?>" name="ecompFacebook" placeholder="Enter Details"/>
                        </div>
                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > Instagram</label>
                                <input class="form-control" type="text" value="<?php echo $rowItem['compInstagram']; ?>" name="ecompInstagram" placeholder="Enter Details"/>
                        </div>

                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > Wickr</label>
                                <input class="form-control" type="text" value="<?php echo $rowItem['compWickr']; ?>" name="ecompWickr" placeholder="Enter Details"/>
                        </div>
                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > Snapchat</label>
                                <input class="form-control" type="text" value="<?php echo $rowItem['compSnapchat']; ?>" name="ecompSnapchat" placeholder="Enter Details"/>
                        </div>
                        <div class="form-group col-sm-4" style="text-align: left;">
                            <label for="postedby" > Telegram</label>
                                <input class="form-control" type="text" value="<?php echo $rowItem['compTelegram']; ?>" name="ecompTelegram" placeholder="Enter Details"/>
                        </div>
                    </div>

                    <div class="form-group has-feedback" style="text-align: left;">
                        <label for="description"> Description </label> 
                        <textarea class="form-control ckeditor" wrap="soft" rows="10" name="ecompDescription" placeholder="Please include any other specifications we have to pay attention to." required><?php echo $rowItem['compDescription']; ?></textarea>
                        
                    </div>
                    <br/>
                    <div class="form-group row" style="text-align: left;">
		        	<div class="form-group col-sm-12" style="text-align: left;">
						 <label for="type">Photo</label>
		                    <p href="#" data-toggle="tooltip" data-placement="top" title="Please enter Name">
                            <input class="form-control" type="file" id="photo" name="photo[]" value="" accept="image/*" style="width:100%; height:50px; padding:10px 10px; margin-bottom: 5px; background-color: #3657c9; color:#fff;"/>
		                    </p>
					</div>
		        </div>
                        
                    <input style="width:100%; background-color:#298c31; color: #fff;" class="btn btn-default" type="submit" name="editComp" value="EDIT" />
                </form>

	          </div>   <!-- modal-body -->
	          
	          <div class="modal-footer" style="background-color:#298042; color: #fff;">
	              <button type="button" data-dismiss="modal" class="btn btn-default" style="background-color:#298042; color: #fff; border: 1px solid #fff;"> Close</button>
	          </div>
	      </div> <!-- modal-content -->
	  </div>  <!-- modal-dialog -->
	</div>  <!-- modal -->


    <?php

        if (isset($_POST['editComp'])) {

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
    
                    move_uploaded_file($tmp_name_array[$i], "../extrabox/img/logo/".$new_name[$i]);
                }
    
                // Collecting checked values from the form, and converting them from array to string using implode
                // while checking empty arrays and converting them into empty strings in other to avoid errors.
            }

            $ecompName = escapeString($_POST['ecompName']);
            $ecompEmail = escapeString($_POST['ecompEmail']);
            $ecompAddress = escapeString($_POST['ecompAddress']);
            $ecompPhone = escapeString($_POST['ecompPhone']);
            $ecompWhatsapp = escapeString($_POST['ecompWhatsapp']);
            $ecompFacebook = escapeString($_POST['ecompFacebook']);
            $ecompInstagram = escapeString($_POST['ecompInstagram']);
            $ecompWickr = escapeString($_POST['ecompWickr']);
            $ecompSnapchat = escapeString($_POST['ecompSnapchat']);
            $ecompTelegram = escapeString($_POST['ecompTelegram']);
            $ecompDescription = escapeString($_POST['ecompDescription']);

            $querycomp = "SELECT * from companyd WHERE compId =1";
			$run_querycomp = mysqli_query($connect, $querycomp);
	   		confirm_query($run_querycomp);

			$rowItem2 = mysqli_fetch_assoc($run_querycomp);

			if (isset($new_name[0]) && !empty($new_name[0])) {
			  	$new_name[0];
				} else{
				$new_name[0]  = $rowItem2['compLogo'];
			}

            $query2 = "UPDATE companyd SET ";
            $query2 .= " compName='{$ecompName}', compEmail='{$ecompEmail}', compAddress='{$ecompAddress}', compPhone='{$ecompPhone}', compWhatsapp='{$ecompWhatsapp}', compFacebook='{$ecompFacebook}', compInstagram='{$ecompInstagram}', compWickr='{$ecompWickr}', compSnapchat='{$ecompSnapchat}', compTelegram='{$ecompTelegram}', compDescription='{$ecompDescription}', compLogo='{$new_name[0]}' WHERE compId =1";

            $result2 = mysqli_query($connect, $query2);
            confirm_query($result2);

            if ($result2) {
                //success
                $_SESSION["message"] = "Your entry was successfully created.";
                echo "<script>window.open('company.php', '_self')</script>";
            }else{
                // failure
                $message = "Entry creation failed, please check that all fields are correct before you submit.";
                echo "<script>window.open('company.php', '_self')</script>";
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
