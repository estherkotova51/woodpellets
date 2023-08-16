<?php
function redirect_to($new_location){
	header("Location: " . $new_location);
	exit;
}

// Set timezone
date_default_timezone_set("UTC");

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
	$entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
    return str_replace($entities, $replacements, urlencode($string));
}

//  Checking if a query is correct.
function confirm_query($result_set){
	if (!$result_set) {
		die("connection failed");
	}
}
// Variable string generator
function mt_rand_str ($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') {
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
}
// Remove unwanted typo(characters) coming from a form field: {Previous function was escapeString}
function escapeString($string){
	global $connect;

	$escaped_string = mysqli_real_escape_string($connect, $string);
	return $escaped_string;
}
function alertbutton($messagetoshow){
	$alertcode = '<div class="alert fade show product-filter-badge" role="alert"><span>'.$messagetoshow.'</span>
						<button class="close" type="button" data-bs-dismiss="alert" aria-label="Close">
						<svg class="svg-fill" width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="https://www.w3.org/2000/svg">
							<path fill-rule="evenodd" clip-rule="evenodd" d="M4.63962 5.5L0 10.1396L0.860376 11L5.5 6.36038L10.1396 11L11 10.1396L6.36038 5.5L11 0.860374L10.1396 -9.53674e-07L5.5 4.63962L0.860376 -9.53674e-07L0 0.860374L4.63962 5.5Z"></path>
						</svg>
						</button>
					</div>';
	return $alertcode;
}
// ========== LOGIN PROCEDURES=======

