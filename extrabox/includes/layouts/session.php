<?php 
session_start();

function message(){
    if (isset($_SESSION["message"])) {

		$output  ='<div class="alert fade show product-filter-badge" role="alert"><span>'.$_SESSION["message"].'</span>
					<button class="close" type="button" data-bs-dismiss="alert" aria-label="Close">
					<svg class="svg-fill" width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path fill-rule="evenodd" clip-rule="evenodd" d="M4.63962 5.5L0 10.1396L0.860376 11L5.5 6.36038L10.1396 11L11 10.1396L6.36038 5.5L11 0.860374L10.1396 -9.53674e-07L5.5 4.63962L0.860376 -9.53674e-07L0 0.860374L4.63962 5.5Z"></path>
					</svg>
					</button>
				</div>';
		
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