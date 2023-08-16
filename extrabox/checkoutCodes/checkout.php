<?php require_once("includes/layouts/session.php"); ?>
<?php require("includes/layouts/db_connect.php"); ?>
<?php require_once("includes/layouts/functions.php"); ?>
<!doctype html>
<html lang="en">

<head>
    <?php include_once('headsection.php'); ?>
    <!-- Coded by sdlfkjsdklfjdfjlskjkfsj -->

    <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Buy Play Station 5 online | Pro Gaming City - Checkout</title> 
        <meta name="description" content="Order Xbox and Play Station 5 affordably with guaranteed worldwide shipping within 48 hours. Buy Play Station and XBOX games online">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- favicon
		============================================ -->		
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
		<!-- Google Fonts
		============================================ -->		
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>
		<!-- Bootstrap CSS
		============================================ -->		
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap CSS
		============================================ -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- owl.carousel CSS
		============================================ -->
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="css/owl.theme.css">
        <link rel="stylesheet" href="css/owl.transitions.css">
        <!-- nivo slider CSS
		============================================ -->
		<link rel="stylesheet" href="lib/css/nivo-slider.css" type="text/css" />
		<link rel="stylesheet" href="lib/css/preview.css" type="text/css" media="screen" />
		<!-- animate CSS
		============================================ -->
        <link rel="stylesheet" href="css/animate.css">
		<!-- meanmenu CSS
		============================================ -->
        <link rel="stylesheet" href="css/meanmenu.min.css">
        <!-- Image Zoom CSS
		============================================ -->
        <link rel="stylesheet" href="css/img-zoom/jquery.simpleLens.css">
		<!-- normalize CSS
		============================================ -->
        <link rel="stylesheet" href="css/normalize.css">
		<!-- main CSS
		============================================ -->
        <link rel="stylesheet" href="css/main.css">
		<!-- style CSS
		============================================ -->
        <link rel="stylesheet" href="style.css">
		<!-- responsive CSS
		============================================ -->
        <link rel="stylesheet" href="css/responsive.css">

        <link rel="stylesheet" href="css/checkoutCodes/fontawesome-stars.css">
        <link rel="stylesheet" href="css/checkoutCodes/checkoutstyle.css">
		<!-- modernizr JS
		============================================ -->		
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

    </head>

    <body>

        <!-- Start Rimu Navbar Area -->
		<?php include_once("header.php"); ?>
		<!-- End Sidebar Modal -->

		<!-- page-title -->
        <div class="breadcrumbs">
            <div class="container">
                <div class="container-inner">
                    <ul>
                        <li class="home">
                            <a href="/">Home</a>
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </li>
                        <li class="home-two">
                            <a href="#.">Checkout</a>
                            <span>
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </li>
                    </ul>
                    <div class="page-title">
                        <h1>Checkout</h1>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- Start Checkout Area -->
		<section class="checkout-area ptb-100">
            
		<div id="checkoutview">
            <div class="checkout-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <form action="javascript:void(0)">
                                <div class="checkbox-form billing-details">                     
                                    <h4 class="text-center">Billing Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Country <span class="required">*</span></label>
                                                <div class="select-box">
                                                    <select class="form-control" name="country"  id="country" required>
                                                        <?php
                                                            $callCountry = "SELECT * from countries";
                                                            $run_query = mysqli_query($connect, $callCountry);
                                                            confirm_query($run_query);
                                                            while ($rowItem = mysqli_fetch_assoc($run_query)) {
                                                        ?>
                                                        <option value="<?php echo $rowItem['country_name']; ?>"><?php echo $rowItem['country_name']; ?></option>
                                                        <?php } // end while loop?>
                                                        
                                                    </select>
                                                </div>                                       
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="fname">First Name <span class="required">*</span></label>                                       
                                                <input type="text" class="form-control" placeholder="First Name" name="fname" id="fname" required />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="lname">Last Name <span class="required">*</span></label>                                        
                                                <input type="text" class="form-control" placeholder="Last Name" name="lname" id="lname" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label for="address">Address <span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="Street address" name="address" id="address" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">                                    
                                                <input type="text" class="form-control" placeholder="Apartment, suite, unit etc. (optional)" name="addsuite" id="addsuite" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label for="townCity">Town / City <span class="required">*</span></label>
                                                <input type="text" class="form-control" placeholder="Town / City" name="townCity" id="townCity" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="state">State <span class="required">*</span></label>                                        
                                                <input type="text" class="form-control" placeholder="state" name="state" id="state" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="postzip">Postcode / Zip <span class="required">*</span></label>                                     
                                                <input type="text" class="form-control" placeholder="Postcode / Zip" name="postzip" id="postzip" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="email">Email Address <span class="required">*</span></label>                                        
                                                <input type="email" class="form-control" placeholder="Email" name="email" id="email" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="checkout-form-list">
                                                <label for="phone">Phone  <span class="required">*</span></label>                                       
                                                <input type="text" class="form-control" placeholder="Phone" name="phone" id="phone" required/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Order Notes</label>
                                                <textarea id="checkoutmess" name="checkoutmess" cols="30" rows="10"  placeholder="Notes about your order, e.g. special notes for delivery." ></textarea>
                                            </div>                                  
                                        </div>
                                    </div>                                                  
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive" >
                                    <?php 
                                        $total = 0;
                                        $total2 = 0;
                                        global $connect;
                                        $ip = getIp();
                                        $sel_price = "SELECT * from cart where ip_add='$ip'";
                                        $run_price = mysqli_query($connect, $sel_price);

                                        $rowforcart = mysqli_num_rows($run_price);

                                        if ($rowforcart == 0) {
                                            echo "<h4 style='border: 1px solid red;  padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center;' id='yourorder'>Your Cart is EMPTY.</h4>";
                                        }else{ ?>

                                        <table id="yourorder">
                                            <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>                           
                                            </thead>
                                            <tbody>
                                                <?php 
                                                    while ($p_price = mysqli_fetch_array($run_price)) {
                                                    $pro_id = $p_price['p_id'];
                                                    $gun_price2 = array($p_price['new_price']);
                                                    $values2 = array_sum($gun_price2);
                                                    $total2 += $values2;

                                                    $pro_price = "SELECT * from pillshome where prod_id='$pro_id'";
                                                    $run_pro_price = mysqli_query($connect, $pro_price);
                                                    while ($pp_price = mysqli_fetch_array($run_pro_price)) {
                                                    $gun_price = array($pp_price['new_price']);
                                                    $values = array_sum($gun_price);
                                                    $total += $values;
                                                ?>
                                                <tr class="cart_item">
                                                    <td class="product-name">
                                                        <?php echo $pp_price['prodname']; ?> <strong class="product-quantity"> (<?php echo $p_price['qty'];?>)</strong>
                                                    </td>
                                                    <td class="product-total">
                                                        <span class="amount">$<?php echo $p_price['new_price'];?></span>
                                                    </td>
                                                </tr>
                                                <?php } } ?>
                                            </tbody>
                                            <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Cart Subtotal</th>
                                                    <td><span class="amount">$<?php echo $total2;?></span></td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>Shipping</th>
                                                    <td>
                                                        Shipping is mostly *FREE. Based on your location, shipping cost will be estimated after your order has been approved!
                                                                
                                                    </td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Order Total</th>
                                                    <td><strong><span class="amount">$<?php echo $total2;?></span></strong>
                                                    </td>
                                                </tr>                               
                                            </tfoot>
                                        </table>    

                                    <?php } ?>
                                </div>
                                <div class="payment-method" id="payment-method">
                                    <h6>Please "SELECT" one of the payment methods below, and follow the subsequent instructions.</h6>
                                    <p>Please note that you will not be billed until after your order has been approved.</p>
                                    <p id="notselectedpay"></p>
                                    <div class="payment-accordion">
                                    <!-- ACCORDION START -->
                                    <!-- <h3>Western Union <img src="img/WU-1.png" alt="Western Union" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="western" value="WesternUnion" style="padding:10px; width:20px; height:20px;" class="paymentopt" required /><span> Pay Using Western Union</span>
                                        </div>
                                        <p id="paytoValuew" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div> -->
                                    <!-- ACCORDION END -->  
                                    <!-- ACCORDION START -->
                                    <!-- <h3>MoneyGram <img src="img/MG-1.png" alt="MoneyGram" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="moneyG" value="MoneyGram" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/><span> Pay Using moneyGram</span>
                                        </div>
                                        <p id="paytoValuem" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div> -->
                                    <!-- ACCORDION END -->
                                    <!-- ACCORDION START -->
                                    <h3>Pay with Zelle(US Clients Only!) <img src="img/Zelle_logo.jpg" alt="payment option" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="zelle" value="Zelle" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/>
                                          <span> Pay with Zelle(US Clients Only!)</span>
                                        </div>
                                        <p id="paytoValuez" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div>
                                    <!-- ACCORDION END --> 
                                    <!-- ACCORDION START -->
                                    <h3>Bitcoin <img src="img/BTC-1.png" alt="Bitcoin" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="bitcoin" value="Bitcoin" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/><span> Pay Using Bitcoin</span>
                                        </div>
                                        <p id="paytoValueb" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div>
                                    <!-- ACCORDION END -->   
                                     <!-- ACCORDION START -->
                                    <h3>Pay Using Paypal <img src="img/paypal.png" alt="paypal" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="paypal" value="PayPal" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/><span> Pay Using Paypal</span>
                                        </div>
                                        <p id="paytoValuep" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div>
                                    <!-- ACCORDION END -->  
                                     
                                    
                                    <!-- ACCORDION START -->
                                    <h3>Cash App <img src="img/cashapp.png" alt="Cash App" /></h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list">
                                            <input type="radio" name="paymentopt" id="cashapp" value="CashApp" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/><span> Pay Using your Cash App</span>
                                        </div>
                                        <p id="paytoValueh" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div>
                                    <!-- ACCORDION END -->
                                    <h3>Bank Wire Transfer T/T</h3>
                                    <div class="payment-content">
                                        <div class="checkout-form-list form-group">
                                            <input type="radio" name="paymentopt" id="bankt" value="bankt" style="padding:10px; width:20px; height:20px;" class="paymentopt" required/><span> Pay Using a Bank Wire Transfer T/T</span>
                                        </div>
                                        <p id="paytoValuebt" style="padding: 0px 10px; border:1px solid green;"></p>
                                    </div>
                                    <!-- ACCORDION END -->                                   
                                    </div>
                                    <div class="entry-header-area" id="checkplaceorder2"></div>
                                    <div class="order-button-payment">
                                        <button value="Place order" name="placeorder" id="placeorder">Place order</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		</section>
		<!-- End Checkout Area -->
       
		<!-- Start Footer Top Area -->
		<?php include_once("footer.php"); ?>
		<!-- End Go Top Area -->

		
		 <!-- Javascript -->

        <!-- jquery
		============================================ -->		
        <script src="js/vendor/jquery-1.11.3.min.js"></script>
		<!-- bootstrap JS
		============================================ -->		
        <script src="js/bootstrap.min.js"></script>
		<!-- wow JS
		============================================ -->		
        <script src="js/wow.min.js"></script>
		<!-- price-slider JS
		============================================ -->		
        <script src="js/jquery-price-slider.js"></script>
        <!-- Img Zoom js -->
		<script src="js/img-zoom/jquery.simpleLens.min.js"></script>
		<!-- meanmenu JS
		============================================ -->		
        <script src="js/jquery.meanmenu.js"></script>
		<!-- owl.carousel JS
		============================================ -->		
        <script src="js/owl.carousel.min.js"></script>
		<!-- scrollUp JS
		============================================ -->		
        <script src="js/jquery.scrollUp.min.js"></script>
		<!-- Nivo slider js
		============================================ --> 		
		<script src="lib/js/jquery.nivo.slider.js" type="text/javascript"></script>
		<script src="lib/home.js" type="text/javascript"></script>
		<!-- plugins JS
		============================================ -->		
        <script src="js/plugins.js"></script>
		<!-- main JS
		============================================ -->		
        <script src="js/main.js"></script>
        <script src="css/checkoutCodes/jquery.collapse.js"></script>
        <script src="css/checkoutCodes/checkoutjs.js"></script>
    <!-- Javascript end -->
    </body>