function password_check($c_pass, $existing_hash){
	// existing hash contains format and salt at start
	$hash = crypt($c_pass, $existing_hash);
	if ($hash === $existing_hash) {
		return true;
	} else{
		return false;
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
	
function logged_in(){
	if(isset($_SESSION["c_email"])){
		return $_SESSION["c_email"];	
	}else{
		return "Guest";
	}
	
}

function confirm_logged_in(){
	if (logged_in()=="Guest") {
		echo "<script>alert('Sorry! You have to Log In to gain access.')</script>";
		$_SESSION['message'] = "Sorry! You have to Log In to gain access.";
		echo "<script>window.open('login.php', '_self')</script>";
	}
}

// ========== END LOGIN PROCEDURES=======

//======= HOMEPAGE DYNAMIC TAG TEXT
function tagstext($notb) {

	if (isset($_GET['tb'])) { 
		// GET text from URL yourdomain/tb/tagstext
		$tagtext = $_GET['tb'];

		return ucwords(catfix($tagtext));
	}else{
		return ucwords(catfix($notb));
	}
}

//======= HOMEPAGE DYNAMIC URL TEXT AND LINK
function linkseo($smp) {
    $link = "<a href='/tb/".preg_replace('#[^a-z.0-9]#i', '-', strtolower(u($smp)))." 'title='".$smp."'".">".ucwords($smp)."</a>";
    
    return $link;
}


//========SEMANTIC URLs FIXES
function linkfix($str) {
	$fix = preg_replace('#[^a-z.0-9]#i', '-', strtolower(u($str)));
	return $fix;
}

function catfix($str) {
	$fix = preg_replace('#[^a-z.0-9]#i', ' ', strtolower(u($str)));
	return $fix;
}
//===== CATEGORIES AND SUBCATEGORIES DETAIL LINKS
function categorylink($categname, $prodId) {

	$categ = str_split($categname, 30);
	$categn = $categ[0]; 
	$linkpro = linkfix($categn)."/".linkfix($prodId);
	
    $linkproduct = "/categories/$linkpro";
    
	return $linkproduct;
}
//===== PRODUCT DETAIL LINKS
function productlink($proid, $prodname) {

	$sprod = str_split($prodname, 30);
	$sprodn = $sprod[0]; 
	$linkpro = $proid."/".linkfix($sprodn);
	
    $linkproduct = "/pd/$linkpro";
    
	return $linkproduct;
}
//===== PRODUCT IMAGES
function productimg($photo) {

	$photolink = "extrabox/img/product/".$photo;
	return $photolink;
}

//===== BLOG DETAIL LINKS
function bloglink($blogid, $posttitle) {

	$splitPosttitle = str_split($posttitle, 30);
	$shortTitle = $splitPosttitle[0]; 
	$linkblog = $blogid."/".linkfix($shortTitle);
	
    $linkblogdetails = "/bd/$linkblog";
    
	return $linkblogdetails;
}

//===== BLOG IMAGES
function blogimg($blogphoto) {

	$blogphotolink = "extrabox/img/blog/".$blogphoto;
	return $blogphotolink;
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

function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}

function createAcronym($string) {
    $output = null;
    $token  = strtok($string, ' ');
    while ($token !== false) {
        $output .= $token[0];
        $token = strtok(' ');
    }
    return $output;
}

function createAcronym2($string, $onlyCapitals = false) {
    $output = null;
    $token  = strtok($string, ' ');
    while ($token !== false) {
        $character = mb_substr($token, 0, 1);
        if ($onlyCapitals and mb_strtoupper($character) !== $character) {
            $token = strtok(' ');
            continue;
        }
        $output .= $character;
        $token = strtok(' ');
    }
    return $output;
}

function str_acronym($str, $max = 12, $acronym = ''){
    if (strlen($str) <= $max) return $str;

    $words = explode(' ', $str);

    foreach ($words as $word)
    {
        $acronym .= strtoupper(substr($word, 0, 1));
    }

    return $acronym;
}

function getNameInitials($name) {

    preg_match_all('#(?<=\s|\b)\pL#u', $name, $res);
    $initials = implode('', $res[0]);

    if (strlen($initials) < 2) {
        $initials = strtoupper(substr($name, 0, 2));
    }

    return strtoupper($initials);
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

function countryFromIp(){
		$ip = $_SERVER['REMOTE_ADDR'];
	
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		}
		$ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
		//get ISO2 country code
		if(property_exists($ipdat, 'geoplugin_countryCode')) {
			echo $ipdat->geoplugin_countryCode;
		}
		//get country full name
		// if(property_exists($ipdat, 'geoplugin_countryName')) {
		// 	echo $ipdat->geoplugin_countryName;
		// } 
}
// Extra STARS for ratings
function svgratingstars(){
	$stars = '<div class="rating">
				<div class="rating-empty">
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#DDDDDD"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#DDDDDD"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#DDDDDD"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#DDDDDD"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#DDDDDD"></path>
				</svg>
				</div>
				<div class="rating-fill" style="width: 100%">
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#FFC42D"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#FFC42D"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#FFC42D"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#FFC42D"></path>
				</svg>
				<svg width="13" height="13" viewBox="0 0 13 13">
					<path d="M12.9813 5.00878C12.9365 4.87089 12.8174 4.77039 12.6739 4.74957L8.64387 4.16394L6.84153 0.512095C6.77739 0.382095 6.64498 0.299805 6.50002 0.299805C6.35504 0.299805 6.22266 0.382095 6.15849 0.512095L4.35607 4.16394L0.326087 4.74957C0.182656 4.77039 0.0634476 4.87089 0.0186587 5.00876C-0.0261556 5.14665 0.0112193 5.29801 0.115041 5.39919L3.03109 8.24176L2.34281 12.2556C2.31828 12.3985 2.37703 12.5428 2.49431 12.6281C2.56066 12.6763 2.63924 12.7008 2.7182 12.7008C2.77884 12.7008 2.83967 12.6863 2.89538 12.657L6.5 10.7619L10.1045 12.657C10.2328 12.7245 10.3883 12.7133 10.5056 12.628C10.6228 12.5428 10.6816 12.3984 10.6571 12.2555L9.9686 8.24176L12.885 5.39916C12.9888 5.29801 13.0262 5.14665 12.9813 5.00878Z" fill="#FFC42D"></path>
				</svg>
				</div>
			</div>';
  return $stars;
}

//Add to cart Icon
function addtocartIcon(){
	$cartIcon = '<svg class="svg-fill" width="22" height="21">
		<path d="M18.4141 6.76467L15.2899 0L14.0465 0.57426L16.9055 6.76467H6.03205L8.891 0.57426L7.64761 0L4.52341 6.76467H0.96875V11.6972H2.6111L4.2911 20.1385H18.6465L20.3265 11.6972H21.9688V6.76467H18.4141ZM17.5226 18.769H5.41493L4.00752 11.6971H18.93L17.5226 18.769ZM20.5992 10.3276H2.3383V8.13422H20.5992L20.5992 10.3276Z"></path>
		<path d="M7.54916 12.7688L6.20582 13.0361L7.13263 17.693L8.47597 17.4256L7.54916 12.7688Z"></path>
		<path d="M12.3033 12.8562H10.9337V17.6036H12.3033V12.8562Z"></path>
		<path d="M15.6513 12.7685L14.7244 17.4254L16.0677 17.6927L16.9945 13.0359L15.6513 12.7685Z"></path>
	</svg>';
	return $cartIcon;
}
//======= START RATINGS ======
function get_rating_stars($code){
    global $connect;

    $query2 = "SELECT *, count(revProId), SUM(revRate) FROM reviews where revProId = $code";
    $result = mysqli_query($connect, $query2);
    confirm_query($result);
    $item = mysqli_num_rows($result);
    $row_cat = mysqli_fetch_assoc($result);
        
    $totalrate = $row_cat['SUM(revRate)'];
    $count = $row_cat['count(revProId)'];

    if ($count != 0) {
        $divident = $count * 5;
        $rate = ($totalrate * 5)/$divident;


        if (!is_null($rate)) {        
            $rate_int = $rate/0.5;
            for($i=1; $i<=floor($rate); $i++){
                echo "<i class='fa fa-star'></i>";
            }  

            if(($rate_int % 2) == 0) {
               // echo "<i class='fa fa-star-half'></i>";
                for($i=1; $i<=5-$rate; $i++) {
                    echo "<i class='fa fa-star'></i>";
                }
            } 
            else 
            {
                echo "<i class='fa fa-star-half'></i>";
                for($i=1; $i<=5-($rate+1); $i++){
                    echo "<i class='fa fa-star'></i>";
                }
            }
        }else{
            echo "<i style='color: #FF7774'>Not Yet rated</i>";
        }
    }else{
        for($i=1; $i<=5; $i++){
                    echo "<i class='fa fa-star-o'></i>";
                }
            echo '&nbsp&nbsp&nbsp<a href="#." class="rating-count">No review</a>';
        }
}

function get_rating_stars_single($code){
    global $connect;

    $query2 = "SELECT *, count(revProId), SUM(revRate) FROM reviews where revId = $code";
    $result = mysqli_query($connect, $query2);
    confirm_query($result);
    $item = mysqli_num_rows($result);
    $row_cat = mysqli_fetch_assoc($result);
        
    $totalrate = $row_cat['SUM(revRate)'];
    $count = $row_cat['count(revProId)'];

    if ($count != 0) {
       
        
        $divident = $count * 5;
        $rate = ($totalrate * 5)/$divident;


        if (!is_null($rate)) {        
            $rate_int = $rate/0.5;
            for($i=1; $i<=floor($rate); $i++){
                echo "<i class='fa fa-star'></i>";
            }  

            if(($rate_int % 2) == 0) {
               // echo "<i class='fa fa-star-half'></i>";
                for($i=1; $i<=5-$rate; $i++) {
                    echo "<i class='fa fa-star'></i>";
                }
            } 
            else 
            {
                echo "<i class='fa fa-star-half'></i>";
                for($i=1; $i<=5-($rate+1); $i++){
                    echo "<i class='fa fa-star'></i>";
                }
            }
        }else{
            echo "<i style='color: #FF7774'>Not Yet rated</i>";
        }
    }else{
        for($i=1; $i<=5; $i++){
                    echo "<i class='fa fa-star-o'></i>";
                }
            echo '&nbsp&nbsp&nbsp<a href="#." class="rating-count">No review</a>';
        }
}

function getpaginationpagenumber(){
	if(isset($_GET['stm'])){
		$page=$_GET['stm']; 
	}elseif(isset($_GET['ste'])){
		$page=$_GET['ste']; 
	}else{
		$page=""; 
	}
	return $page;
}

function pagerangesetshop($per_page, $page, $start_from){
	//$per_page, How many items are shown per page
	//$page, The page number we are currently working on
	//$start_from, Start counting quantity per page from this number

	global $connect;
	
	$query = "SELECT * from pillshome where display='1'";
	$result = mysqli_query($connect, $query);
	// Count the total records
	$total_records = mysqli_num_rows($result);

	//Using ceil function to divide the total records on per page
	$total_pages = ceil($total_records / $per_page);
	$start_from = ($page - 1) * $per_page + 1;
	if ($start_from == 0) {$start_from= 1;} // *it happens only for the first run*

	$y = $start_from+$per_page-1;

	if ($y < $per_page){   // happens when records less than per page  
		$y = $per_page; 
	}else if ($y > $total_records){  // happens when result end is greater than total records  
		$y = $total_records;
	}

	$returnset = "Showing $start_from - $y of $total_records Products";
	return $returnset;
}

function pagerangesetsubcat($per_page, $page, $start_from, $category){
	//$per_page, How many items are shown per page
	//$page, The page number we are currently working on
	//$start_from, Start counting quantity per page from this number

	global $connect;
	
	$query = "SELECT * from pillshome where display='1' and (category = '$category' OR subcategory = '$category')";
	$result = mysqli_query($connect, $query);
	// Count the total records
	$total_records = mysqli_num_rows($result);

	//Using ceil function to divide the total records on per page
	$total_pages = ceil($total_records / $per_page);
	$start_from = ($page - 1) * $per_page + 1;
	if ($start_from == 0) {$start_from= 1;} // *it happens only for the first run*

	$y = $start_from+$per_page-1;

	if ($y < $per_page){   // happens when records less than per page  
		$y = $per_page; 
	}else if ($y > $total_records){  // happens when result end is greater than total records  
		$y = $total_records;
	}

	$returnset = "Showing $start_from - $y of $total_records Products";
	return $returnset;
}

// Subcat.php categories and subcategories picked using $_GET
function catpicker(){
	global $connect;
	$catid = catfix($_GET['u']);
        
	$querycat = "SELECT * from pillshome where display='1' and prod_id = '$catid'";
	$resultcat = mysqli_query($connect, $querycat);
	confirm_query($resultcat);
	
	$rowcatseen = mysqli_fetch_assoc($resultcat);
	
	$category   = strtoupper($rowcatseen['category']);
	
	if($category == strtoupper(catfix($_GET['category']))){
		
		$category = $rowcatseen['category'];
		
	}else{
		
		$category = $rowcatseen['subcategory'];
	}

	return $category;
}

function productdetails($column){
	global $connect;
	if (isset($_GET['item'])) {
		$code = $_GET['item'];

		$query = "SELECT * from pillshome where prod_id = '$code' and display='1' LIMIT 1";
		$run_query = mysqli_query($connect, $query);
			confirm_query($run_query);

		$foundrow = mysqli_fetch_array($run_query);	
		$productcolumn = $foundrow[$column];	
	}
	return $productcolumn;
}
// creating the shopping cart
function cart(){
	global $connect;
	if (isset($_GET['add_cart'])) {
		$ip = getIp();
		$clientEmail = logged_in();
		$pro_id = $_GET['add_cart'];
		$check_pro = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail') AND p_id='$pro_id'";
		$run_check = mysqli_query($connect, $check_pro);
		if (mysqli_num_rows($run_check)>0) {
			echo " Sorry!!! the item you selected already exists in your Cart." . "</br>" . "<a href='/' style='background-color:#9000ff; line-height:100px; color:#fff;'>Please go back and add another item. Thanks </a>";
		} else{
			$insert_pro = "insert into cart (p_id,ip_add) values ('$pro_id', '$ip')";
			$run_pro = mysqli_query($connect, $insert_pro);
			echo "<script> window.open('/','_self')</script>";
		}
	}
}
// Details of items in the clients CART
function details_of_items_in_cart(){
	global $connect;
	// Get Client's IP Address and Email
	$ip = getIp();
	$clientEmail = logged_in();
	//Select items from cart base on client's IP OR Email
	$cus_cart = "SELECT * FROM cart WHERE (ip_add='$ip' OR clientEmail='$clientEmail')";
	$run_cus_cart = mysqli_query($connect, $cus_cart);
	confirm_query($run_cus_cart);
	//Loop through cart seen results and collect respective product ID's
	while ($rowcart = mysqli_fetch_assoc($run_cus_cart)) {
	  // Assign product ID's from client's CART to a variable ($prod_id)
	  $prod_id = $rowcart['p_id'];
	  // Select items from products table base on $prod_id 
	  $pro_details = "SELECT * FROM pillshome WHERE prod_id='$prod_id'";
	  $run_pro_details = mysqli_query($connect, $pro_details);
	  confirm_query($run_pro_details);
	  // Loop to give product's name and photo from products table
	  	while ($rowprod = mysqli_fetch_assoc($run_pro_details)) {
				//Edit the HTML in this section based on the template you are working with
			echo '<div class="product-small">
				<div class="product-small-left thumbnail"><a class="thumbnail-small link-image" href="'.productlink($rowprod['prod_id'], $rowprod['prodname']).'"><img src="/extrabox/img/product/'.$rowprod['photo'].'" alt="'.$rowprod['prodname'].'" width="560" height="600" loading="lazy"/></a></div>
				<div class="product-small-body">
				<div class="h6"><a class="product-small-heading" href="'.productlink($rowprod['prod_id'], $rowprod['prodname']).'">'.$rowprod['prodname'].'</a></div>
				<div class="product-small-price price">
					<!-- <div class="price-old">$24.00</div> -->
					<div class="price-current">$'.$rowcart['new_price'].'</div>
				</div>
				</div>
				<button class="product-small-remove"><a href="/delete/'.$rowprod['prod_id'].'">
				<svg class="svg-fill" width="12" height="11">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M5.05636 5.5L0.96875 1.41239L2.38114 0L6.46875 4.08761L10.5564 0L11.9688 1.41239L7.88114 5.5L11.9688 9.58761L10.5564 11L6.46875 6.91239L2.38114 11L0.96875 9.58761L5.05636 5.5Z"></path>
				</svg></a>
				</button>
			</div>';
			
	  	} //end While loop 2
	} //end While loop 1 
}
// Total item in the cart
function total_items_in_cart() {
	if (isset($_GET['add_cart'])) {
		global $connect;
		$ip = getIp();
		$clientEmail = logged_in();
		$get_items = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail')";
		$run_items = mysqli_query($connect, $get_items);
		$count_items = mysqli_num_rows($run_items);
	} else {
		global $connect;
		$ip = getIp();
		$clientEmail = logged_in();
		$get_items = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail')";
		$run_items = mysqli_query($connect, $get_items);
		$count_items = mysqli_num_rows($run_items);
	}
	echo $count_items;
}

// Getting the total price
function total_price_items_cart(){
	$total = 0;
	global $connect;
	$ip = getIp();
	$clientEmail = logged_in();
	$get_client_cart_items = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail')";
	$run_client_cart_get_items = mysqli_query($connect, $get_client_cart_items);

	while ($p_price = mysqli_fetch_array($run_client_cart_get_items)) {
		
		$product_price = array($p_price['new_price']);
		$values = array_sum($product_price);
		$total += $values;
	}
	echo "$ ". $total;
}

// Getting the total price
function total_price_items_cart_shipping(){
	$total = 0;
	global $connect;
	$ip = getIp();
	$clientEmail = logged_in();
	$get_client_cart_items = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail')";
	$run_client_cart_get_items = mysqli_query($connect, $get_client_cart_items);

	while ($p_price = mysqli_fetch_array($run_client_cart_get_items)) {
		
		$product_price = array($p_price['new_price']);
		$values = array_sum($product_price);
		$total += $values;
	}
	$shipingprice = 20;
	// $cost = settype($shipingprice, "integer");
	$finalcost = $total+$shipingprice;
	echo "$ ". $finalcost;
}

// Getting the total price
function total_min_price(){
	$total = 0;
	global $connect;
	$ip = getIp();
	$clientEmail = logged_in();
	$get_client_cart_items = "select * from cart where (ip_add='$ip' OR clientEmail='$clientEmail')";
	$run_client_cart_get_items = mysqli_query($connect, $get_client_cart_items);

	while ($p_price = mysqli_fetch_array($run_client_cart_get_items)) {
		
		$product_price = array($p_price['new_price']);
		$values = array_sum($product_price);
		$total += $values;
	}
	return $total;
}

function producttags(){
	global $connect;
	$query = "SELECT * from producttag WHERE (tagProduct='allprodname') AND tagDisplay = '1'  ORDER BY RAND()";
	$run_query = mysqli_query($connect, $query);
	confirm_query($run_query);

	while ($rowItem = mysqli_fetch_assoc($run_query)) {

		$extra = explode(', ', $rowItem['tagKeywords']);
		$numb = count($extra);

		for ($i=0; $i < $numb; $i++) { 
			echo  linkseo(strip_tags($extra[$i]));
		} 
	}
}
   // Display categories 
function select_categories(){
	global $connect;
	$query2 = "SELECT prod_id, category, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);
		
	while ($row_cat = mysqli_fetch_assoc($result)) {
		$proid = $row_cat['prod_id'];
		$category = $row_cat['category'];
		$regist_item = array();
		foreach ($row_cat as $regist_item) {
			$item = $regist_item;
		} 
		echo '<li role="presentation"><a role="menuitem" tabindex="-1" href="'.categorylink($category, $proid) .'">'.$category." ($item)".'</a></li>';
	} 
}

function select_subatgories(){
	global $connect;
	$query2 = "SELECT subcategory, prodname,  prod_id, COUNT(subcategory)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY subcategory ";
	$query2 .= " HAVING count(subcategory) >= 1 ORDER BY RAND()";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);

	while ($row_cat = mysqli_fetch_assoc($result)) {
		$proid = $row_cat['prod_id'];
		$subcategory = $row_cat['subcategory'];
		
		$regist_item = array();
		foreach ($row_cat as $regist_item) {
			$item = $regist_item;
		} 
		echo '<li class="nav-item" role="presentation"><a class="nav-link" href="'.categorylink($subcategory, $proid) .'" data-bs-toggle="tab">'.$subcategory.'</a></li>';
	} 
}

  // Display categories in the footer
  function select_categoriesfooter(){
	global $connect;
	$query2 = "SELECT prod_id, category, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);
		
	while ($row_cat = mysqli_fetch_assoc($result)) {
		$proid = $row_cat['prod_id'];
		$category = $row_cat['category'];
		$regist_item = array();
		foreach ($row_cat as $regist_item) {
			$item = $regist_item;
		} 
		echo '<a class="footer-classic-nav-link" href="'.categorylink($category, $proid) .'">'.$category.'</a>';
	} 
}

function select_categoriesaside(){
	global $connect;
	$query2 = "SELECT prod_id, category, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);
		
	while ($row_cat = mysqli_fetch_assoc($result)) {
		$proid = $row_cat['prod_id'];
		$category = $row_cat['category'];
		$regist_item = array();
		foreach ($row_cat as $regist_item) {
			$item = $regist_item;
		} 
		echo '<li><a href="'.categorylink($category, $proid) .'">'.$category.'</a></li>';
	} 
}

// Display categories with IMAGES
function select_categoriesImg(){
	global $connect;
	$query2 = "SELECT prod_id, category, photo, COUNT(category) ";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);

	while ($row_cat = mysqli_fetch_assoc($result)) {
		$proid = $row_cat['prod_id'];
		
		// $regist_item = array();
		// foreach ($row_cat as $regist_item) {
		// 	$item = $regist_item;
		// } 
		//Edit the HTML in this section based on the template you are working with
		echo '<div class="col-sm-4 col-md-4 col-xs-12">
				<div class="featured-single">
					<div class="featured-img">
						<img src="extrabox/img/product/'.$row_cat["photo"].'"loading="lazy" alt="'.$row_cat["category"].'">
						<div class="featured-text">
							<h3> <a href="'.categorylink($row_cat["category"], $proid) .'">'.ucfirst($row_cat["category"]).'</a></h3>
							<P>Collection '.$row_cat["category"].'online</P>
						</div>
						<div class="feat-hover">
							<div class="feat-in"></div>
						</div>
					</div>
				</div>
			  </div>'
		;
	} 
		
}
function shop_by_Catgories(){
	global $connect;
	$query2 = "SELECT category, photo, prodname, prod_id, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1 ORDER BY RAND()";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);
	
	while ($row_cat = mysqli_fetch_assoc($result)) {
		$prod_id = $row_cat["prod_id"];
		echo '<a class="dropdown-item" href="'.categorylink($row_cat['category'], $prod_id) .'">'.linkfix($row_cat["category"]).'</a>';	
	} 
}

