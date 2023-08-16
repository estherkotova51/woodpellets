 <!--  HEADER-AREA  -->
 <header class="entire_header">
		<div class="header-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-sm-5">
						<div class="user-menu">
							<ul class="list-unstyled list-inline">

								<li>Welcome to <?= $compName; ?></li>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-sm-7">
						<div class="header-right">
							<ul>
								<li>
									<a href="checkout.html"><img src="images/check.png" alt="#"> Checkout</a>
								</li>
				
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header-area:END -->
		
		<!-- Logo-area -->
		<div class="logo_area">
			<div class="container">
				<div class="row">
					<div class="col-sm-4 col-md-4 col-xs-12">
						<div class="logo">
							<a href="index.html"><img src="extrabox/img/logo/<?= companyD("compLogo"); ?>"alt="<?= $compName; ?>">
							</a>
						</div>
					</div>
					<div class="col-sm-8 col-md-8 col-xs-12">
						<div class="search-area">
							<form>
								<div class="control-group">

									<ul class="categories-filter animate-dropdown">
										<li class="dropdown">

											<a class="dropdown-toggle" data-toggle="dropdown" href="#">All Categories <b class="caret"></b></a>

											<ul class="dropdown-menu" role="menu">
												<?php select_categories()?>


											</ul>
										</li>
									</ul>
									<input class="search-field" placeholder="Search here..." />
									<a class="search-button" href="#"></a>
								</div>
							</form>
						</div>
						<div class="logo_right">
							<span><i class="fa fa-phone"></i></span>
							<a href="tel:<?= $phoneN[0]; ?>">CALL US FREE
								<br/><?= $phoneN[0]; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- LOGO-AREA:END -->
		
		<!-- MENU-AREA -->
		<div class="menu-area">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="categories">
							<ul id="nav">
								<li>Categories <i class="fa fa-bars"></i>
									<ul>
										<li><a href="#"><i class="fa fa-male"></i> Fashion</a> </li>
										<li><a href="#"><i class="fa fa-clock-o"></i> Watches<i class="fa fa-angle-right icon-right"></i></a>
										</li>
										<li><a href="#"><i class="fa fa-home"></i>House Wares  <i class="fa fa-angle-right icon-right"></i></a> </li>
										<li><a href="#"><i class="fa fa-desktop"></i> Desktop & Monitors <i class="fa fa-angle-right icon-right"></i></a>
										</li>
										<li><a href="#"><i class="fa fa-mobile"></i> Smartphones</a> </li>
										<li><a href="#"><i class="fa fa-laptop"></i> Laptop & Tablates <i class="fa fa-angle-right icon-right"></i></a>
										</li>
										<li><a href="#"><i class="fa fa-lightbulb-o"></i> Light & Lamps <i class="fa fa-angle-right icon-right"></i></a>
										</li>
										<li><a href="#"><i class="fa fa-volume-up"></i> Sound & Audio</a>
										</li>
										<li><a href="#"><i class="fa fa-heart-o"></i> Health & Medical</a>
										</li>
										<li><a href="#"><i class="fa fa-wheelchair"></i> Gym Equipments</a>
										</li>
										<li class="last-li"><a href="#">View all categories</a>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-xs-12">
						<nav class="main-menu">
							<ul id="navigation">
								<li class="active"><a href="/">Home</i></a>
				
								</li>
								<li><a href="#">Pages <i class="fa fa-caret-down"></i></a>
									<ul class="drop_nav">
										<li><a href="blog.html">Blog</a></li>
										<li><a href="checkout.html">Checkout</a></li>
										<li><a href="product-list.html">Product list</a></li>
										<li><a href="profile.html">Profile</a></li>
										<li><a href="search-result.html">Search result</a></li>
										<li><a href="single-product.html">Single product</a></li>
										<li><a href="wishlist.html">wishlist</a></li>
										<li><a href="404.html">404</a></li>
									</ul>
								</li>
								<li><a href="about-us.html">About Us</a>
								</li>
								<li><a href="product-list.html">Men</a>
								</li>
								<li><a href="product-list.html">Women</a>
								</li>
								<li><a href="contact-us.html">Contact Us</a>
								</li>
							</ul>
						</nav>
						
						<!-- Mobile Navigation -->
						<div class="only-for-mobile">
							<div class="col-xs-12">
								<ul class="ofm">
									<li class="m_nav"><i class="fa fa-bars"></i> Navigation</li>
								</ul>

								<!-- MOBILE MENU -->
								<div class="mobi-menu">
									<div id='cssmenu'>
										<ul>
											<li class='has-sub'>
												<a href='/'><span>Home</span></a>
				
											</li>
											<li class='has-sub'>
												<a href='#'><span>Pages</span></a>
												<ul class="sub-nav">
													<li><a href="blog.html">Blog</a></li>
													<li><a href="checkout.html">Checkout</a></li>
													<li><a href="product-list.html">Product list</a></li>
													<li><a href="profile.html">Profile</a></li>
													<li><a href="search-result.html">Search result</a></li>
													<li><a href="single-product.html">Single product</a></li>
													<li><a href="wishlist.html">wishlist</a></li>
													<li><a href="404.html">404</a></li>
												</ul>
											</li>
											<li>
												<a href='about-us.html'><span>About Us</span></a>
											</li>
											<li>
												<a href='product-list.html'><span>Men</span></a>
											</li>
											<li>
												<a href='product-list.html'><span>Women</span></a>
											</li>
											<li>
												<a href='contact-us.html'><span>Contact Us</span></a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3 col-xs-12">
						<div class="menu_right">
							<a href="cart-page.html"><i class="fa fa-shopping-cart"></i>My Cart</a>
							<span><?php total_items_in_cart(); ?></span>

						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- MENU-AREA:END -->
	</header>
    <!-- Header-AREA END -->
	