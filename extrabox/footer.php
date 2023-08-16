<!-- Entire FOOTER START -->
<footer class="entire_footer">
    <!-- FOOTER-TOP-AREA -->
    <div class="footer_top_area  footer-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="top-border"></div>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <div class="footer_top_single">
                        <i class="fa fa-plane"></i>
                        <h4>Free Shipping on order over $1000</h4>
                        <p>It's time to meet the Muppets on the Muppet Show tonight. And we know Flipper.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <div class="footer_top_single">
                        <i class="fa fa-gift"></i>
                        <h4>unlimited gifts on every order</h4>
                        <p>It's time to meet the Muppets on the Muppet Show tonight. And we know Flipper.</p>
                    </div>
                </div>
                <div class="col-sm-4 col-sm-4 col-xs-12">
                    <div class="footer_top_single">
                        <i class="fa fa-exchange"></i>
                        <h4>100% money back guarantee</h4>
                        <p>It's time to meet the Muppets on the Muppet Show tonight. And we know Flipper.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER-TOP-AREA:END -->
    
    <!-- FOOTER-WIDGET-AREA -->
    <div class="footer-widget">
        <div class="ovelay">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-sm-4 col-xs-12">
                        <div class="widget_logo">
                            <a href="index.html"><img src="extrabox/img/logo/<?= companyD("compLogo"); ?>"alt="<?= $compName; ?>"></a>
                            <ul>
                                <li>
                                    <div class="wl_left">
                                        <i class="fa fa-location-arrow"></i>
                                    </div>
                                    <div class="wl_right">
                                        <a href="#"><span>Address :</span> <?= $compEmail = companyD('compAddress'); ?></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="wl_left">
                                        <i class="fa fa-envelope-o"></i>
                                    </div>
                                    <div class="wl_right">
                                        <a href="#"><span>E-mail :</span> <?= $compEmail;?></a>
                                    </div>
                                </li>
                                <li>
                                    <div class="wl_left">
                                        <i class="fa fa-phone"></i>
                                    </div>
                                    <div class="wl_right">
                                        <a href="#"><span>phone :</span> <?= $phoneN[0]; ?></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-2 col-xs-12">
                        <div class="widget_single">
                            <h4><a href="#">My Account</a></h4>
                            <ul>
                                <li><a href="profile.html">My Account</a>
                                </li>
                                <li><a href="wishlist.html">Wishlist</a>
                                </li>
                                <li><a href="cart-page.html">Shopping Cart</a>
                                </li>
                                <li><a href="checkout.html">Checkout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-2 col-xs-12">
                        <div class="widget_single">
                            <h4><a href="#">Information</a></h4>
                            <ul>
                                <li><a href="#">About Our Shop</a>
                                </li>
                                <li><a href="#">Top Seller</a>
                                </li>
                                <li><a href="#">Special Products</a>
                                </li>
                                <li><a href="#">Manufacturers</a>
                                </li>
                                <li><a href="#">Secure Shopping</a>
                                </li>
                                <li><a href="#">Privacy Policy</a>
                                </li>
                                <li><a href="#">Delivery Information</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-2 col-xs-12">
                        <div class="widget_single">
                            <h4><a href="#">Our Support</a></h4>
                            <ul>
                                <li><a href="contact-us.html">Contact Us</a>
                                </li>
                                <li><a href="#">Shipping & Taxes</a>
                                </li>
                                <li><a href="#">Return Policy</a>
                                </li>
                                <li><a href="#">Careers</a>
                                </li>
                                <li><a href="#">Affiliates</a>
                                </li>
                                <li><a href="#">Gift Vouchers</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2 col-sm-2 col-xs-12">
                        <div class="widget_single">
                            <h4><a href="#">Our Services</a></h4>
                            <ul>
                                <li><a href="#">Shipping & Returns</a>
                                </li>
                                <li><a href="#">International Shopping</a>
                                </li>
                                <li><a href="#">Best Customer Support</a>
                                </li>
                                <li><a href="#">Easy Replacement</a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER-WIDGET-AREA:END -->
    
    <!-- FOOTER-AREA -->
    <div class="footer_area">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_text">
                        <p>&copy;<?=date("Y") ?> <a href="/"><?= $compName; ?></a>. All rights reserved</p>
                    </div>
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="footer_right">
                        <ul>
                            <li><a href="#"><img src="images/mc.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/visa.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/crr.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/disco.png" alt="" /></a></li>
                            <li><a href="#"><img src="images/bank.png" alt="" /></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FOOTER-AREA:END -->
</footer>
<!-- Entire FOOTER END -->