function shop_by_CatgoriesTabs(){
	global $connect;
	$query2 = "SELECT category, photo, prodname, prod_id, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1 ORDER BY prod_id DESC";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);
	
	while ($row_cat = mysqli_fetch_assoc($result)) {
		$prod_id = $row_cat["prod_id"];
		echo '<li><a href="#."><img src="assets/img/tabs.png" width="40" alt="'.linkfix($row_cat["category"]).'" /><br/><span>'.strtoupper($row_cat["category"]).'</span></a></li>';	
	} 
}

function select_sub_categories(){
	//Make DB Connection Global
	global $connect;

	$query = "SELECT prod_id, category, COUNT(category) AS NumOccurrences FROM pillshome WHERE display=1 GROUP BY category HAVING COUNT(category)>=1";

	$resultSet = mysqli_query($connect, $query);
	confirm_query($resultSet);

	while ($rowCat = mysqli_fetch_assoc($resultSet)) {
		$prod_id = $rowCat['prod_id'];

		$regist_item = array();
		foreach ($rowCat as $regist_item) {
			$item = $regist_item;
		}
		
		echo '<li class="rd-dropdown-item"><a class="rd-dropdown-link" href="'.categorylink($rowCat['category'], $prod_id) .'">'.$rowCat['category']." (".$item.")".'</a><ul class="rd-menu rd-navbar-dropdown">';

		$rowCatSeen = $rowCat['category'];

		$query2 = "SELECT prod_id, category, subcategory, COUNT(subcategory) AS NumOccurrences FROM pillshome WHERE display=1 AND category='$rowCatSeen' GROUP BY subcategory HAVING COUNT(subcategory)>=1 ORDER BY subcategory ASC";

			$resultSet2 = mysqli_query($connect, $query2);
			confirm_query($resultSet2);

			while ( $rowSub = mysqli_fetch_array($resultSet2)) {

				echo '<li class="rd-dropdown-item"><a class="rd-dropdown-link" href="'.categorylink($rowSub['subcategory'], $rowSub['prod_id']) .'">'.$rowSub['subcategory'].'</a></li>';

			} // END LOOP SUBCAT

		 echo '</ul></li>';

	} //END LOOP CATEGORIES
}

