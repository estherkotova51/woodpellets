<?php require_once('navigationadmin.php');?>
<?php confirm_staff_logged_in(); ?>

			<?php

				$per_page=18;
				if (isset($_GET["shp"])) {
				$page = $_GET["shp"];
				}else{
				$page=1;
				}
				// Page will start from 0 and Multiple by Per Page
				settype($page, "integer");
				$start_from = ($page-1) * $per_page;

				$query = "SELECT * FROM pickuprequests where deleteitem = 0";
				$result = mysqli_query($connect, $query);
				// Count the total records
				$total_records = mysqli_num_rows($result);

				//Using ceil function to divide the total records on per page
				$total_pages = ceil($total_records / $per_page);
				$start_from = ($page - 1) * $per_page + 1;
				if ($start_from == 0) {$start_from= 1;} // *it happens only for the first run*

				$y = $start_from+$per_page-1;

				if ($y < $per_page)   // happens when records less than per page  
					{$y = $per_page; } 
				else if ($y > $total_records)  // happens when result end is greater than total records  
					{$y = $total_records;}  
			?>
	


			<div class="row" style="padding:50px;">
				<div  style="background-color:#008499; color: #fff; text-align: center; padding:5px; margin-bottom: 5px;">
						<h3 style="color: #fff;">ALL PACKAGES</h3>
						<hr/><p><?php echo "Showing $start_from - $y of $total_records"; ?></p><hr/>
				</div> 
				<div class="row">
					<?php
							

						$alltrackrec = "SELECT * from pickuprequests where deleteitem = 0 ORDER BY id DESC LIMIT $start_from, $per_page";
						$run_alltrackrec = mysqli_query($connect, $alltrackrec);
						confirm_query($run_alltrackrec);

						while ($rowTrackRec = mysqli_fetch_array($run_alltrackrec)) { ?>
							
							<div class="col-md-4">
							<h4 style="background-color:#008499; color: #fff; text-align: center; padding:5px;min-height: 450px;">

								<span><small>Track code: </small></span><br/><?php echo strtoupper($rowTrackRec['trackingcode']); ?><br/><hr/>
								<span><small>Shipment Title: </small></span><br/><?php echo ucfirst($rowTrackRec['categories']); ?><br/>
								<span><small>Receiver's Name: </small></span><br/><?php echo ucfirst($rowTrackRec['ReceiverName']); ?><br/>
								<span><small>Destination: </small></span><br/><?php echo ucfirst($rowTrackRec['deleLoc']); ?><br/>
								<span><small>Current location: </small></span><br/><?php echo ucfirst($rowTrackRec['currentLocation']); ?><br/>
								<span><small>Date Submitted: <?php echo ucfirst($rowTrackRec['time_now']); ?></small></span><br/>
								<span><small>Status: <?php echo ucfirst($rowTrackRec['status']); ?></small></span><br/>
								<p>
								
								<?php if ($rowTrackRec['status'] == "PENDING APPROVAL") { ?>
								<span><small><a href="approve.php?trco=<?php echo $rowTrackRec['trackingcode']; ?>" class="btn btn-warning"> Approve</a></small></span>
								<?php } else{ ?>
									<span><small><a href="updaterec.php?trco=<?php echo $rowTrackRec['trackingcode']; ?>" class="btn btn-success"> Upgrade</a></small></span>
								<span><small><a href="deleterec.php?trco=<?php echo $rowTrackRec['trackingcode']; ?>" class="btn btn-danger" id="#cowner"> Delete</a></small></span>
								<?php } ?>

								</p>

							</h4>
							
							</div>

						<?php  
						} // end whileloop
					?>
				</div>
					<ul class="pagination">
					<?php 
						$query = "SELECT * from pickuprequests where deleteitem = 0 ";
						$result = mysqli_query($connect, $query);
						// Count the total records
						$total_records = mysqli_num_rows($result);

						//Using ceil function to divide the total records on per page
						$total_pages = ceil($total_records / $per_page);

						if ($page<=$total_pages && $total_pages!=1) {
						if ($page != 1) {
							$k = $page-1;
							echo '<li>
									<a aria-label="Previous" href="index.php?shp='.$k.'"><<</a>
								</li>';
						}
						
						for ($i=1; $i<=$total_pages; $i++) {
							if ($i==$page) {
								echo '<li class="active"><span>'.$i.'</span></li>';
							} else{
								echo '<li><a href="index.php?shp='.$i.'">'.$i.'</a></li>';
							}
						
						}

						if ($page != $total_pages) {
							$j = $page+1;
							echo '<li>
									<a aria-label="Next" href="index.php?shp='.$j.'">>></a>
								</li>';
						}
						}
					?>
					</ul>

			</div><!--/.blog-item-->
	


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