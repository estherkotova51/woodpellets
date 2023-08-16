<?php require_once('navigationadmin.php');?>
<?php confirm_staff_logged_in(); ?>
<?php 
    if (isset($_GET['trco'])) {
        $trackcode = $_GET['trco'];

        $query = "SELECT * from pickuprequests WHERE trackingcode = '{$trackcode}' Limit 1";
        $run_query = mysqli_query($connect, $query);
        confirm_query($run_query);
        $row = mysqli_fetch_assoc($run_query);

        //$newdel = $row['pickLoc'];
        $newdel = escapeString($row['pickLoc']);
        $status = "ACTIVE";


        $subIte = "UPDATE pickuprequests SET currentLocation='$newdel', status='{$status}', activationDate='' WHERE trackingcode='{$trackcode}' LIMIT 1 ";

        $run_subIte = mysqli_query($connect, $subIte);

        confirm_query($run_subIte);

    
        $_SESSION['message'] = 'Package Updated.';

       echo "<script>window.open('index.php?Home', '_self')</script>";

    }


   ?>