function select_categoriesLnav(){
	global $connect;
	$query2 = "SELECT category, prod_id, COUNT(category)";
			 $query2 .= "AS NumOccurrences ";
			$query2 .= " FROM pillshome where display='1' ";
			$query2 .= " GROUP BY category ";
			$query2 .= " HAVING count(category) >= 1 ORDER BY prod_id ASC  LIMIT 7";

		$resultss = mysqli_query($connect, $query2); 
	
	confirm_query($resultss);

	while ($row_cat = mysqli_fetch_assoc($resultss)) {
			$proid = $row_cat["prod_id"];

			$seencat = $row_cat["category"];

				$querycat = "SELECT catid, categ, COUNT(categ)";
				$querycat .= "AS NumOccurrences ";
				$querycat .= " FROM categories where categ = '$seencat' ";
				$querycat .= " GROUP BY categ ";
				$querycat .= " HAVING count(categ) >= 1";

				$resultcat = mysqli_query($connect, $querycat);
				confirm_query($resultcat);

		while ($rowcat = mysqli_fetch_assoc($resultcat)){
			echo '<li><a href="/categories/'. linkfix($rowcat["categ"]) . '/'. $proid .'">' .  ucfirst($rowcat["categ"]) . '</a>

				<ul>';
					$querysubcat = "SELECT prod_id, category, subcategory, COUNT(subcategory)";
					$querysubcat .= "AS NumOccurrences ";
					$querysubcat .= " FROM pillshome where display='1' AND category='$seencat' ";
					$querysubcat .= " GROUP BY subcategory ";
					$querysubcat .= " HAVING count(subcategory) >= 1 ORDER BY subcategory DESC";

					$results2 = mysqli_query($connect, $querysubcat); 
					confirm_query($results2);

					while ($rowcatnav = mysqli_fetch_assoc($results2)) {
						$proid = $rowcatnav["prod_id"];
						if(!empty($rowcatnav["subcategory"])){
							echo '<li><a href="/categories/'. linkfix($rowcatnav["subcategory"]) . '/'. $proid .'" ><i class="arrow_carrot-right"></i>' .  ucfirst($rowcatnav["subcategory"]) . '</a></li>';
						}
					}

				echo   '
				</ul>
			</li>';
		}
				
	} 
		
}

