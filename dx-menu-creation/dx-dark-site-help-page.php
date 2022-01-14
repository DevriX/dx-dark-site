<div class="dx-help-page">
	<header class="help-header">
		<h2 class="logo"><img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/devrix-logo-white.svg'; ?>" alt="" /></h2><!-- .logo -->
		<div class="page-info">
			<h3 class="page-title">Documentation</h3><!-- .page-title -->
			<h4 class="page-subtitle">DX Dark Site</h4><!-- .page-subtitlr -->
		</div><!-- .info -->
	</header><!-- .help-header -->

	<section class="section-primary">

		<div class="panel-content">
			<heading class="help-heading">
				<h1 class="help-title">Welcome to <b>DX Dark Site</b> help page</h1><!-- .help-title -->
				<p class="help-subtitle"><b>DX Dark Site</b> is a simple plugin used for redirections or displaying banner with informational messages...</p><!-- .help-subtitle -->
			</heading><!-- .help-heading -->

			<div class="featured-columns">
				<div class="column">
					<div class="inner red">
						<h2 class="column-title">What is this plugin?</h2><!-- .column-titlr -->
						<p>Unfortunately, sometimes features of a site are not working propperly- pages are not loading, payment systems are not working, etc.
						We created this plugin with the idea of dealing with emergencies on the site, by keeping your site private to logged users or informing
						the visitors that the site is not fully functional.</p>
					</div><!-- .inner -->
				</div><!-- .column -->

				<div class="column">
					<div class="inner blue">
						<h2 class="column-title">Plugin feature #1</h2><!-- .column-titlr -->
						<p>A redirection field, which when added URL to it will redirect the whole site to the URL for all non-logged users. For example,
						a pre-created page that informs the user that the site is under construction or down.</p>
					</div><!-- .inner -->
				</div><!-- .column -->

				<div class="column">
					<div class="inner green">
						<h2 class="column-title">Plugin feature #2</h2><!-- .column-titlr -->
						<p>A WordPress editor, which renders a bar over the whole site in the header. The bar can have custom content in it or/and a shortcode
						with a countdown timmer. This is added with the idea of informing the visitors that something is not working properly. For example 
						“Sorry, our payment systems are not working for the next [here is the countdown timer]”.</p>
					</div><!-- .inner -->
				</div><!-- .column -->

				<div class="column">
					<div class="inner orange">
						<h2 class="column-title">Plugin feature #3</h2><!-- .column-titlr -->
						<p>A WordPress editor, which renders a bar over the whole site in the header. The bar can have custom content in it and a shortcode
						with a countdown timmer for redirection. This is added with the idea of informing the visitors that something will happen after the time expires. For example 
						“Sorry, the service is not available right now, you will be redirected to support page after 30 seconds[it is countdown]”.</p>
					</div><!-- .inner -->
				</div><!-- .column -->

			</div><!-- .three-columns -->

			<div class="main-content">
				<h2>More information about DX Dark Site</h2>
				<p>
					Our plugin<strong> DX Dark Site </strong> will help you to deal with emergencies on the site, by 
					keeping your site private to logged users, inform the visitors that the site is not fully functional, display notifications
					with countdown banner or redirection banner.
				</p>
				<p>
					Navigate to the "<strong>DX Dark Site</strong>" page:
				</p>

				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image1.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>
					Type in your title, and list down all of your services. Each
					service is identified by title and a cost per item. You can add an
					unlimited number of fields for your form.
					<img src="<?php echo plugins_url( 'img', __FILE__ ); ?>/add-new-service.png" alt="add new service" />
				</p>

				<p>
					So far, so good! Now, let's add the following form to a page:
					<img src="<?php echo plugins_url( 'img', __FILE__ ); ?>/offer-calc-in-page.png" alt="offer calc in page" />
				</p>

				<p>That's right - our <em>[ofc_shortcode offer_slug="your-offer-slug-here"]</em> shortcode would embed your form accordingly. 
				You can place it on the top of the page, or you could style it through the HTML editor, 
				or wrap some text around it, it's up to you.</p>

				<p>
					The unique code for your form is available in the <strong>All Offer Calc</strong> listing:
					<img src="<?php echo plugins_url( 'img', __FILE__ ); ?>images/screenshot-2.png" alt="all offer calc shortcodes" />
				</p>

				<p>
					or in <strong>Single Offer</strong> view:<br/>
					<img src="<?php echo plugins_url( 'img', __FILE__ ); ?>images/screenshot-1.png" alt="single offer calc shortcodes" />
				</p>


				<p>Did we mention that you could add several forms to your site as well? Yes, you could! You could create a bunch of pages 
				with different forms, different services and costs. Whether it's related to different products or services, or you want 
				a hidden page with discounted prices - it's up to you, it's all possible here!</p>

				<p>
					Additionally, you could place your form in the sidebar from the widget section, just navigate to 
					<strong>Appearance</strong> -> <strong>Widgets</strong> and drag your <strong>Offer Calc Widget</strong> to the desired widget area. <br/>
					<img src="<?php echo plugins_url( 'img', __FILE__ ); ?>/offer-calc-widgets.png" alt="offer calc widgets"/>
				</p>

				<p>And that's a sample page with a form on a random page.</p>

				<p>
				Our beta <a href="<?php //echo OFFER_CALC_PRO_SITE_URL; ?>" title="Offer Calc" target="_blank">premium version</a> includes a number of awesome features, 
				including:
				</p>

				<ul>
					<li>email the form inquiry to you</li>
					<li>store each inquiry in the WordPress admin area</li>
					<li>automatically pay for the required service</li>
					<li>sign up each inquiry to your mailing list</li>
				</ul>


				<div class="dx-help-footer">
					<h3>And much more</h3>

					<p>Follow us on <a href="https://twitter.com/wpdevrix" target="_blank">Twitter</a> and <a href="https://www.facebook.com/DevriXShop/" target="_blank">Facebook</a></p>
					<p class="info-bar"><em>Check out our <a href="https://wordpress.org/support/plugin/offer-calc" target="_blank">Support forum</a> if you need help or if you have any questions about the plugin</em></p>

					<footer class='dx-footer'>
						<div class="signup-banner">
							<a href="http://devrix.com/shop/subscribe/" target="_blank">
								<img class='footer-banner' src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/dx-help-banner.png'; ?>" alt="WordPress help">
							</a>
						</div>
					</footer>
				</div><!-- .dx-help-footer -->

			</div><!-- .main-content -->

		</div><!-- .panel-content -->
		<aside class="panel-sidebar">
			<h2 class="widget-heading">Other DevriX Plugins</h2><!-- .widget-heading -->
			<div class="plugins-list">
				<a class="item" href="https://wordpress.org/plugins/dx-out-of-date/" target="_blank">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/out-of-date.png'; ?>" alt="" />
					<div class="content">
						<strong>DX Out of Date</strong>
						<p>DX Out of Date allows you<br/> to display a notification<br/> box on your posts<br/> when a given amount<br/> of time has passed.</p>
					</div><!-- .content -->
				</a>

				<a class="item" href="https://wordpress.org/plugins/dx-share-selection/" target="_blank">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/share-selection.png'; ?>" alt="" />
					<div class="content">
						<strong>DX Share Selection</strong>
						<p>Allows you to<br/> share/search selected<br/> text from your site -<br/> select a snippet, search<br/> for it or share it to<br/> popular social networks.</p>
					</div><!-- .content -->
				</a>

				<a class="item" href="https://wordpress.org/plugins/easy-image-gallery/" target="_blank">
					<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/eig.png'; ?>" alt="" />
					<div class="content">
						<strong>Easy Image Gallery</strong>
						<p>Easily create an image<br/> gallery on your posts,<br/> pages or any <br/>custom post type.</p>
					</div><!-- .content -->
				</a>
			</div><!-- .plugins-list -->
		</aside><!-- .panel-sidebar -->

	</section><!-- .primary -->
</div><!-- .help-page -->
<style type="text/css">
	.main-content img{
		margin-top: 5px;
	}
</style>
<?php

wp_enqueue_style( 'styles', plugin_dir_url( __FILE__ ) . '../assets/css/help-page.css', false, '1.0' );
