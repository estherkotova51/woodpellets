<?php require_once('navigationadmin.php');?>


<?php $username = ""; ?>
<?php
if (isset($_POST['submit'])) {
// Process the form
	// Attempt login

	$s_name = $_POST["u_name"];
	$s_pass = $_POST["u_pass"];

	$sel_c = "SELECT * from staff where hashed_password='$s_pass' AND username='$s_name'";
	$run_c = mysqli_query($connect, $sel_c);
	 

	$check_customer = attempt_login_staff($s_name, $s_pass);
	

		if($check_customer) {
				$_SESSION['username'] = $s_name;

				$update_login_time = "UPDATE staff SET llogin=now() WHERE username='{$s_name}' LIMIT 1";
				$run_update_login_time = mysqli_query($connect, $update_login_time);

				$_SESSION['message'] = 'You Logged In Successfully, Thanks';
				echo "<script>window.open('index.php', '_self')</script>";
		}else{
			$_SESSION['message'] = 'Your Log In Failed, Thanks for trying again!';
			echo "<script>window.open('staff_log_in.php', '_self')</script>";
			exit();
	}
}

?>

<?php //include("../includes/layouts/header.php"); ?>
<div id="main">
			<body id="body" style="background:url('images/loginbgd.jpg'); background-position: center center; background-color: #fff;">
	
				<section class="counter-section" data-stellar-background-ratio="0.5">
		        	<div class="container">
						<div class="row" style="padding: 20px; background-color:#2d7ffa; ">

							<div class="col-md-3">&nbsp;</div>
							<div class="col-md-6">
								<h2 style="margin-bottom:10px;text-align: center; color:#fff;">Admin Log In</h2>
								 <form  action="staff_log_in.php" method="post">
									<div class="form-group">
										<label for="username" > Username:</label>
										<p href="" data-toggle="tooltip" data-placement="top" title="Please enter your Username">
											<input class="form-control" type="text" id="username" name="u_name"  value="<?php echo htmlentities($username); ?>" placeholder="Username Here"  required/></p>
									</div>
									<div class="form-group">
										<label for="password" > Password:</label>
										<p href="" data-toggle="tooltip" data-placement="top" title="Please enter your Password">
										<input class="form-control" type="password" id="password" name="u_pass" placeholder="Password Here"   required/></p>
									</div>
									 	<input class="btn btn-success pull-right" type="submit" name="submit" value="Log In" />
								 </form>
							</div>

							<div class="col-md-3">&nbsp;</div>
				      	</div> <!-- /.row -->
		        	</div><!-- /.container -->
		        </section><!-- /.counter-section -->

					 


	    <!-- jQuery -->
	    <script src="js/jquery.js"></script>
	    <!-- Bootstrap Core JavaScript -->
	    <script src="js/bootstrap.min.js"></script>
		<!-- Scrolling Nav JavaScript -->
	    <script src="js/jquery.easing.min.js"></script>
	    
	    <!-- owl.carousel -->
	    <script src="owl.carousel/owl.carousel.min.js"></script>
	    <!-- Magnific-popup -->
		<script src="js/jquery.magnific-popup.min.js"></script>
		<!-- Offcanvas Menu -->
		<script src="js/hippo-offcanvas.js"></script>
		<!-- stellar -->
		<script src="js/jquery.stellar.js"></script>
		<!-- classie -->
		<script src="js/classie.js"></script>
		<!-- sticky kit -->
		<script src="js/jquery.sticky-kit.min.js"></script>
		<!-- language select -->
		<script src="js/selectFx.js"></script>
		<!-- Twitter feed -->
		<script src="js/twitterFetcher_min.js"></script>
		<!-- Youtube Video-player -->
	    <script src="js/jquery.mb.YTPlayer.js"></script>
	    <!-- Custom Script -->
	    <script src="js/scripts.js"></script>

	</body>
</html>