</html>
    <script type="text/javascript">
        $(document).ready(function(){

            $("#western").on('click', function(){
                var western = $('#western').val();
                // var addedprice = $('addedprice').val();
                if (western) {

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':western},
                        success:function(html){
                            $('#paytoValuew').html(html);
                            $('#paytoValuem').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValuew').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuew').html("Nothing, please try again.");
                }
            });

            $("#moneyG").on('click', function(){
                var moneyG = $('#moneyG').val();
                console.log(moneyG);
                // var addedprice = $('addedprice').val();
                if(moneyG){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':moneyG},
                        success:function(html){
                            $('#paytoValuem').html(html);
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValuem').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuem').html("Nothing, please try again.");
                }
            });


            $("#paypal").on('click', function(){
                var paypal = $('#paypal').val();

                console.log(paypal);
                // var addedprice = $('addedprice').val();
                if(paypal){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':paypal},
                        success:function(html){
                            $('#paytoValuep').html(html);
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValuep').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuep').html("Nothing, please try again.");
                }
            });


            $("#bitcoin").on('click', function(){
                var bitcoin = $('#bitcoin').val();
                console.log(bitcoin);
                // var addedprice = $('addedprice').val();
                if(bitcoin){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':bitcoin},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html(html);
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValueb').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValueb').html("Nothing, please try again.");
                }
            });

            $("#agiftcard").on('click', function(){
                var agiftcard = $('#agiftcard').val();
                // var addedprice = $('addedprice').val();
                if(agiftcard){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':agiftcard},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html(html);
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValuea').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuea').html("Nothing, please try again.");
                }
            });

            $("#zelle").on('click', function(){
                var zelle = $('#zelle').val();
                console.log(zelle);
                // var addedprice = $('addedprice').val();
                if(zelle){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':zelle},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html(html);
                            $('#paytoValueh').html('');
                        }
                    });
                    $('#paytoValuez').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                    console.log(zelle);
                }else{
                    $('#paytoValuez').html("Nothing, please try again.");
                }
            });

            $("#cashapp").on('click', function(){
                var cashapp = $('#cashapp').val();
                console.log(cashapp);
                // var addedprice = $('addedprice').val();
                if(cashapp){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':cashapp},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html(html);
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValueh').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValueh').html("Nothing, please try again.");
                }
            });
            
            $("#bankt").on('click', function(){
                var bankt = $('#bankt').val();
                console.log(bankt);
                // var addedprice = $('addedprice').val();
                if(bankt){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':bankt},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html('');
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html(html);
                        }
                    });
                    $('#paytoValuebt').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuebt').html("Nothing, please try again.");
                }
            });

            $("#ccard").on('click', function(){
                var ccard = $('#ccard').val();
                // var addedprice = $('addedprice').val();
                if(ccard){

                    $.ajax({
                        type: 'POST',
                        url : 'ajaxprocessor.php',
                        data: {'paymentopt':ccard},
                        success:function(html){
                            $('#paytoValuem').html('');
                            $('#paytoValuew').html('');
                            $('#paytoValueb').html('');
                            $('#paytoValuea').html('');
                            $('#paytoValuec').html(html);
                            $('#paytoValuep').html('');
                            $('#paytoValuez').html('');
                            $('#paytoValueh').html('');
                            $('#paytoValuebt').html('');
                        }
                    });
                    $('#paytoValuec').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                }else{
                    $('#paytoValuec').html("Nothing, please try again.");
                }
            });

            $("#placeorder").on('click', function(){
                var placeorder = $('#placeorder').val();
                var yourorder      = $('#yourorder').html();
                if(placeorder && yourorder!=="Your Cart is EMPTY."){

                    // console.log(yourorder);

                    var emptyElements = $('#formID4').find('input').filter(function() { 

                        var isEmpty = $(this).val() == '';
                        var isEmptypay = $( "input:checked" ).length;

                        if (isEmpty && isEmptypay ==0) {

                            $('#' +this.id).css({
                                'border': '1px solid red'
                            });

                            $('#notselectedpay').css({
                                'border': '1px solid red',
                                'text-align': 'center',
                                'padding': '3px 1px',
                                'transition': 'all 0.9s ease 0s'
                            });

                            $('#notselectedpay').html("Please Select a payment method.");
                        }
                            
                        var notEmpty = $(this).val() != '';
                        var notEmptypay = $( "input:checked" ).length;
                        if (notEmpty && notEmptypay!=0) {

                            $('#' +this.id).css({
                                'border': '1px solid green'
                            });

                            $('#notselectedpay').css({
                                'border': '1px solid green',
                                'text-align': 'center',
                                'padding': '3px 1px',
                                'transition': 'all 0.9s ease 0s'
                            });

                            $('#notselectedpay').html("Payment method Selected.");

                        }

                        return notEmpty;

                        return isEmpty;
                    });

                    var country        = $('#country').val();
                    var fname          = $('#fname').val();
                    var lname          = $('#lname').val();
                    var address        = $('#address').val();
                    var addsuite       = $('#addsuite').val();
                    var townCity       = $('#townCity').val();
                    var state          = $('#state').val();
                    var postzip        = $('#postzip').val();
                    var email          = $('#email').val();
                    var phone          = $('#phone').val();
                    var checkoutmess   = $('#checkoutmess').val();

                    var yourorder      = $('#yourorder').html();

                    // var western = $('#western').val();

                    var payoptchecked = $( "input:checked" ).val();

                    if (payoptchecked == 'WesternUnion') {

                        var paytoValue = $('#paytoValuew').html();

                        var confirmForm = $( "input:checked" ).length;

                        
                    }else if (payoptchecked == 'MoneyGram') {

                        var paytoValue = $('#paytoValuem').html();

                        var confirmForm = $( "input:checked" ).length;

                        

                    }else if (payoptchecked == 'PayPal') {

                        var paytoValue = $('#paytoValuep').html();

                        var confirmForm = $( "input:checked" ).length;

                        

                    }else if (payoptchecked == 'Agiftcard') {

                        var paytoValue = $('#paytoValuea').html();

                        var confirmForm = $( "input:checked" ).length;

                    
                    }else if (payoptchecked == 'Zelle') {

                        var paytoValue = $('#paytoValuez').html();

                        var confirmForm = $( "input:checked" ).length;


                    }else if (payoptchecked == 'CashApp') {

                        var paytoValue = $('#paytoValueh').html();

                        var confirmForm = $( "input:checked" ).length;
    

                    }else if (payoptchecked == 'Bitcoin') {

                        var paytoValue = $('#paytoValueb').html();

                        var confirmForm = $( "input:checked" ).length;

                        
                    }else if (payoptchecked == 'bankt') {

                        var paytoValue = $('#paytoValuebt').html();

                        var confirmForm = $( "input:checked" ).length;

                        
                    }else if (payoptchecked == 'CreditCard') {

                        var owner       = $('#owner').val();
                        //var cardNumber  = $('#cardNumber').val();
                        //var cvv         = $('#cvv').val();
                    // var monthcard   = $('#monthcard').val();
                    // var yearcard    = $('#yearcard').val();

                        var confirmForm = $( "input:checked" ).length;

                        if (confirmForm!==0 && email!=='' && yourorder !== 'Your Cart is EMPTY.') {
                            
                            $.ajax({
                                method: 'POST',
                                url : 'completeorder.php',
                                data: {'country':country, 'fname':fname, 'lname':lname, 'address':address, 'addsuite':addsuite, 'townCity':townCity, 'state':state, 'postzip':postzip, 'email':email, 'phone':phone, 'checkoutmess':checkoutmess, 'yourorder':yourorder, 'owner':owner},
                                success:function(html){
                                    $('#checkoutview').html(html);
                                }
                            });
                            $('#checkplaceorder2').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                        }else {

                            // $('#checkplaceorder').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY.</div>");

                            $('#checkplaceorder').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY and Card Details are Right.</div>");

                            $('#checkplaceorder2').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY and Card Details are Right.</div>");

                            // $('#checkplaceorder2').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY.</div>");
                        }
                    }

                    if (confirmForm!==0 && email!=='' && yourorder !== 'Your Cart is EMPTY.' && paytoValue) {
                            
                            $.ajax({
                                method: 'POST',
                                url : 'completeorder.php',
                                data: {'country':country, 'fname':fname, 'lname':lname, 'address':address, 'addsuite':addsuite, 'townCity':townCity, 'state':state, 'postzip':postzip, 'email':email, 'phone':phone, 'checkoutmess':checkoutmess, 'yourorder':yourorder, 'paytoValue':paytoValue, 'payoptchecked':payoptchecked},
                                success:function(html){
                                    $('#checkoutview').html(html);
                                }
                            });
                            $('#checkplaceorder2').html("<p style='text-align:center; padding: 20px 5px;'> <img src='icon-loading.gif' /> </p>");
                        }
                        else {

                            $('#checkplaceorder').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY.</div>");

                            $('#checkplaceorder2').html("<div class='alert' style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'><button type='button' class='close' data-dismiss='alert'>×</button>Please, Correct all errors! Also make sure CART is NOT EMPTY.</div>");
                        }
                    
                }else{
                    $('#checkplaceorder2').html("<h5 style='border: 1px solid red; padding: 5px 5px; transition: all 0.9s ease 0s; text-align: center; color:red;'>Please, Correct all errors! Make sure CART is NOT EMPTY.</h5>");   
                }
            });

        });
    </script>