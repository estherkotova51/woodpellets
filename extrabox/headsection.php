<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
  <head>

    <!-- ============= DND ============= -->
    <?php 
      $url =  "https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";

      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
    ?>
    <link rel="canonical" href="<?php echo $escaped_url; ?>">

    <?php
      $compdescription = strip_tags(companyD('compDescription'));
      $compdesc = str_split($compdescription, 140);
      strip_tags($compdesc['0']); 

      $phoneN = explode('||', companyD('compPhone'));
      $phoneN1 = explode(':>', $phoneN[0]); 
      // $phoneN2 = explode(':>', $phoneN[1]); 

      $compEmail = companyD('compEmail');
      $compName = companyD('compName');
      $compWeb = explode("@", "$compEmail");
    ?>
     
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="author" content="<?= $compName; ?>" />
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <!-- ============= DND ============= -->

   
    	<!-- Font css  -->
      <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,400,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Bitter' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lato:400,400italic,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="fonts/fonts.css">
	
    <!-- Fontawesome css      -->
    <link rel="stylesheet" href="../../../maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/normalize.css">
	
    <!-- Bootstrap css      -->
    <link rel="stylesheet" href="css/bootstrap.css">
	
    <!-- Owncarousel css      -->
    <link rel="stylesheet" href="css/owl.carousel.css">
	
	<!-- image zoom -->
	<link rel="stylesheet" href="css/glasscase.css">
	<link rel="stylesheet" href="css/glasscase.minf195.css">
	
    <!-- CSS STYLE-->
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	
    <!-- SLIDER REVOLUTION 4.x CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="css/extralayers.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="rs-plugin/css/settings.css" media="screen" />
	
    <!-- Main css   -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/responsive.css">
	
	<!-- Favicons -->
	<link rel="apple-touch-icon-precomposed" href="images/apple-touch-icon-precomposed.png">
	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/> 


    <!-- ============= DND ============= -->
    <link rel="stylesheet" href="extrabox/checkoutCodes/checkoutstyle.css">
    <link rel="stylesheet" href="extrabox/checkoutCodes/ratingsstars.css"> 
    <link rel="stylesheet" href="extrabox/notifications/notifications.css"> 
    <link rel="stylesheet" href="extrabox/checkoutCodes/font-awesome.min.css"> 
     <!-- ============= DND ============= -->
     <style>
       .dd-selected,.dd-option,.dd-option-selected{
          height: 47px !important;
          max-height: 48px !important;
        }
        .dd-selected-image, .dd-option-image { width:20px; height:15px;}
        
        .dd-selected-text, label, .dd-option-text{
          display: block;
          margin-bottom: .5rem;
          float: left;
          font-weight: normal;
          font-size: 12px;
        }

        .dd-selected-description, .dd-desc, .dd-selected-description-truncated{
          float: left;
          font-weight: normal;
          margin-left:5px;
        }
        .footernotice{
          text-align: center;
          font-size: 12px;
          line-height: 14px;
          color: #fffeee;
        }
     </style>

   