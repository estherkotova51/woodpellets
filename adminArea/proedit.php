<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php"); ?>
<?php //include("includes/layouts/header.php"); ?>
<?php //confirm_logged_in(); ?>
<?php

	$u = md5(uniqid(mt_rand(), true));

	if (isset($_POST['submitedit'])) {
		

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
					$new_name[$i] = preg_replace('#[^a-z.0-9]#i', '', $new_name[$i]); // filter
    				$name_ext = explode(".", $new_name[$i]); // Split file name into an array using the dot
    				$new_name_Ext = end($name_ext); // Now target the last array element to get the file extension
    				
    				
    
    				move_uploaded_file($tmp_name_array[$i], "../extrabox/img/product/".$new_name[$i]);
    				
    				// list($w_orig, $h_orig) = getimagesize("../extrabox/img/product/".$new_name[$i]);
    				
    				// echo $new_name_Ext." - ". $w_orig .", ". $h_orig."<br/>";
    
    				// Include the file that houses all of our custom image functions
    				include_once("includes/layouts/imageprocessor.php");
    				// ---------- Start Universal Image Resizing Function --------
    				$target_new_name = "../extrabox/img/product/".$new_name[$i];
    				$resized_new_name = "../extrabox/img/product/resized_".$new_name[$i];
    				$wmax = 800;
    				$hmax = 800;
    				ak_img_resize($target_new_name, $resized_new_name, $wmax, $hmax, $new_name_Ext);
    
    
    				$target_new_name = "../extrabox/img/product/resized_".$new_name[$i];
    				$thumbnail = "../extrabox/img/product/thumb_".$new_name[$i];
    				$wthumb = 800;
    				$hthumb = 800;
    				ak_img_thumb($target_new_name, $thumbnail, $wthumb, $hthumb, $new_name_Ext);
    				// ----------- End Universal Image Resizing Function ----------
    
    				// ---------- Start Convert to WEBP Function --------
    				if (strtolower($new_name_Ext) != "webp") {
    				    $target_new_name = "../extrabox/img/product/thumb_".$new_name[$i];
    				    $new_webp = "../extrabox/img/product/cov_".$name_ext[0].".webp";
    				    ak_img_convert_to_jpg($target_new_name, $new_webp, $new_name_Ext);
    				}else{
    				    $target_new_name = "../extrabox/img/product/thumb_".$new_name[$i];
    				    $new_webp = "../extrabox/img/product/cov_".$name_ext[0].".webp";
    				    ak_img_convert_to_jpg($target_new_name, $new_webp, $new_name_Ext);
    				}
    				// ----------- End Convert to JPG Function -----------
    				// ---------- Start Image Watermark Function --------
    				$target_new_name = "../extrabox/img/product/cov_".$name_ext[0].".webp";
    				$wtrmrk_file = "watermark.png";
    				$new_name_pro[$i] = "protected_".$name_ext[0].".webp";
    				$new_file = "../extrabox/img/product/protected_".$name_ext[0].".webp";
    				ak_img_watermark($target_new_name, $wtrmrk_file, $new_file);
    				// ----------- End Image Watermark Function -----------
    
    				// ---------- Start Image Watermark2 Function --------
    				$target_new_name = "../extrabox/img/product/cov_".$name_ext[0].".webp";
    				$wtrmrk_file = "watermark.png";
    				$new_name_pro2[$i] = "protected_".$name_ext[0].".webp";
    				$new_file = "../extrabox/img/product/product2/protected_".$name_ext[0].".webp";
    				ak_img_watermark2($target_new_name, $wtrmrk_file, $new_file);
    			    // ----------- End Image Watermark2 Function -----------
				}else{
				    
                    $new_name[$i] = "";
					
				}

			}

			// Collecting checked values from the form, and converting them from array to string using implode
			// while checking empty arrays and converting them into empty strings in other to avoid errors.
	    }
	   		$categories = $_POST['categories'];
			$productname = escapeString($_POST['productname']);
			$productid = escapeString($_POST['productid']);
			$oldprice = escapeString($_POST['oldprice']);
			$newprice = escapeString($_POST['newprice']);
			$description = escapeString($_POST['description']);
			$sideeffects = escapeString($_POST['sideeffects']);
			$purpose = escapeString($_POST['purpose']);

			// Checking submitted photos and passing through an empty string checker in other to avoid errors.
			$querypill = "SELECT * from pillshome where prod_id=$productid limit 1";
			$resultpill = mysqli_query($connect, $querypill);
			confirm_query($resultpill);

			$rowItem = mysqli_fetch_assoc($resultpill);

			if (isset($new_name[0]) && !empty($new_name[0])) {
			  	$new_name_pro[0];
				} else{
				$new_name_pro[0]  = $rowItem['photo'];
			}
			if (isset($new_name[1]) && !empty($new_name[1])) {
			  	$new_name_pro[1];
				} else{
				$new_name_pro[1]  = $rowItem['photo2'];
			}
			if (isset($new_name[2]) && !empty($new_name[2])) {
			  	$new_name_pro[2];
				} else{
				$new_name_pro[2]  = $rowItem['photo3'];
			}
			if (isset($new_name[3]) && !empty($new_name[3])) {
			  	$new_name_pro[3];
				} else{
				$new_name_pro[3]  = $rowItem['photo4'];
			}

			
			$query  = "UPDATE pillshome SET category='$categories', prodname='$productname', old_price='$oldprice', new_price='$newprice', description='$description', sideeffects='$sideeffects', purpose='$purpose', photo='$new_name_pro[0]', photo2='$new_name_pro[1]', photo3='$new_name_pro[2]', photo4='$new_name_pro[3]'  WHERE prod_id='$productid' ";

			$result = mysqli_query($connect, $query);
			confirm_query($result);

			//success
			$_SESSION["message"] ="Your product was successfully Edited.";

			if ($result) {
				mysqli_free_result($result);
			}

			
		   	redirect_to("index.php");

			
			
		} else{
			// This is probably a GET request
			echo "<script>window.open('index.php', '_self' )</script>";
	}
		
?>

	<?php 
// 4. Release returned data
	if ($result) {
		mysqli_free_result($result);
	}
	
	?>
