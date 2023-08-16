<?php require_once("../includes/layouts/session.php"); ?>
<?php require("../includes/layouts/db_connect.php"); ?>
<?php require_once("../includes/layouts/functions.php"); ?>
<?php confirm_staff_logged_in(); ?>
<?php  
	// V1: simple logout
	// session_start()
	$_SESSION["id"] = null;
	$_SESSION["username"] = null;

	$_SESSION['message'] = "Log Out completed. Goodbye.";
	echo "<script>window.open('staff_log_in.php', '_self')</script>";
?>

<?php 
// V2: destroy session
// assumes nothing else in session to keep
// session_start();
// $_SESSION = array();
// if (isset($_COOKIE[session_name()])) {
// 	setcookie(session_name(), '', time()-42000, "/");
// }
// session_destroy();
// redirect_to("login.php");

?>