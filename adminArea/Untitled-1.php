<?php 
$query="SELECT *FROM blog WHERE display=1 ORDER BY RAND() LIMIT 3";
$run_query =mysqli_query($connect,$query);
confirm_query($run_query);

while($blogall= mysqli_fetch_assoc($run_query)){
    ?>
    <?php
}// ?>