function select_categoriesLside(){
	global $connect;
	  $query2 = "SELECT category, prod_id, COUNT(category)";
			 $query2 .= "AS NumOccurrences ";
			$query2 .= " FROM pillshome where display='1' ";
			$query2 .= " GROUP BY category ";
			$query2 .= " HAVING count(category) >= 1  ORDER BY RAND()";

	$result = mysqli_query($connect, $query2); 
	
	confirm_query($result);

	while ($row_cat = mysqli_fetch_assoc($result)) {
	$proid = $row_cat['prod_id'];
	$regist_item = array();
		foreach ($row_cat as $regist_item) {
			$item = $regist_item;
		} 
	$seencat = $row_cat["category"];
		echo '<li><a href="/categories/'. linkfix($row_cat["category"]) . '/'. $proid .'"> <i class="zmdi zmdi-chevron-right"></i>' .  ucfirst($row_cat["category"]) . '<span>('.$item.')</span></a></li>';

			
	} 
		
}

function select_categoriesLnav2(){
	global $connect;
	$query2 = "SELECT category, photo, prodname,  prod_id, COUNT(category)";
	$query2 .= "AS NumOccurrences ";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " GROUP BY category ";
	$query2 .= " HAVING count(category) >= 1 ORDER BY RAND()";

	$result = mysqli_query($connect, $query2); 

	confirm_query($result);
			
	while ($row_cat = mysqli_fetch_assoc($result)) {
	$proid = $row_cat["prod_id"];
	
	$regist_item = array();
	foreach ($row_cat as $regist_item) {
		$item = $regist_item;
	} 
		echo'<div class="col-lg-4 col-md-6 col-sm-6">
			<div class="single-categories-box mb-30">
				<div class="d-flex align-items-center">
					<div class="image">
						<img src="extrabox/img/product/'.$row_cat["photo"].'" alt="'.ucfirst($row_cat["category"]).'">
					</div>

					<h3>'.ucfirst($row_cat["category"]).'</h3>
				</div>
				<a href="'.categorylink($row_cat['category'], $proid) .'" class="link-btn"></a>
			</div>
		</div>';

	}
}



