<?php require_once('navigationadmin.php'); ?>
<?php confirm_staff_logged_in(); ?>
<?php 
    if (isset($_GET['trco'])) {
        $trackcode = $_GET['trco'];

        // $query = "SELECT * from pickuprequests WHERE trackingcode = '{$trackcode}' Limit 1";
        // $run_query = mysqli_query($connect, $query);
        // confirm_query($run_query); 
?>

        <!-- Modal for log in -->
        <div class="row" style="width:70%; text-align: center; position:relative; left:50%; transform: translate(-50%);">        
                <div class="modal-header" style="background-color:#d9d9d9; color: #fff; text-align: center;">
                    <h5 class="modal-title" id="modalLabel" >CONFIRM DELETE FOR: <?php echo $trackcode; ?></h5>
                </div>  <!-- modal-header -->
                
                <div class="modal-body" style="background-color:#f0f0f0;">
                	<h4>Are you sure you want to delete?</h4>

	                <form  action="#" method="post" style="width:80%; text-align: center; position:relative; left:50%; transform: translate(-50%);">
	                    <div class="form-group row">
	                    	<div class="form-group col-sm-6">
								<input style="background-color:#f00; color: #fff;" class="btn btn-default" type="submit" name="canceldel" value="CANCEL" />	
							</div>
							<div class="form-group col-sm-6">
	                           <input style="background-color:green; color: #fff;" class="btn btn-default" type="submit" name="admitdel" value="DELETE" />
	                        </div>
	                    </div>
	                    <hr/>
	                </form>

                </div>   <!-- modal-body -->
        </div>        
<?php  } ?>
	 

<?php 
	$trackcode = $_GET['trco'];

    if (isset($_POST['admitdel'])) {
        $query = "UPDATE pickuprequests SET deleteitem = 1 WHERE trackingcode = '{$trackcode}' Limit 1";
        $run_query = mysqli_query($connect, $query);
        confirm_query($run_query);
        $_SESSION["message"] = "This tracking has been made INVALID";
        echo "<script> window.open('index.php', '_self');</script>";
    }elseif (isset($_POST['canceldel'])){
    	$_SESSION["message"] = "Please do not joke again.";
        echo "<script> window.open('index.php', '_self');</script>";
    }
?>


<?php include_once('footerstaff.php'); ?>

	    	<!-- OFFCANVAS MENU -->
	    	<?php include_once('offcanvasmenustaff.php'); ?>
	


		<!-- Preloader -->
		<!-- <div id="preloader">
			<div id="status">
				<div class="status-mes"></div>
			</div>
		</div> -->


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
