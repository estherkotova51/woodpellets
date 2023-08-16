<?php require_once('navigationadmin.php'); ?>
<?php confirm_staff_logged_in(); ?>
<?php 
    if (isset($_GET['trco'])) {
        $trackcode = $_GET['trco'];

        $query = "SELECT * from pickuprequests WHERE trackingcode = '{$trackcode}' Limit 1";
        $run_query = mysqli_query($connect, $query);
        confirm_query($run_query);
        $rowUpg = mysqli_fetch_assoc($run_query);
    }
?>
<?php
    if (isset($_POST['subUpg'])) {
        
        $id =  escapeString($_POST['id']);
        $tracking_number = escapeString($_POST['tracking_number']);
        $current_location = escapeString($_POST['Current_loc']);
        $status = escapeString($_POST['status']);
        $status_reason = escapeString($_POST['status_reason']);
        $pickdate = escapeString($_POST['pickdate']);

        $subIte = "UPDATE pickuprequests SET currentLocation='$current_location', status='$status' WHERE trackingcode='$tracking_number' LIMIT 1";
        $run_subIte = mysqli_query($connect, $subIte);
        confirm_query($run_subIte);

        $query1 = "INSERT INTO history (shipinfo_id, tracking_number, current_location, status, status_reason, timer) VALUES ('$id', '$tracking_number', '$current_location', '$status', '$status_reason', '$pickdate' )";
            $result1 = mysqli_query($connect, $query1);
            confirm_query($result1);

        $_SESSION['message'] = 'Package Updated.';

       echo "<script>window.open('index.php?Home', '_self')</script>";
    }
?>



    <section id="blog" class="container">
        <div class="row">
            <div class="col-sm-3">&nbsp;</div>
            <div class="col-sm-6">
                <div class="blog">
                    <div class="blog-item">
                        <div  style="background-color:#31496a; color: #fff; text-align: center; padding:5px;">
                             <h3>UPGRADE PACKAGE</h3>
                        </div> 
                        <div class="blog-content">
                            

                            <form  action="#" method="POST">
                                
                                   <h4 style="text-align: center;">Locations</h4>
                                    <div class="form-group" style="text-align: left;">
                                        <input type="hidden" name="id" placeholder="Shipment ID" class="form-control" value="<?php echo escapeString($rowUpg['id']);?>" />
                                        <input type="hidden" name="tracking_number" placeholder="Tracking Number" class="form-control" value="<?php echo escapeString($rowUpg['trackingcode']);?>" />

                                        <label for="Current_loc" >Current Location:</label>
                                        <p data-toggle="tooltip" data-placement="top" title="Please enter Current Location">
                                            <input style="width:100%;" class="form-control" type="text" id="Current_loc" name="Current_loc" placeholder="Package Current Location" value="<?php echo escapeString($rowUpg['currentLocation']);?>"  required/>
                                        </p>
                                        <label for="Current_loc" >Current Date and time:</label>
                                            <p data-toggle="tooltip" data-placement="top" title="Please enter Current Date and time">
				                                <input class="form-control" type="text" id="datetimepicker" name="pickdate"  placeholder="Pickup Current Date and time:"  required/>
				                        </p>
                                    </div>
                                    <div class="form-group" style="text-align: left;">
                                        <select name="status" class="form-control">
                                            <option value="<?php echo escapeString($rowUpg['status']);?>"><?php echo escapeString($rowUpg['status']);?></option>
                                            <option value="ACTIVE"> ACTIVE</option>
                                            <option value="ON HOLD"> ON HOLD</option>
                                            <option value="PENDING INSURANCE"> PENDING INSURANCE</option>
                                            <option value="DELIVERED"> DELIVERED </option>
                                            <option value="DIPLOMATIC SEAL"> DIPLOMATIC SEAL</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Reason for Status</label>
                                        <textarea class="form-control" rows="3" name="status_reason" required><?php echo escapeString($rowUpg['description']);?></textarea>
                                    </div>

                                  <input style="width:100%; background-color:green; color: #fff;" class="btn btn-default" type="submit" name="subUpg" value="UPGRADE" />
                            </form>
                            <hr/>


                        </div>
                    </div><!--/.blog-item-->
                </div>
            </div><!--/.col-md-8-->
        </div><!--/.row-->
    </section><!--/#blog-->

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
        <!--<script src="js/jquery.js"></script>-->
        <script src="../js/jquery-2.1.4.min.js"></script>
        <script src="js/datetimepicker-master/jquery.js"></script>
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
        <script src="js/datetimepicker-master/jquery.js"></script>
        
        <script src="js/datetimepicker-master/build/jquery.datetimepicker.full.min.js"></script>
		
        <!--<script src="assets/js/jquery-ui.js"></script>-->
        <script>
            // jQuery('#datetimepicker').datetimepicker();
            
            $(function () {
                $("#datetimepicker").datetimepicker();
            });
            $(function () {
                $("#datetimepicker2").datetimepicker();
            });
            $(document).ready(function () {
                const stepper = new Stepper($('.bs-stepper')[0])
                $(".next").click(function (e) {
                    e.preventDefault();
                    stepper.next();
                });
                $(".previous").click(function (e) {
                    e.preventDefault();
                    stepper.previous();
                });
            })
        </script>

    </body>
</html>

  