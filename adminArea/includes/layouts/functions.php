<?php

function dirlocal(){
	// active on localhost
	$dirlocal=getcwd();
	$dirlocalseen =	explode("\\", $dirlocal);

	echo '/'.$dirlocalseen[3].'/adminArea/';

	// active on live server

	// echo "/";
}

function dirlocal2(){
	// active on localhost
	$dirlocal=getcwd();
	$dirlocalseen =	explode("\\", $dirlocal);

	return '/'.$dirlocalseen[3].'/adminArea/';

	// active on live server

	// return "/";
}

function redirect_to($new_location){
		header("Location: " . $new_location);
		exit;
	}

// Sanitize functions
// Make sanitizing easy and you will do it often

// Sanitize for HTML output 
function h($string) {
	return htmlspecialchars($string);
}

// Sanitize for JavaScript output
function j($string) {
	return json_encode($string);
}

// Sanitize for use in a URL
function u($string) {
	return urlencode($string);
}

// Getting the user IP address
function getIp() {
    $ip = $_SERVER['REMOTE_ADDR'];
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
 
    return $ip;
}

//  This file contains basic functions.
function confirm_query($result_set){
	if (!$result_set) {
		die("connection failed");
	}
}

function escapeString($string){
	global $connect;

	$escaped_string = mysqli_real_escape_string($connect, $string);
	return $escaped_string;
}

// Listing Countries
function Allcountries(){
	global $connect;

	$queryCountry = "SELECT * FROM country ORDER BY countryId ASC";
	$run_queryCountry = mysqli_query($connect, $queryCountry);

	while ($rowCountry = mysqli_fetch_array($run_queryCountry)) {
		
		echo '<option value="'.$rowCountry['countryname'].'">'.$rowCountry['countryname'].'</option>';

	}
}

// Get Company Details
function companyD($details){
	global $connect;

	$queryCompany = "SELECT * FROM companyd";
	$run_queryCompany = mysqli_query($connect, $queryCompany);
	confirm_query($run_queryCompany);

	$rowCompany = mysqli_fetch_array($run_queryCompany);
		
	$rowCompanyseen = $rowCompany["$details"];

	return $rowCompanyseen;

}

