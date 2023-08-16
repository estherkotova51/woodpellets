<?php 
 session_start();

function message(){
    if (isset($_SESSION["message"])) {
		$output  = "<div class=\"sessionView alert\">";
		$output .= '<button type="button" class="close" data-dismiss="alert">×</button>';
		$output .= htmlentities($_SESSION["message"]);
		$output .= "</div>";
		
		// clear message after use
		$_SESSION["message"] = null;

		return $output;
	}
}

function message1(){
    if (isset($_SESSION["message1"])) {
		$output  = "<div style=\"text-align: center; color: #fff; font-family: sans-serif; font-weight: bold;\">";
		$output .= htmlentities($_SESSION["message1"]);
		$output .= "</div>";
		
		// clear message after use
		$_SESSION["message1"] = null;

		return $output;
	}
}

function errors(){
    if (isset($_SESSION["errors"])) {
		$errors = $_SESSION["errors"];
		
		// clear message after use
		$_SESSION["errors"] = null;

		return $errors;
	}
}

function cart_updated(){
    if (isset($_SESSION["cart_item"])) {
		$output  = "<div class=\"sessionView alert\">";
		$output .= '<button type="button" class="close" data-dismiss="alert">×</button>';
		$output .= htmlentities($_SESSION["cart_item"]);
		$output .= "</div>";
		
		// clear message after use
		$_SESSION["cart_item"] = null;

		return $output;
	}
}

?>