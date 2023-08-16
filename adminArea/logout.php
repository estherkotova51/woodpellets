<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php") ?>
<?php confirm_staff_logged_in(); ?>

<title> Log Out</title>
</head>

<?php  
	// V1: simple logout
	// session_start()
	$_SESSION["adm_id"] = null;
	$_SESSION["username"] = null;

	redirect_to("index.php");
?>
