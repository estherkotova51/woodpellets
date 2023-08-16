<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php"); ?>

<?php
	// echo "<script>window.open('index.php','_self')</script>";
		if (!empty(isset($_POST["initprice"])) && isset($_POST["quantity"])) {
			$initprice = explode(",", $_POST["initprice"]);


			echo "$" . $initprice[1]*$_POST["quantity"];
			
		}elseif (!empty(isset($_POST["miniprice"])) && isset($_POST["quantity"])) {
			$initprice = $_POST["miniprice"];

			echo "$" . $initprice*$_POST["quantity"];
			
		}
		// Frequent use for e-commerce with variable quantities
		if (isset($_POST["prod_id"]) && !empty(isset($_POST["pricerate"])) && isset($_POST["quantity"])) {

			$ip = getIp();

			if (isset($_SESSION['c_email'])) {
				$clientEmail = $_SESSION['c_email'];
			}else{
				$clientEmail = "";
			}
			
			$prod_id = $_POST["prod_id"];

			$pricerate = $_POST["pricerate"];
			$quantity2 = $_POST["quantity"];

			$check_pro = "SELECT * from cart where ip_add='$ip' AND clientEmail='$clientEmail' AND p_id='$prod_id'";
			$run_check = mysqli_query($connect, $check_pro);
			confirm_query($check_pro);

			if (mysqli_num_rows($run_check)>0) {
				list($varqty, $newprice) = explode(",", $pricerate);

				
				$newprice2 =  $newprice*$quantity2;
				$quantity = "$quantity2";  

				$insert_pro = "UPDATE cart SET qty='$quantity', varqty='$varqty', unitPrice='$newprice', new_price='$newprice2'  where ip_add='$ip' AND p_id='$prod_id' ";
				$run_pro = mysqli_query($connect, $insert_pro);

				echo alertbutton('Cart info for this item have been Updated<a href="/cart">&nbsp;&nbsp; View cart</a>');
			} else{
				list($varqty, $newprice) = explode(",", $pricerate);

				$newprice2 =  $newprice*$quantity2;
				$quantity = $quantity2;  

				$insert_pro = "INSERT into cart (p_id, clientEmail, ip_add, qty, varqty, unitPrice, new_price) values ('{$prod_id}', '{$clientEmail}', '{$ip}', '{$quantity}', '{$varqty}', '{$newprice}', '{$newprice2}')";
				$run_pro = mysqli_query($connect, $insert_pro);
				confirm_query($run_pro);

				//echo $varqty ." - ". $prod_id ." - ".$quantity2;

				echo alertbutton('Cart Updated<a href="/cart">&nbsp;&nbsp; View cart</a>');
			}
		} elseif (isset($_POST["prod_id"]) && !empty(isset($_POST["miniprice"])) && isset($_POST["quantity"])) {

			$ip = getIp();

			if (isset($_SESSION['c_email'])) {
				$clientEmail = $_SESSION['c_email'];
			}else{
				$clientEmail = "";
			}
			
			$prod_id = $_POST["prod_id"];

			$pricerate = $_POST["miniprice"];
			$quantity2 = $_POST["quantity"];
			// $newprice  = $pricerate/$quantity2;

			$check_pro = "SELECT * from cart where ip_add='$ip' AND p_id='$prod_id'";
			$run_check = mysqli_query($connect, $check_pro);
			confirm_query($check_pro);

			if (mysqli_num_rows($run_check)>0) {
				$newprice2 =  $pricerate*$quantity2;
				$quantity = "$quantity2";

				$insert_pro = "UPDATE cart SET qty='$quantity', unitPrice='$pricerate', new_price='$newprice2'  where ip_add='$ip' AND p_id='$prod_id' ";
				$run_pro = mysqli_query($connect, $insert_pro);

				echo alertbutton('Cart info for this item have been Updated<a href="/cart">&nbsp;&nbsp; View cart</a>');
			} else{
				// list($varqty, $newprice) = explode(",", $pricerate);

				 $newprice2 =  $pricerate*$quantity2;
				 $quantity = "$quantity2";  

				$insert_pro = "INSERT into cart (p_id, clientEmail, ip_add, qty, unitPrice, new_price) values ('$prod_id', '{$clientEmail}', '$ip', '$quantity', '$pricerate', '$newprice2')";
				$run_pro = mysqli_query($connect, $insert_pro);

				echo alertbutton('Cart Updated<a href="/cart">&nbsp;&nbsp; View cart</a>');
			}
		}



		// check out option

		if (isset($_POST['paymentopt']) && !empty(isset($_POST['paymentopt']))) {

			global $connect;

			$payopt2 = $_POST['paymentopt'];

			if ($payopt2 == "WesternUnion") {
						echo "<p><a href='http://locations.westernunion.com/us' target='_blank' style='font-weight:bold; color:#043193;'>Find Western Union nearby &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a> </p>";
						echo "<p><a href='https://www.westernunion.com/us/en/send-money-online.html' target='_blank' style='font-weight:bold; color:#043193;'>How to send money online and transfer money online using Western Union &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a> </p>";
	                  echo "<p> -Make Payment online at www.westernunion.com or download the Western Union App.<br/>
	                            -Send funds as “Money in Minutes”<br/>
	                            -You will need to visit a Western Union Store to complete Payment with Cash for payments over $999.<br/>
	                            -Your Order is considered valid once we receive details of your payment(Ten-Digit MTCN #) along side a screenshot of your order<br/>
	                            -Order will not be shipped until we receive proof of payment(Ten-Digit MTCN #) along side your a screenshot of your order<br/>
	                            </p>";
			
			}elseif ($payopt2 == "MoneyGram") {
					echo "<p><a href='https://secure.moneygram.com/locations' target='_blank' style='font-weight:bold; color:#043193;'>MoneyGram Locations Near Me &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a> </p>";
					echo "<p><a href='https://www.moneygram.com/us/en/send-money-online' target='_blank' style='font-weight:bold; color:#043193;'>How to send money online and transfer money online using MoneyGram &nbsp;&nbsp;&nbsp;<i class='fa fa-search'></i></a> </p>";
			
			}elseif($payopt2 == "PayPal") {

					// $query = "SELECT * FROM payaddress";
					// $run_query = mysqli_query($connect, $query);
					// confirm_query($run_query);
					// $rowfound = mysqli_fetch_assoc($run_query);

					echo "<h5>Our Paypal Address:</h5>
						<p><span style='font-weight:bold; color:#000;'>will be made available once your Order has been approved</span> </p><p><a href='https://www.paypal.com/signin' target='_blank'>Visit paypal to complete purchase</a></p>";
			
			}elseif($payopt2 == "Bitcoin") {

				$query = "SELECT * FROM bitaddress";
				$run_query = mysqli_query($connect, $query);
				confirm_query($run_query);
				
				$rowfound = mysqli_fetch_assoc($run_query);

				echo "<h5>Our Bitcoin Wallet:</h5>
					<p><span style='font-weight:bold; color:#000;'>".$rowfound["newbitaddress"]."</span> </p>";

			}elseif($payopt2 == "Agiftcard") {

				echo '
				<h4>Chosen Method : Amazon Gift Card </h4>

				<h5>Enter Claim Code below:</h5>
				
				<div class="checkout-form-list">
					<input type="text" placeholder="Enter Gift card Claim Code Here" id="giftcard" required/>
				</div>';

			}elseif($payopt2 == "Zelle") {

				echo "<p>1) Download the Zelle App to get Started!<br/>

				2) All you need to send money with Zelle is the preferred email address or mobile number of the trusted recipient.<br/>

				3) Your Order is considered valid once we receive details of your payment, which should be Pictures or Screenshots showing Transaction Details along side your Order ID.</p>";

			}elseif($payopt2 == "CashApp") {

				echo '<h5>Cash App details</h5>
			
				<div class="checkout-form-list">
					<h6>will be made available once Order has been approved!</h6>
				</div>';
    
			}elseif($payopt2 == "bankt") {

				echo '<h5>Bank Wire Transfer T/T</h5>
			
				<div class="checkout-form-list">
					<h6>Details will be made available once Order has been approved</h6>
				</div>';

			}elseif($payopt2 == "CreditCard") {

				echo '<h4 style="text-align: center;">Secure Credit Card Payment Gateway  </h4><img src="extrabox/img/comodo.jpg"/>';
				include_once('card/index.php');
			}
		}
	// End check out option


		// reviews Processor

		if (isset($_POST["prodId"]) && !empty($_POST["email"])) {

			$ip = getIp();
			
			$prod_id = $_POST["prodId"];

			$email = $_POST["email"];
			$name = $_POST["name"];
			$message = $_POST["message"];
			$display = $_POST["display"];

			if (isset($_POST["star1"])) {
				$star1 = $_POST["star1"];
			}elseif (isset($_POST["star2"])) {
				$star1 = $_POST["star2"];
			}elseif (isset($_POST["star3"])) {
				$star1 = $_POST["star3"];
			}elseif (isset($_POST["star4"])) {
				$star1 = $_POST["star4"];
			}elseif (isset($_POST["star5"])) {
				$star1 = $_POST["star5"];
			}

				$newrate =  $star1; 

				$insert_pro = "INSERT into reviews (revEmail, revName, revMess, revDisp, revProId, revRate, revIp) values ('$email', '$name', '$message', '$display', '$prod_id', '$newrate', '$ip')";
				$run_pro = mysqli_query($connect, $insert_pro);

				echo alertbutton('Review Updated');
		} 

		if (isset($_POST["cartqty"])) {
			echo '<button class="btn btn-primary" type="submit" name="upyourcart" value="upyourcart" id="upyourcart">
			<span>Update your Cart</span></button>';	
		}

		if (isset($_POST["qtycarpppt"])) {
			// list($varqty, $newprice) = explode(",", $pricerate);

			// 	$newprice2 =  $newprice*$quantity2;
			// 	$quantity = "$quantity x ($quantity2)";  

			// 	$insert_pro = "UPDATE cart SET qty='$quantity', new_price='$newprice2'  where ip_add='$ip' AND p_id='$prod_id' ";
			// 	$run_pro = mysqli_query($connect, $insert_pro);

			// echo 'ddd';
			
		}
		
?>