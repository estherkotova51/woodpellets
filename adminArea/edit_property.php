<div class="accountItem">
	<?php

		global $connect;
			
				if (isset($_GET['edit_property']) || isset($_GET['page2'])) {
							$email = $_SESSION['c_email'];
								$per_page=5;
								if (isset($_GET["page2"])) {

								$page = $_GET["page2"];

								}

								else {

								$page=1;
								}
								// Page will start from 0 and Multiple by Per Page
								$start_from = ($page-1) * $per_page;
						
						$query3 = "SELECT * FROM prolisting where c_email='{$email}' AND display=1 order by p_id DESC LIMIT $start_from, $per_page";
						$results = mysqli_query($connect, $query3);
						confirm_query($results);

						if (mysqli_num_rows($results) == 0) {
						echo "<h4 style='text-align:center; padding:5px;'>You have NOT yet posted a PROPERTY OR your PROPERTY has expired. Please check on the 'Expired/Deleted' tab to confirm.";
						echo '<h5 style="text-align:center; padding:5px; background-color:#42826c; color:#fff;"> You can use this ' . '<a href="../al_postings.php" style="color:#000;" class="btn btn-default"> to Post a Property</a>' . ' </h5>';

						echo '<h5 style="text-align:center;"> If your objective here is to FIND a dream property, do not hesitate to use our dynamic search tools. </h5> <br />';

						echo '<form method="get" action="../search" class="form-inline" style="text-align:center; padding:5px; background-color:#42826c;">
							<div class="form-group">
						 		<input type="search" name="user_query" placeholder="Search"  id="input_field3"  class="form-control" />
						 	</div>
						 		<button type="submit" class="btn btn-default"/> Search</button>
							
						</form>';

						echo '<h4 style="text-align:center;"> Also, the promotional video below, will give you a visual of how to navigate this application, for a better experience and great results. </h4>';

						echo '<div class="embed-responsive  embed-responsive-4by3" style="margin-right:10px; margin-left:10px; margin-bottom:20px;">
								<h3 style="text-align: center; padding: 10px; border: 1px solid red;"> Sorry our promotional video will be uploaded shortly</h3>


						</div>';
					}
					

						 while ($rowItem = mysqli_fetch_assoc($results)) { ?>

						 	<div class="row" id="eachItem">
						 		<div class="row" style="padding:5px; color:#fff; background-color:#42826c; width:100%; text-align:center;"><span class="glyphicon glyphicon-home"></span> <?php echo ucwords($rowItem['pbuilname']);?></div>
					   				<!-- product picture -->
					   				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12 proheightimage">
					   					<img src="../public/images/img/<?php echo $rowItem['photo']; ?>" class="img-responsive">
					   				</div>
					   				<!-- product details -->
					   				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 proheight">
						   				<a href="myaccountDetails?property=<?php echo $rowItem['p_id'].'&'.$u;?>">
						   					<li id="first"> <?php echo $rowItem['ptype']; ?><span><img  class="img-responsive pull-right hidden-xs" src="public/images/icons/rollover2.png"></span></li>
						   				</a>
					   					<li class="others"><span>Model: </span> <?php echo $rowItem['pmodel']; ?> </li>
					   					<li class="others"><span>Size(s): </span> <?php echo $rowItem['psize']; ?> </li>
					   					<li class="others"><span>Content: </span> <?php echo $rowItem['pcontent']; ?></li>
					   					<li class="others"><span>Town: </span> <?php echo $rowItem['ptown']; ?> </li>
					   					<li class="others"><span>Area: </span> <?php echo $rowItem['parea']; ?> </li>
					   				</div>
					   				<!-- customer acc type -->
						   				<div class="row">
							   				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 proheightviews">
						   						<?php 
							   						if ($rowItem['a_type'] == "EXPERT") {
							   							echo "<li id='firstE'><span>";  echo $rowItem['a_type'] . ' type' . "</span></li>";
							   						}elseif ($rowItem['a_type'] == "SENIOR") {
							   							echo "<li id='firstS'><span>";  echo $rowItem['a_type'] . ' type' . "</span> </li>";
							   						}else{
							   							echo "<li id='firstJ'><span>";  echo $rowItem['a_type'] . ' type' . "</span> </li>";
							   						}

						   						?>
						   					</div>
						   					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 proheightviews">
								   					<li class="othersM"><span class="glyphicon glyphicon-eye-open"></span> <?php echo $rowItem['views']; ?> Views </li>
								   			</div>
							   			</div>
							   			<a href="myaccountDetails?property=<?php echo $rowItem['p_id'].'&'.$u;?>"><li class="othersXSedit visible-xs"> Edit me</li></a>
					   			</div>
					

								<?php } //<!-- End of while loop -->

						//Now select all from table
						$query = "SELECT * from prolisting where c_email='{$email}' AND display=1  AND deletedpro=0";
						$result = mysqli_query($connect, $query);
						// Count the total records
						$total_records = mysqli_num_rows($result);

						//Using ceil function to divide the total records on per page
						$total_pages = ceil($total_records / $per_page);

						//Going to first page
						echo "<div class='col-lg-12 col-md-12 col-sm-12 col-xs-12' style='width:100%; margin-bottom:20px;'> <center>";
						
						
						
						if ($page<=$total_pages) {

							if ($page != 1) {
								echo "<a href='myaccountDetails?page2=1' style='margin-right:10px; color:#3a3a3a;'>".'First Page'."</a>";
							$k = $page-1;
							  echo "<a href='myaccountDetails?page2=".$k."' style='margin-right:10px; color:#3a3a3a;'>".'&laquo Previous '."</a>";
							}
							
							for ($i=1; $i<=$total_pages; $i++) {
								if ($i==$page) {
									echo "<span class='paging_link2'>".$i."</span> ";
								} else{
									echo "<a id='paging_link' href='myaccountDetails?page2=".$i."'>".$i."</a> ";
								}
							
							}

							if ($page != $total_pages) {
								$j = $page+1;
								  echo "<a href='myaccountDetails?page2=".$j."' style='margin-left:10px; color:#3a3a3a;'>".'Next &raquo'."</a> ";
								  echo "<a href='myaccountDetails?page2=$total_pages' style='margin-left:10px; color:#3a3a3a;'>".'Last Page'."</a> ";
								}	
						
							
						}
						
						// Going to last page
						
						echo "</center> </div>";
				
					} // End of if condition  -->


	?>

</div>