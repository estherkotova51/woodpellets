<?php require_once("../includes/layouts/session.php"); ?>
<?php require("../includes/layouts/db_connect.php"); ?>
<?php require_once("../includes/layouts/functions.php") ?>
<?php 
    $query = "SELECT * from notifications where noByDisplay=1 ORDER BY RAND()";
    $run_query = mysqli_query($connect, $query);
    confirm_query($run_query);
    $num_rows = mysqli_num_rows($run_query);

    if ($num_rows > 0) {
        while ($row = mysqli_fetch_array($run_query)) { $prodname=$row['noByProd']; ?>

            <section class="custom-social-proof">
                <div class="custom-notification">

                    <div class="custom-notification-container">
                        <div class="custom-notification-image-wrapper">
                            <?php
                                $query2 = "SELECT * from pillshome where prodname='$prodname' LIMIT 1";
                                $run_query2 = mysqli_query($connect, $query2);
                                confirm_query($run_query2);
                                $row2 = mysqli_fetch_array($run_query2);

                                $proid = $row2['prod_id'];
                            ?>
                        <img src="<?= productimg($row2['photo']) ?>">
                        </div>
                        <div class="custom-notification-content-wrapper">
                            <a href="<?= productlink($proid, $row2['prodname']); ?>">
                                <p class="custom-notification-content">
                                    <b><?php echo $row['noByName'].' - '. $row['noByCity'];?></b><br>Purchased <b><?php echo $row['noByQty']; ?></b> <?php echo $row['noByProd']; ?>  
                                    <small>
                                    <?php 
                                                                      
                                        $date = $row['noByDura']; 
                                        echo nicetime($date);

                                    ?></small>
                                </p>
                            </a>
                        </div>
                    </div>
                    
                    <div class="custom-close"></div>
                </div>
            </section>

<?php   
        }
    }
?>

