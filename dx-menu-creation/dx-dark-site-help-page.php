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
					By default you are on the first tab - <b>Main</b>, this tab contains the settings for <b>Plugin feature #1</b> and <b>Plugin feature #2</b>:
				</p>

				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image2.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>
					In the first section <b>DX Dark Site Redirection</b>, you will find a redirection field(*1), which when added URL 
					to it will redirect the whole site to the URL for all non-logged users and checkbox(*2), which will enable/disable 
					the feature functionality. For example, a pre-created page that informs the user that the site is under construction
					or down. After finnish with the settings click the <b>Save</b> button at the bottom of the page. Make sure the redirection is enabled.
				</p>

				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image3.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>The second section in the <b>Main</b> tab - <b>DX Countdown Banner</b> contains more elements. The first one - checkbox(*1)
			 	for enabling/disabling the banner functionality, followed by date(*2) and time(*3) pickers,the fourth is а WordPress editor(*4),
				where to add the custom content and the shortcode, the next is input field(*5) for setting margin top from 0-20 and the last one is upload button(*6) for custom image
				uploading.
				</p>

				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image4.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>
					How to work with the shortcode for the DX Countdown banner:
					<li>In the text area insert custom text message and on the position you want to be the countdown timer - add
					<code>[global-counter]</code>. For example "Sorry, our payment systems are not working at the moment.
					Check again after [global-counter]. Thank you!"</li>
					<li>Make sure you have selected <b>Expiry date</b> and <b>Expiry time</b>, or the banner will not be visible.</li>
					<li>After added the setting click on the <b>Save</b> button.</li>
				</p>

				<p>Back-end settings:</p>
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image5.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>Front-end view:</p>
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image6.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>
					In the second tab - <b>Redirection</b> you will find the settings for <b>Plugin feature #3</b>.
					<br>
					The first element on the page - checkbox(*1) for enabling/disabling the banner functionality, followed by input field(*2)
					for redirection URL, where the user will be redirected after time expires, input field(*3) for seconds before redirection,
					the fourth is а WordPress editor(*4), where to add the custom content and the shortcode, the next is input field(*5) for
					setting margin top from 0-20 and the last one is upload button(*6) for custom image uploading.
				</p>

				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image7.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>
					How to work with the shortcode for the DX Redirection banner:
					<li>In the text area insert custom text message and on the position you want to be the countdown timer - add
					<code>[counter]</code>. For example "You will be redirected after [counter]".</li>
					<li>Make sure you have selected enabled the banner from the checkbox, or the banner will not be visible.</li>
					<li>After added the setting click on the <b>Save</b> button.</li>
				</p>

				<p>Back-end settings:</p>
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image8.png'; ?>" alt="" style="border: 5px solid #555"/>

				<p>Front-end view:</p>
				<img src="<?php echo plugin_dir_url( __FILE__ ) . '../assets/images/image9.png'; ?>" alt="" style="border: 5px solid #555"/>

				<div class="dx-help-footer">
					<h3>And much more</h3>

					<p>Follow us on <a href="https://twitter.com/wpdevrix" target="_blank">Twitter</a> and <a href="https://www.facebook.com/DevriXLtd/" target="_blank">Facebook</a></p>
					<p class="info-bar"><em>Check out our <a href="https://wordpress.org/support/plugin/devrix-dark-site/" target="_blank">Support forum</a> if you need help or if you have any questions about the plugin</em></p>
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
