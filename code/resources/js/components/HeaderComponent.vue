<template>


	<div id="top-bar-wrapper" class="clearfix"><!-- top bar start -->
		<div id="top-bar" itemscope >
			<div id="topleft-widget-area" class="clearfix">
				<div id="text-16" class="widget widget_text">
					<div class="textwidget">
						<i class="fa fa-phone" style="font-size:18px; padding-right:15px;"></i> <strong>Main Line:</strong> (800) 202-555-0120
					</div>
				</div>
				<div id="text-18" class="widget widget_text">
					<div class="textwidget">
						<i class="fa fa-phone" style="font-size:18px; padding-right:15px;"></i> <strong>Appointments:</strong> 202-555-0154
					</div>
				</div>

				<div id="text-19" class="widget widget_text">
					<div class="textwidget">
						<i class="fa fa-phone" style="font-size:18px; padding-right:15px;"></i> <strong>Information:</strong> 202-555-0117
					</div>

				</div>

			</div>


			<div id="topright-widget-area" class="clearfix">
				<div id="nav_menu-2" class="widget widget_nav_menu">
					<div class="menu-top-bar-container">
						<ul id="menu-top-bar" class="menu">
							<li id="menu-item-644" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-644">
								<a href="#">Login As</a>

								<ul class="sub-menu">

									<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-641">
										<a href="{{ url('/login') }}" target="_blank">Administrator</a>
									</li>

									<li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-642">
										<a href="{{ url('/distributer/login') }}" target="_blank">Distributer</a>
									</li>


								</ul>

							</li>

						</ul>
					</div>
				</div>
			</div>

		</div>
	</div><!-- top bar end -->
	
		
	<header id="mobile-site-header" class="mobile-header"><!-- mobile header start -->
		<div id="mobile-site-logo">

			<a href="index.html">
				<img src="{{ asset('theme-script/images/logo-89.png') }}" width="200" height="100" alt="Medical Center" class="default-logo" />
				<img src="{{ asset('theme-script/images/logo-89.png') }}" width="200" height="100" alt="Medical Center" class="retina-logo" />
			</a>

		</div>
		
		<a href="#mobile-site-navigation" class="toggle-mobile-menu"><i class="fa fa-bars"></i></a>
	</header><!-- mobile header end -->
	
	
	<header id="site-header" class="header-style-default" itemscope ><!-- header start -->
		<div id="header-wrapper">
			<div id="header-container" class="clearfix">
				<div id="site-logo"><!-- logo start -->
					<a href="/">
						<img src="{{ asset('theme-script/images/logo-89.png') }}" width="200" height="100" alt="Medical Center" class="default-logo" />
						<img src="{{ asset('theme-script/images/logo-89.png')}}" width="200" height="100" alt="Medical Center" class="retina-logo" />
					</a>
				</div><!-- logo end -->
				
				<div id="site-navigation" class="" itemscope itemtype="../../../schema.org/SiteNavigationElement.html">
					<nav id="primary-navigation" class="menu-container">
						<ul id="menu-main-menu" class="menu">
							<li id="menu-item-620" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-107 current_page_item menu-item-620">
								<a href="index.html">Home</a>
							</li>

							<li id="menu-item-663" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-663">
								<a href="about-us/index.html">About Us</a>
							</li>

							<li id="menu-item-761" class="megamenu columns-4 menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-761">
								<a href="medical-services/index.html">Medical Services</a>

								<ul class="sub-menu">

									<li id="menu-item-764" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-764">
										<a>Orthopedic</a>

										<ul class="sub-menu">

											<li id="menu-item-763" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-763">
												<a href="medical-services/bone-joint-care/index.html">Bone &#038; Joint Care</a>
											</li>

											<li id="menu-item-762" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-762">
												<a href="medical-services/spine-care/index.html">Spine Care</a>
											</li>

											<li id="menu-item-807" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-807">
												<a href="medical-services/joint-replacement/index.html">Joint Replacement</a>
											</li>

											<li id="menu-item-806" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-806">
												<a href="medical-services/sports-medicine/index.html">Sports Medicine</a>
											</li>

										</ul>

									</li>

									<li id="menu-item-777" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-777">
										<a>Digestive Diseases</a>

										<ul class="sub-menu">

											<li id="menu-item-791" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-791">
												<a href="medical-services/appendicitis/index.html">Appendicitis</a>
											</li>

											<li id="menu-item-823" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-823">
												<a href="medical-services/lactose-intolerance/index.html">Lactose Intolerance</a>
											</li>

											<li id="menu-item-822" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-822">
												<a href="medical-services/pancreatitis/index.html">Pancreatitis</a>
											</li>

											<li id="menu-item-821" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-821">
												<a href="medical-services/celiac-disease/index.html">Celiac Disease</a>
											</li>

										</ul>

									</li>

									<li id="menu-item-778" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-778">
										<a>Heart &#038; Vascular Care</a>

										<ul class="sub-menu">

											<li id="menu-item-792" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-792">
												<a href="medical-services/cardilogy/index.html">Cardilogy</a>
											</li>

											<li id="menu-item-852" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-852">
												<a href="medical-services/vascular-care/index.html">Vascular Care</a>
											</li>

											<li id="menu-item-850" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-850">
												<a href="medical-services/cardiac-surgery/index.html">Cardiac Surgery</a>
											</li>

											<li id="menu-item-851" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-851">
												<a href="medical-services/electrophysiology/index.html">Electrophysiology</a>
											</li>

										</ul>

									</li>

									<li id="menu-item-779" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-779">
										<a>Women &#038; Children</a>

										<ul class="sub-menu">

											<li id="menu-item-790" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-790">
												<a href="medical-services/pregnancy/index.html">Pregnancy</a>
											</li>

											<li id="menu-item-841" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-841">
												<a href="medical-services/pediatric-services/index.html">Pediatric Services</a>
											</li>

											<li id="menu-item-840" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-840">
												<a href="medical-services/gynecology/index.html">Gynecology</a>
											</li>

											<li id="menu-item-839" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-839">
												<a href="medical-services/genetic-testing/index.html">Genetic Testing</a>
											</li>

										</ul>

									</li>

								</ul>

							</li>

							<li id="menu-item-714" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-714">
								<a href="meet-our-doctors/index.html">Doctors</a>

								<ul class="sub-menu">

									<li id="menu-item-672" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-672"><a href="meet-our-doctors/index.html">Meet Our Doctors</a></li>

									<li id="menu-item-705" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-705"><a href="general-practitioners/index.html">General Practitioners</a></li>

									<li id="menu-item-706" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-706"><a href="surgeons/index.html">Surgeons</a></li>

									<li id="menu-item-704" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-704"><a href="neurologists/index.html">Neurologists</a></li>

									<li id="menu-item-707" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-707"><a href="cardiologist/index.html">Cardiologists</a></li>

									<li id="menu-item-673" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-673"><a href="doctor-profile/index.html">Doctor Profile</a></li>

								</ul>

							</li>

							<li id="menu-item-634" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-634">
								<a href="news/index.html">News</a>
							</li>

						</ul>


					</nav><!-- nav end -->

					<div class="site-links menu-float-right"><!-- site link start -->

						<div class="header_cart_wrapper"><!-- cart section start -->
							<a href="cart/index.html" title="View your shopping cart" class="header_cart_link" >
								<span class="header_cart_button">
									<i class="fa fa-shopping-bag"></i>
								</span>
							</a>
							<div class="header_cart_widget">
								<div class="widget woocommerce widget_shopping_cart">
									<div class="widget_shopping_cart_content"></div>
								</div>
							</div>
						</div><!-- cart section end -->
																					
						<button class="toggle-header-search search_button" type="button">
							<i class="fa fa-search"></i>
						</button>
																
					</div><!-- site link end -->
				
					<nav id="secondary-navigation" class="menu-container-2 menu-float-right">
						<ul id="menu-secondary-menu" class="menu">
							<li id="menu-item-649" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-649">
								<a href="shop/index.html">Shop Online</a>
							</li>

							<li id="menu-item-647" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-647">
								<a href="contact-us/index.html">Contact Us</a>
							</li>

						</ul>
					</nav>
				</div><!-- #site-navigation -->
												

				<div class="header-search"><!-- search sec start -->
					<div class="searchform-wrapper">
						<form method="get" class="searchform" action="">
							<input onfocus="this.value=''" onblur="this.value='Type and hit enter to search ...'" type="text" value="Search..." name="s" class="search-input" />
						</form>
					</div>
					<div class="toggle-header-search">
						<span></span>
						<span></span>
					</div>
				</div><!-- search sec end -->
				
			</div><!-- #header-container -->
		</div><!-- #header-wrapper -->	
	</header><!-- #site-header -->




</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>