function select_categoriesNavProducts(){
	global $connect;
	$query2  = "SELECT prod_id, category, prodname, new_price, old_price, photo";
	$query2 .= " FROM pillshome where display='1' ";
	$query2 .= " ORDER BY RAND()  LIMIT 4";

	$result = mysqli_query($connect, $query2); 

	confirm_query($result);
	while ($rowcat = mysqli_fetch_assoc($result)){
		echo '
			<div class="col-4">
				<ul class="mega-menu-list clearfix">
				<div class="row">
				<div class="col-md-6">
				';
					echo '<a href="/item/'.linkfix($rowcat["prod_id"]) .'/'.linkfix($rowcat["prodname"]).'"><img class="img-responsive" src="/img/product/'.$rowcat["photo"].'" alt="'.$rowcat["prodname"].'"/></a>'; 
					echo ' </div>
				<div class="col-md-6">';
					echo '<a href="/item/'.linkfix($rowcat["prod_id"]) .'/'.linkfix($rowcat["prodname"]).'">' .  ucfirst($rowcat["prodname"]) .'</a>';
					echo '<p><span class="old-price">' .  ucfirst($rowcat["old_price"]) .'</span>';
					echo  ucfirst($rowcat["new_price"]) .'</p>';
				echo '</div>
				</div>
				</ul>
			</div>
		';
	}
}

function select_categoriesblog(){
	global $connect;
			  $query2 = "SELECT category, COUNT(category)";
			 $query2 .= "AS NumOccurrences ";
			$query2 .= " FROM blog where display='1' ";
			$query2 .= " GROUP BY category ";
			$query2 .= " HAVING count(category) >= 1";

			$result = mysqli_query($connect, $query2); 
			
			confirm_query($result);
		
		 while ($row_cat = mysqli_fetch_assoc($result)) {
		  $proid = md5(uniqid(mt_rand(), true));
			$regist_item = array();
		foreach ($row_cat as $regist_item) {
		$item = $regist_item;
		} 

			echo '<li><a href="/blogcategory?categ='.strtolower(u($row_cat["category"])).'">' .ucfirst($row_cat["category"]) . " " . " ($item)" . "</a></li>";
		
		
		 } 
}

// FUNCTION TO TRANSLATE DATE AND TIMES INTO NICE DATE EG 2 HOURS AGO ETC...
function nicetime($date){
	if(empty($date)) {
		return "No date provided";
	}
	
	$periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	$lengths         = array("60","60","24","7","4.35","12","10");
	
	$now             = time();
	$proidnix_date       = strtotime($date);
	
	// check validity of date
	if(empty($proidnix_date)) {    
		return "Bad date";
	}

	// is it future date or past date
	if($now > $proidnix_date) {    
		$difference     = $now - $proidnix_date;
		$tense         = "ago";
		
	} else {
		$difference     = $proidnix_date - $now;
		$tense         = "from now";
	}
	
	for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
		$difference /= $lengths[$j];
	}
	
	$difference = round($difference);
	
	if($difference != 1) {
		$periods[$j].= "s";
	}
	
	return "$difference $periods[$j] {$tense}";
}

