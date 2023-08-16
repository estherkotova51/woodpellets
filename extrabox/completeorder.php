<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

  	require_once("includes/layouts/initialize2.php");
	// include_once('headsection.php');
?>

<?php
	    //Import PHPMailer classes into the global namespace
        //These must be at the top of your script, not inside a function
        
    //     use PHPMailer\PHPMailer\PHPMailer;
    // 	use PHPMailer\PHPMailer\Exception;

		require 'PHPMailer/src/Exception.php';
		require 'PHPMailer/src/PHPMailer.php';
		require 'PHPMailer/src/SMTP.php';
						
		if (isset($_POST["email"])) {
		    
		    // Company details
    			$compEmail = companyD('compEmail');
    			$compName = companyD('compName');
    			$compWeb = explode("@", "$compEmail");
	
			$country 		= escapeString($_POST["country"]);
			$fname 			= escapeString($_POST["fname"]);
			$lname 			= escapeString($_POST["lname"]);
			$address 		= escapeString($_POST["address"]);
			$addsuite 		= escapeString($_POST["addsuite"]);
			$townCity 		= escapeString($_POST["townCity"]);
			$state 			= escapeString($_POST["state"]);
			$postzip 		= escapeString($_POST["postzip"]);
			$email 			= escapeString($_POST["email"]);
			$phone 			= escapeString($_POST["phone"]);
			$checkoutmess 	= escapeString($_POST["checkoutmess"]);
	
			$yourorder 		= escapeString($_POST["yourorder"]);
			$payoptchecked  = escapeString($_POST["payoptchecked"]);

			$paytoValue 	= escapeString($_POST["paytoValue"]);

			$orderId = mt_rand_str(6, '0123456789ABCDEF');

			
	
			if (isset($paytoValue)) {
			    
				$body = checkoutbody1($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$payoptchecked,$paytoValue,$orderId);
	
			}elseif (isset($_POST["owner"]) && isset($_POST["cardNumber"])) {
				$owner 	        = escapeString($_POST["owner"]);
				$cardNumber 	= escapeString($_POST["cardNumber"]);
				$cvv 			= escapeString($_POST["cvv"]);
				$monthcard 		= escapeString($_POST["monthcard"]);
				$yearcard 		= escapeString($_POST["yearcard"]);

				$paytovalue = "Credit Card";
	
				$body = checkoutbodycard($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$owner,$cardNumber,$cvv,$monthcard,$yearcard,$orderId);

			}

				$bodydone = str_replace('\n', '', $body);
				$subject = "Your Order ".$orderId;

					//Create an instance; passing `true` enables exceptions
					$mail = new PHPMailer(true);

					try {
						//Server settings
						//$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
						//$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = "mail.rxanabolics.com";                     //Set the SMTP server to send through
						$mail->SMTPAuth   = false;                                   //Enable SMTP authentication
						$mail->Username   = "info@rxanabolics.com";                     //SMTP username
						$mail->Password   = "malvingueMah1956";                               //SMTP password
						$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
						$mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
					
						//Recipients
						$mail->setFrom("info@rxanabolics.com", "$compName");
						$mail->addAddress("info@rxanabolics.com", "$compName");     //Add a recipient
						//$mail->addAddress('ellen@example.com');               //Name is optional
						$mail->addReplyTo("$email", "$fname");
						//$mail->addCC('cc@example.com');
						//$mail->addBCC("$email");
					
						//Attachments
						//$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
						//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
					
						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = "$subject";
						$mail->Body    = "$bodydone";
						//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
					
						$mail->send();
						//echo 'Message has been sent';
					} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					}

				$name = $fname." ".$lname;

				$postorder = "INSERT INTO orders (newOrderId, country, fname, faddress, addsuite, townCity, fstate, postzip, email, phone, checkoutmess, yourorder, payoptchecked, paytoValue) VALUES ('{$orderId}', '{$country}', '{$name}', '{$address}', '{$addsuite}', '{$townCity}', '{$state}', '{$postzip}', '{$email}', '{$phone}', '{$checkoutmess}', '{$yourorder}', '{$payoptchecked}', '{$paytovalue}')";
	
				$resultorder = mysqli_query($connect, $postorder);
				confirm_query($resultorder);

				// Prepare to send Email to the USER
				$bodyuser = checkoutbodyuser($fname,$lname,$email,$phone,$country,$address,$addsuite,$townCity,$state,$postzip,$checkoutmess,$yourorder,$payoptchecked,$paytoValue,$orderId);

				$bodydoneuser = str_replace('\n', '', $bodyuser);
				$subjectuser = "Your Approved Order ".$orderId;

				//Create an instance; passing `true` enables exceptions
				$mailuser = new PHPMailer(true);

				try {
					//Server settings
					//$mailuser->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
					$mailuser->isSMTP();                                            //Send using SMTP
					$mailuser->Host       = "mail.rxanabolics.com";                     //Set the SMTP server to send through
					$mailuser->SMTPAuth   = false;                                   //Enable SMTP authentication
					$mailuser->Username   = "info@rxanabolics.com";                     //SMTP username
					$mailuser->Password   = "malvingueMah1956";                               //SMTP password
					$mailuser->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
					$mailuser->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
				
					//Recipients
					$mailuser->setFrom("$compEmail", "$compName");
					$mailuser->addAddress("$email", "$fname");     //Add a recipient
					//$mailuser->addAddress('ellen@example.com');               //Name is optional
					$mailuser->addReplyTo("$compEmail", "$compName");
					//$mailuser->addCC('cc@example.com');
					//$mailuser->addBCC("$email");
				
					//Attachments
					//$mailuser->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
					//$mailuser->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
				
					//Content
					$mailuser->isHTML(true);                                  //Set email format to HTML
					$mailuser->Subject = "$subjectuser";
					$mailuser->Body    = "$bodydoneuser";
					//$mailuser->AltBody = 'This is the body in plain text for non-HTML mail clients';
				
					$mailuser->send();
					//echo 'Message has been sent';
				} catch (Exception $e) {
					echo "Message could not be sent. Mailer Error: {$mailuser->ErrorInfo}";
				}


	
		}elseif (isset($_POST["yourorder"]) == "Your Cart is EMPTY." && isset($_POST["email"]) !="") {
			echo "<h5 style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'>Your CART EMPTY.</h5>";
		}
		// else{
		// 	echo "bad codes";
		// 	echo isset($_POST["yourorder"]);
		// }
	
		// End check out option
?>