// creating the shopping cart
function cart(){
	global $connect;
	if (isset($_GET['add_cart'])) {
		$ip = getIp();

		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where ip_add='$ip' AND p_id='$pro_id'";
		$run_check = mysqli_query($connect, $check_pro);
		if (mysqli_num_rows($run_check)>0) {
			echo " Sorry!!! the Pet you selected already exist in your Cart." . "</br>" . "<a href='index.php' style='background-color:#9000ff; line-height:100px; color:#fff;'>Please go back and add another Pet. Thanks </a>";
		} else{
			$insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id', '$ip')";
			$run_pro = mysqli_query($connect, $insert_pro);
			echo "<script> window.open('index.php','_self')</script>";
		}
	}
}
// Total item in the cart
function total_items() {
	if (isset($_GET['add_cart'])) {
		global $connect;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($connect, $get_items);
		$count_items = mysqli_num_rows($run_items);
	} else {
		global $connect;
		$ip = getIp();
		$get_items = "select * from cart where ip_add='$ip'";
		$run_items = mysqli_query($connect, $get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	echo $count_items;
}

// Getting the total price
function total_price(){
	$total = 0;
	global $connect;
	$ip = getIp();
	$sel_price = "select * from cart where ip_add='$ip'";
	$run_price = mysqli_query($connect, $sel_price);
	while ($p_price = mysqli_fetch_array($run_price)) {
		$pro_id = $p_price['p_id'];
		$pro_price = "select * from pets_entry2 where id='$pro_id'";
		$run_pro_price = mysqli_query($connect, $pro_price);
		while ($pp_price = mysqli_fetch_array($run_pro_price)) {
			$pets_price = array($pp_price['price']);
			$values = array_sum($pets_price);
			$total += $values;
		}
	}
	echo "$ ". $total;
}



function password_encrypt($password){
		$hash_format = "$2y$10$"; // Tells PHP to use Blowfish with a "cost" of 10.
		$salt_length = 22; // Blowfish salts should be 22-characters or more.
		$salt = generate_salt($salt_length);
		$format_and_salt = $hash_format . $salt;
		$hash = crypt($password, $format_and_salt);
		return $hash;
	}

function generate_salt($length){
	// Not 100% unique, not 100% random, but good enough for a salt
	// MD5 returns 32 characters
	$unique_random_string = md5(uniqid(mt_rand(), true));

	// Valid characters for a salt are [a-zA-Z0-9./]
	$base64_string = base64_encode($unique_random_string);

	// But not '+' which is valid in base64 encoding
	$modified_base4_string = str_replace('+', '.' , $base64_string);

	// Truncate string to the correct length
	$salt = substr($modified_base4_string, 0, $length);

	return $salt;
}

function password_check($c_pass, $existing_hash){
	// existing hash contains format and salt at start
	$hash = crypt($c_pass, $existing_hash);
	if ($hash === $existing_hash) {
		return true;
	} else{
		return false;
	}
}

	function find_all_customers() {
		global $connect;

		$query =" SELECT * FROM ";
		$query .= " c_reg ";
		$query .= " ORDER BY c_name ASC ";
		$customer_set = mysqli_query($connect, $query); 
		confirm_query($customer_set);
		return $customer_set;
	}

	function find_customer_by_id($customer_id){
		global $connect;
		global $id;

		$safe_customer_id = mysqli_real_escape_string($connect, $customer_id);

		$query  = "SELECT * FROM ";
		$query .= "c_reg ";
		$query .= "WHERE id = {$safe_customer_id} ";
		$query .= "LIMIT 1";
		$customer_set = mysqli_query($connect, $query); 
		confirm_query($customer_set);
		if($customer = mysqli_fetch_assoc($customer_set)){
			return $customer;
		}else{
			return null;
		}
	}

	function find_customer_by_email($s_email){
		global $connect;

		$safe_c_email = mysqli_real_escape_string($connect, $s_email);

		$query  = "SELECT * FROM ";
		$query .= "c_reg ";
		$query .= "WHERE c_email = '{$safe_c_email}' ";
		$query .= "LIMIT 1";
		$customer_set = mysqli_query($connect, $query); 
		confirm_query($customer_set);
		if($customer = mysqli_fetch_assoc($customer_set)){
			return $customer;
		}else{
			return null;
		}
	}

	function attempt_login($s_email, $s_pass){
		$customer = find_customer_by_email($s_email);
		if ($customer) {
			// Found customer, now check password
			if (password_check($s_pass, $customer["c_pwd"])) {
				return $customer;
			} else {
				// Password does not match
				return false;
			}
		} else {
			// customer not found
			return false;
		}
	}

function find_staff_by_name($s_name){
	global $connect;

	$safe_s_name = mysqli_real_escape_string($connect, $s_name);

	$query  = "SELECT * FROM ";
	$query .= "adminlog ";
	$query .= "WHERE adm_name = '{$safe_s_name}' ";
	$query .= " LIMIT 1";
	$staff_set = mysqli_query($connect, $query); 
	confirm_query($staff_set);
	if($staff = mysqli_fetch_assoc($staff_set)){
		return $staff;
	}else{
		return null;
	}
}
function attempt_login_staff($s_name, $s_pass){
		$staff = find_staff_by_name($s_name);
		if ($staff) {
			// Found customer, now check password
			if (password_check($s_pass, $staff["adm_pwd"])) {
				return $staff;
			} else {
				// Password does not match
				return false;
			}
		} else {
			// customer not found
			return false;
		}
}
	
	function logged_in(){
		return isset($_SESSION["c_email"]);
	}
	function confirm_logged_in(){
		if (!logged_in()) {
			echo "<script>alert('Sorry! You have to Log In to gain access.')</script>";
			$_SESSION['message'] = "Sorry! You have to Log In to gain access.";
			echo "<script>window.open('login.php', '_self')</script>";
			//redirect_to("customer_login.php");
		}
	}

function staff_logged_in(){
	return isset($_SESSION["username"]);
}

function confirm_staff_logged_in(){
	if (!staff_logged_in()) {
		echo "<script>alert('Sorry! You have to Log In to gain access.')</script>";
		echo "<script>window.open('../index.php', '_self')</script>";
		//redirect_to("customer_login.php");
	}
}

// categories on mobile
function select_region_catM(){
		global $connect;
			  	$query2 = "SELECT pregion, COUNT(pregion)";
			 	$query2 .= "AS NumOccurrences ";
				$query2 .= " FROM prolisting where display='1' ";
				$query2 .= " GROUP BY pregion ";
				$query2 .= " HAVING count(pregion) >= 1";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			 while ($row_cat = mysqli_fetch_assoc($result)) {
			  $u = md5(uniqid(mt_rand(), true));
				$regist_item = array();
			foreach ($row_cat as $regist_item) {
			$item = $regist_item;
			} 
		
				echo '<a href="<?php dirlocal2()?>Categories?region_cat='.u($row_cat["pregion"]) . '&'. $u .'">' .  "<li class='list_search_aside_cat_rM'>" .  ucfirst($row_cat["pregion"]) . " " . " ($item)" . "</li></a>";
			
			
			 } 
}
function select_type_catM(){
		global $connect;

			  	$query2 = "SELECT p_name from ptype";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			 while ($row_type = mysqli_fetch_assoc($result)) {
			 	$u = md5(uniqid(mt_rand(), true));

			echo '<a href="<?php dirlocal2()?>Categories?ptype_cat='.u($row_type["p_name"]) . '&'. $u .'">';
			
				echo "<li class='list_search_aside_cat_tM'>"  .  ucfirst($row_type["p_name"]) . "</li></a>";
			
			
			 } 
}
function select_model_catM(){
		global $connect;

			  	$query2 = "SELECT p_model_name from p_model";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			 while ($row_model = mysqli_fetch_assoc($result)) {
			 	$u = md5(uniqid(mt_rand(), true));

			echo '<a href="<?php dirlocal2()?>Categories?pmodel_cat='. u($row_model["p_model_name"]) . '&'. $u .'">';
			
				echo "<li class='list_search_aside_cat_mM'>"  .  ucfirst($row_model["p_model_name"]) . "</li></a>";
			
			
			 } 
}

function select_transportation_catM(){
		global $connect;

			  	$query2 = "SELECT tr_name from transportation";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			 while ($row_tr = mysqli_fetch_assoc($result)) {
			 	$u = md5(uniqid(mt_rand(), true));

			echo '<a href="<?php dirlocal2()?>Categories?trans_cat='.u($row_tr["tr_name"]) . '&'. $u .'">';
			
				echo "<li class='list_search_aside_cat_TM'>"  .  ucfirst($row_tr["tr_name"]) . "</li></a>";
			
			
			 } 
}
// End categories on mobile


// Set timezone
  date_default_timezone_set("UTC");
 
  // Time format is UNIX timestamp or
  // PHP strtotime compatible strings
  function dateDiff($time1, $time2, $precision = 6) {
    // If not numeric then convert texts to unix timestamps
    if (!is_int($time1)) {
      $time1 = strtotime($time1);
    }
    if (!is_int($time2)) {
      $time2 = strtotime($time2);
    }
 
    // If time1 is bigger than time2
    // Then swap time1 and time2
    if ($time1 > $time2) {
      $ttime = $time1;
      $time1 = $time2;
      $time2 = $ttime;
    }
 
    // Set up intervals and diffs arrays
    $intervals = array('year','month','day','hour','minute','second');
    $diffs = array();
 
    // Loop thru all intervals
    foreach ($intervals as $interval) {
      // Create temp time from time1 and interval
      $ttime = strtotime('+1 ' . $interval, $time1);
      // Set initial values
      $add = 1;
      $looped = 0;
      // Loop until temp time is smaller than time2
      while ($time2 >= $ttime) {
        // Create new temp time from time1 and interval
        $add++;
        $ttime = strtotime("+" . $add . " " . $interval, $time1);
        $looped++;
      }
 
      $time1 = strtotime("+" . $looped . " " . $interval, $time1);
      $diffs[$interval] = $looped;
    }
    
    $count = 0;
    $times = array();
    // Loop thru all diffs
    foreach ($diffs as $interval => $value) {
      // Break if we have needed precission
      if ($count >= $precision) {
        break;
      }
      // Add value and interval 
      // if value is bigger than 0
      if ($value > 0) {
        // Add s if value is not 1
        if ($value != 1) {
          $interval .= "s";
        }
        // Add value and interval to times array
        $times[] = $value . " " . $interval;
        $count++;
      }
    }
 
    // Return string with times
    return implode(", ", $times);
  }



// categories on mobile
function select_categories(){
		global $connect;
			  	$query2 = "SELECT category, COUNT(category)";
			 	$query2 .= "AS NumOccurrences ";
				$query2 .= " FROM pillshome where display='1' ";
				$query2 .= " GROUP BY category ";
				$query2 .= " HAVING count(category) >= 1";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			 while ($row_cat = mysqli_fetch_assoc($result)) {
			  $u = md5(uniqid(mt_rand(), true));
				$regist_item = array();
			foreach ($row_cat as $regist_item) {
			$item = $regist_item;
			} 
		
				echo '<li class="single-menu colmd4"><a href="<?php dirlocal2()?>shop-left-sidebar.php?category='.strtolower(u($row_cat["category"])) . '&'. $u .'">' .  ucfirst($row_cat["category"]) . " " . " ($item)" . "</a></li>";
			
			
			 } 
}

// categories on mobile
function select_categoriesnav(){
		global $connect;
			  	$query2 = "SELECT category, COUNT(category)";
			 	$query2 .= "AS NumOccurrences ";
				$query2 .= " FROM pillshome where display='1' ";
				$query2 .= " GROUP BY category ";
				$query2 .= " HAVING count(category) >= 1";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);

			while ($row_cat = mysqli_fetch_assoc($result)) {
					  $u = md5(uniqid(mt_rand(), true));
					  
						$regist_item = array();
					foreach ($row_cat as $regist_item) {
						$item = $regist_item;
					} 
						echo '<span>';
						echo '<a href="<?php dirlocal2()?>shopcategory.php?category='.strtolower(u($row_cat["category"])) . '&'. $u .'">' .  ucfirst($row_cat["category"]) . " " . " ($item)" . "</a>";

						$cat_type = $row_cat["category"];
				echo '</span>';
			} 
			
}

function select_categoriesnavmobile(){
		global $connect;
			  	$query2 = "SELECT category, COUNT(category)";
			 	$query2 .= "AS NumOccurrences ";
				$query2 .= " FROM pillshome where display='1' ";
				$query2 .= " GROUP BY category ";
				$query2 .= " HAVING count(category) >= 1";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			while ($row_cat = mysqli_fetch_assoc($result)) {
					  $u = md5(uniqid(mt_rand(), true));
					  
						$regist_item = array();
					foreach ($row_cat as $regist_item) {
						$item = $regist_item;
					} 
						// echo '<div class="column-1 column"><ul>';
						echo '<li class="cat-item"><a href="<?php dirlocal2()?>shopcategory.php?category='.strtolower(u($row_cat["category"])) . '&'. $u .'">' .  ucfirst($row_cat["category"]) . " " . " ($item)" . "</a></li>";

						$cat_type = $row_cat["category"];

					
			} 
}

function select_categoriesbestseller(){
		global $connect;
			  	$query2 = "SELECT * FROM pillshome where display='1' order by RAND() limit 4";

				$result = mysqli_query($connect, $query2); 
				
				confirm_query($result);
			
			while ($row_cat = mysqli_fetch_assoc($result)) {
					$u = md5(uniqid(mt_rand(), true));

					echo '<li class="b-none">
                            <div class="tb-recent-thumbb">
                                <a href="<?php dirlocal2()?>">
                                    <img class="attachment" src="<?php dirlocal2()?>img/product/'.$row_cat["photo"].'" alt="Best seller">
                                </a>
                            </div>
                            <div class="tb-recentb">
                                <div class="tb-beg">
                                    <a href="<?php dirlocal2()?>#.">'.ucfirst($row_cat["prodname"]).'</a>
                                </div>
                                <div class="tb-product-price font-noraure-3">
                                    <span class="amount">$ '.ucfirst($row_cat["new_price"]).'</span>
                                </div>
                            </div>
                        </li>';
			} 
}

?>