// Checkout body for all payment other then Credit Card
function checkoutbody1($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$payoptchecked,$paytoValue,$orderId){
	// Company details
	$compEmail = companyD('compEmail');
	$compName = companyD('compName');
	$compWeb = explode("@", "$compEmail");
	$bodycheckout = '<!doctype html>
		<html class="no-js" lang="en">
			<head>
					
				<meta charset="utf-8">
				<meta http-equiv="x-ua-compatible" content="ie=edge">
				<title>My Order</title>
				<meta name="description" content="">


				<style type="text/css">
					table{background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
					border: medium none;
					width: 100%;}
						table th, 	 table td {
						border-bottom: 1px solid #d8d8d8;
						border-right: medium none;
						font-size: 14px;
						padding: 5px 0;
						text-align: center;
						color: #000;
					}
						table th{border-top: medium none;
					font-family: Montserrat,Arial,Helvetica,sans-serif;
					font-weight: normal;
					text-align: center;
					text-transform: uppercase;
					vertical-align: middle;
					white-space: nowrap;
					width: 250px;}

					table td.product-name a{font-size: 14px;
					font-weight: 700;
					margin-left: 10px;
					color: #6f6f6f;}
					ul {
						list-style-type:none;
					}
				</style>
			</head>
			<body>
				<article style="float:left; position:relative; left:50%; transform: translate(-50%); max-width:800px; border:1px solid #aaa; background-color:#ede8e8;">	

					<div style="padding:5px; text-align: center; border-bottom: 2px solid #aaa;">
						<a href="https://www.'.$compWeb.'"><h3>'.$compName.'</h3></a>
					</div>

					<div style="padding:5px; text-align: center; border-bottom: 2px dotted #aaa;">
						<h5>Thanks for placing your ORDER ID '.$orderId.'.</h5>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>User Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>First Name</td>
									<td>'.$fname.'</td>
								</tr>
								<tr>
									<td>Last Name</td>
									<td>'.$lname.'</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>'.$email.'</td>
								</tr>
								<tr>
									<td>Phone</td>
									<td>'.$phone.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Location Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>Country</td>
									<td>'.$country.'</td>
								</tr>
								<tr>
									<td>Address</td>
									<td>'.$address.'</td>
								</tr>
								<tr>
									<td>addsuite</td>
									<td>'.$addsuite.'</td>
								</tr>
								<tr>
									<td>Town/City</td>
									<td>'.$townCity.'</td>
								</tr>
								<tr>
									<td>State</td>
									<td>'.$state.'</td>
								</tr>
								<tr>
									<td>Post/Zip Code</td>
									<td>'.$postzip.'</td>
								</tr>
								<tr>
									<td>Order Note</td>
									<td>'.$checkoutmess.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Orders Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>Orders</td>
									<td>'.$yourorder.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Payment Option Chosen</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name">Option</th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>'.$payoptchecked.'</td>
									<td>'.$paytoValue.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:20px 0 10px 0; text-align: center;">
						<a href="#.." onclick="window.print()">Print This page </a>&nbsp;&nbsp; OR &nbsp;&nbsp;
						<a href="https://www.'.$compWeb.'">Go Home </a>
					</div>
				</article>
			</body>
		</html>';
	return $bodycheckout;
}

// Checkout Body for all payment with Credit Card
function checkoutbodycard($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$owner,$cardNumber,$cvv,$monthcard,$yearcard,$orderId){
	// Company details
	$compEmail = companyD('compEmail');
	$compName = companyD('compName');
	$compWeb = explode("@", "$compEmail");
	$bodycheckoutcard = '<!doctype html>
		<html class="no-js" lang="en">
			<head>
					
				<meta charset="utf-8">
				<meta http-equiv="x-ua-compatible" content="ie=edge">
				<title>My Order</title>
				<meta name="description" content="">

				<style type="text/css">
					table{background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
					border: medium none;
					width: 100%;}
						table th, 	 table td {
						border-bottom: 1px solid #d8d8d8;
						border-right: medium none;
						font-size: 14px;
						padding: 5px 0;
						text-align: center;
						color: #000;
					}
						table th{border-top: medium none;
					font-family: Montserrat,Arial,Helvetica,sans-serif;
					font-weight: normal;
					text-align: center;
					text-transform: uppercase;
					vertical-align: middle;
					white-space: nowrap;
					width: 250px;}

					table td.product-name a{font-size: 14px;
					font-weight: 700;
					margin-left: 10px;
					color: #6f6f6f;}
					ul {
						list-style-type:none;
					}
				</style>
			</head>
			<body>
				<article style="float:left; position:relative; left:50%; transform: translate(-50%); max-width:800px; border:1px solid #aaa; background-color:#ede8e8;">	

					<div style="padding:5px; text-align: center; border-bottom: 2px solid #aaa;">
						<a href="https://www.'.$compWeb.'"><h3>'.$compName.'</h3></a>
					</div>

					<div style="padding:5px; text-align: center; border-bottom: 2px dotted #aaa;">
						<h5>Thanks for placing your ORDER ID '.$orderId.'.</h5>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>User Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>First Name</td>
									<td>'.$fname.'</td>
								</tr>
								<tr>
									<td>Last Name</td>
									<td>'.$lname.'</td>
								</tr>
								<tr>
									<td>Email</td>
									<td>'.$email.'</td>
								</tr>
								<tr>
									<td>Phone</td>
									<td>'.$phone.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Location Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>Country</td>
									<td>'.$country.'</td>
								</tr>
								<tr>
									<td>Address</td>
									<td>'.$address.'</td>
								</tr>
								<tr>
									<td>addsuite</td>
									<td>'.$addsuite.'</td>
								</tr>
								<tr>
									<td>Town/City</td>
									<td>'.$townCity.'</td>
								</tr>
								<tr>
									<td>State</td>
									<td>'.$state.'</td>
								</tr>
								<tr>
									<td>Post/Zip Code</td>
									<td>'.$postzip.'</td>
								</tr>
								<tr>
									<td>Order Note</td>
									<td>'.$checkoutmess.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Orders Info</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name"></th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td>Orders</td>
									<td>'.$yourorder.'</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:5px; text-align: center;">
						<h3>Payment Option Chosen</h3>
						<table>
							<thead>
								<tr>
									<th class="product-name">Option</th>
									<th class="product-name">Details</th>
								</tr>							
							</thead>
							<tbody>
								<tr>
									<td> Credit Card</td>
									<td> 
										<p><span>Name on Card:&nbsp; </span>'.$owner.'</p>
										<p><span>Card Number:&nbsp; </span>'.$cardNumber.'</p>
										<p><span>CVV:&nbsp; </span>'.$cvv.'</p>
										<p><span>Exp. Month:&nbsp; </span>'.$monthcard.'</p>
										<p><span>Exp. Year:&nbsp; </span>'.$yearcard.'</p>

									</td>
								</tr>
							</tbody>

							<tfoot>
								
							</tfoot>
							
						</table>
					</div>

					<div style="padding:20px 0 10px 0; text-align: center;">
						<a href="#.." onclick="window.print()">Print This page </a>&nbsp;&nbsp; OR &nbsp;&nbsp;
						<a href="https://www.'.$compWeb.'">Go Home </a>
					</div>
				</article>
			</body>
		</html>';
	return $bodycheckoutcard;
}


function checkoutbodyuser($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$payoptchecked,$paytoValue,$orderId){
	// Company details
	$compEmail = companyD('compEmail');
	$compName = companyD('compName');
	$compWeb = explode("@", "$compEmail");
	$userorder = '<!doctype html>
		<html class="no-js" lang="">
			<head>			
				<meta charset="utf-8">
				<meta http-equiv="x-ua-compatible" content="ie=edge">
				<title>My Order</title>
				<meta name="description" content="">
				<link rel="icon" type="image/png" href="images/favicon.png">
				<style type="text/css">
					table{background: rgba(0, 0, 0, 0) none repeat scroll 0 0;
					border: medium none;
					width: 100%;}
						table th, 	 table td {
						border-bottom: 1px solid #d8d8d8;
						border-right: medium none;
						font-size: 14px;
						padding: 5px 0;
						text-align: center;
						color: #000;
					}
						table th{border-top: medium none;
					font-family: Montserrat,Arial,Helvetica,sans-serif;
					font-weight: normal;
					text-align: center;
					text-transform: uppercase;
					vertical-align: middle;
					white-space: nowrap;
					width: 250px;}

					table td.product-name a{font-size: 14px;
					font-weight: 700;
					margin-left: 10px;
					color: #6f6f6f;}
					ul {
						list-style-type:none;
					}
				</style>
			</head>
			<body>			
				<table border="0" cellpadding="0" cellspacing="0" width="600" id="v1template_container" style="background-color: #ffffff; border: 1px solid #dedede; box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1); border-radius: 3px">
					<tbody>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="100%" id="v1template_header" style="background-color: #96588a; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; border-radius: 3px 3px 0 0">
									<tbody>
										<tr>
											<td id="v1header_wrapper" style="padding: 36px 48px; display: block">
												<h1 style="font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 30px; font-weight: 300; line-height: 150%; margin: 0; text-align: left; text-shadow: 0 1px 0 #ab79a1; color: #ffffff; background-color: inherit">New Order: '.$orderId.'</h1>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
						<tr>
							<td align="center" valign="top">
								<table border="0" cellpadding="0" cellspacing="0" width="600" id="v1template_body">
									<tbody>
										<tr>
											<td valign="top" id="v1body_content" style="background-color: #ffffff">
												<table border="0" cellpadding="20" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td valign="top" style="padding: 48px 48px 32px">
																<div id="v1body_content_inner" style="color: #636363; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: left">
																	<p style="margin: 0 0 16px">You have received the following order from '.$fname .' '.$lname.':</p>
																		<h2 style="color: #96588a; display: block; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left">
																			<a class="v1link" href="https://www.'.$compWeb.'" style="font-weight: normal; text-decoration: underline; color: #96588a" target="_blank" rel="noreferrer">[Order '.$orderId.']</a> ('.date("F j, Y, g:i a").')
																		</h2>

																		<div style="margin-bottom: 40px">
																			<table class="v1td" cellspacing="0" cellpadding="6" border="1" style="color: #636363; border: 1px solid #e5e5e5; vertical-align: middle; width: 100%; font-family: Helvetica, Roboto, Arial, sans-serif">
																				'.$yourorder.'
																			</table>
																		</div>


																		<table id="v1addresses" cellspacing="0" cellpadding="0" border="0" style="width: 100%; vertical-align: top; margin-bottom: 40px; padding: 0">
																			<tbody>
																				<tr>
																					<td valign="top" width="50%" style="text-align: left; font-family: Helvetica, Roboto, Arial, sans-serif; border: 0; padding: 0">
																					<h2 style="color: #96588a; display: block; font-family: &quot;Helvetica Neue&quot;, Helvetica, Roboto, Arial, sans-serif; font-size: 18px; font-weight: bold; line-height: 130%; margin: 0 0 18px; text-align: left">Billing address</h2>

																					<address class="v1address" style="padding: 12px; color: #636363; border: 1px solid #e5e5e5">
																					'.$fname .' '.$lname.'<br>'.$address.'<br>'.$addsuite.'<br>'.$townCity.'<br>'.$state.'<br>'.$postzip.'<br>'.$country.'									<br>
																						<a href="tel:'.$phone.'" style="color: #96588a; font-weight: normal; text-decoration: underline" target="_blank" rel="noreferrer">'.$phone.'</a>													<br>'.$email.'			
																					</address>
																					</td>
																				</tr>
																				<tr>
																					<td>'.$payoptchecked.'</td>
																					<td>'.$paytoValue.'</td>
																				</tr>
																			</tbody>
																		</table>
																</div>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</body>
		</html>';
	return $userorder;
}

?>








