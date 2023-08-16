<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php"); ?>
<?php //confirm_logged_in(); ?>
<?php

$u = md5(uniqid(mt_rand(), true));

if (isset($_POST['submit'])) {
	

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
				}else{
				    // Create a blank image and add some text
                    $im = imagecreatetruecolor(120, 120);
                    $text_color = imagecolorallocate($im, 255, 255, 255);
                    // Fill background with above selected color 
                    imagefill($im, 0, 0, $text_color);
                    
                    imagestring($im, 1, 5, 5,  '-', $text_color);
                    
                    // Save the image
                    imagewebp($im, '../extrabox/img/product/sample.webp');
                    
                    $new_name[$i] = "sample.webp";
                    
                    // Free up memory
                    imagedestroy($im);
                    
					
				}

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
			}
	

		// Collecting checked values from the form, and converting them from array to string using implode
		// while checking empty arrays and converting them into empty strings in other to avoid errors.
   }
   		$categories = $_POST['categories'];
   		$subcategories = $_POST['subcategories'];
		$productname = escapeString($_POST['productname']);
		$oldprice = escapeString($_POST['oldprice']);
		$newprice = escapeString($_POST['newprice']);
		$description = escapeString($_POST['description']);
		$sideeffects = escapeString($_POST['sideeffects']);
		$purpose = escapeString($_POST['purpose']);
		$display =  escapeString($_POST['display']);

		// // Checking submitted photos and passing through an empty string checker in other to avoid errors.
		for ($i=0; $i <=4 ; $i++) { 
			if (isset($new_name[$i])) {
			  	$new_name_pro[$i];
				} else{
				     // Create a blank image and add some text
                    $im = imagecreatetruecolor(120, 120);
                    $text_color = imagecolorallocate($im, 255, 255, 255);
                    // Fill background with above selected color 
                    imagefill($im, 0, 0, $text_color);
                    
                    imagestring($im, 1, 5, 5,  '-', $text_color);
                    
                    // Save the image
                    imagewebp($im, '../extrabox/img/product/sample.webp');
                    
                    $new_name_pro[$i] = "sample.webp";
                    
                    // Free up memory
                    imagedestroy($im);
				
			}
		}


		$search_string = $categories." ". $productname ." ".$description." ".$sideeffects." ".$purpose;

		$query  = " INSERT INTO pillshome ( ";
		$query .= " category, subcategory, prodname, old_price, new_price, description, sideeffects, purpose, display, ptime, photo, photo2, photo3, photo4, searchString ";
		$query .= " ) VALUES ( ";
		$query .= " '{$categories}', '{$subcategories}', '{$productname}', '{$oldprice}', '{$newprice}', '{$description}', '{$sideeffects}', '{$purpose}',  '{$display}', NOW(), '{$new_name_pro[0]}', '{$new_name_pro[1]}', '{$new_name_pro[2]}', '{$new_name_pro[3]}', '{$search_string}' ";
		$query .= " ) ";

		$result = mysqli_query($connect, $query);
		confirm_query($result);

		if ($result) {
		

			$query2 = "SELECT * from pillshome where photo='$new_name_pro[0]'";
			$result2 = mysqli_query($connect, $query2);
		    confirm_query($query2);
		    $rowItem = mysqli_fetch_assoc($result2);

		    $p_id = $rowItem['prod_id'];
		    $quantity = $_POST['quantity'];
		    $vprice = $_POST['vprice'];

		    for ($i=0; $i < count($quantity) ; $i++) { 
		    	$quantity[$i];
		    	$vprice[$i];
		    	if ($quantity[$i] == "") {
		    		
		    	}else{
		    		$query2  = "INSERT INTO productvar (productId, quantity, price) VALUES ('$p_id', '$quantity[$i]', '$vprice[$i]') ";

			    	$result2 = mysqli_query($connect, $query2);
					confirm_query($result2);
		    	}
		    }

			//success
			$_SESSION["message"] ="Your entry was successful";

			if ($result) {
				mysqli_free_result($result);
			}

			
		   	redirect_to("index.php");
		}else{
			// failure
			$message = "Entry creation failed, please check that all fields are correct before you submit.";
		}
} else{
	// This is probably a GET request
	redirect_to("index.php");
}
		
?>

	<?php 
		// 4. Release returned data
		
	
	?>
<?php //include("includes/layouts/footer.php"); ?>







<?php // $ngh = str_pad(mt_rand(0, 9999999999), 10, '0', STR_PAD_LEFT); ?>

<?php //$ngh2 = substr(number_format(time() * rand(),0,'',''),0,10); echo $ngh2?>