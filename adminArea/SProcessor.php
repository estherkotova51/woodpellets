<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php"); ?>


<?php
	if (isset($_POST["categ"]) && !empty(isset($_POST["categ"]))) {
     	$categ = $_POST["categ"];
		$query2 = "SELECT * FROM categories where categ = '$categ' ";
		$run_query = mysqli_query($connect, $query2);
		confirm_query($run_query);
		$num_rows = mysqli_num_rows($run_query);
      
		if ($num_rows > 0) {
			$row = mysqli_fetch_array($run_query);
			$categseen = $row['catid'];
			
			$query = "SELECT * FROM subcategories where catId = '$categseen' ORDER BY catId asc";
			$run_query = mysqli_query($connect, $query);
			confirm_query($run_query);
			$num_rows = mysqli_num_rows($run_query);

			if ($num_rows > 0) {
				echo'<option value="">Select a Sub-category</option>';
				while ($row = mysqli_fetch_array($run_query)) {
					echo'<option value="'.$row['subcategory'].'">'.$row['subcategory'].'</option>';
				}
			}else{
				echo'<option value="">Subcategory not available</option>';
			}
		}
	}
?>
	