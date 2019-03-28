<?php
/*
*
* Initialises menu and all metaboxes needed for the plugin to work.
*
*/


/**
 *
 * Adds sub-menu admin page to Settings->Dark Site
 *
 */
function dx_add_menu_page() {
    add_options_page(__('Dark Site','dark_site'), __('Dark Site','dark_site'), 'manage_options', 'dxettings', 'dx_settings_page');
}
add_action('admin_menu', 'dx_add_menu_page');


function dx_settings_page() {

    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    $hidden_field_name = 'dx_submit_hidden';
    $opt_name_redirect = 'dx_redirect_to';
    $data_field_name_redirect = 'redirect_to';

    $opt_name_banner = 'dx_banner'; 
    $data_field_name_banner = 'darksite_banner';

    $opt_val_redirect = get_option( $opt_name_redirect );
    $opt_val_banner = get_option( $opt_name_banner );

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        $opt_val_redirect = $_POST[ $data_field_name_redirect ];
        $opt_val_banner = $_POST[  $data_field_name_banner ];

        update_option( $opt_name_redirect, $opt_val_redirect );
        update_option( $opt_name_banner, $opt_val_banner );
?>
<div class="updated"><p><strong><?php _e('settings saved.', 'dark_site' ); ?></strong></p></div>
<?php } ?>

<div class="wrap">
	<h2><?php _e( 'Dark Site', 'dark_site' ); ?></h2>
	<form name="form1" method="post" action="">
		<input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
		<h3> <?php _e( 'REDIRECTION', 'dark_site' ); ?></h3>
		<p><?php _e("Redirect to:", 'dark_site' ); ?> 
			<input type="text" name="<?php echo $data_field_name_redirect; ?>" value="<?php echo $opt_val_redirect; ?>" size="20">
		</p><hr />
		<h3> <?php _e( 'BANNER', 'dark_site' ); ?></h3>
		<p><?php _e("Banner Content", 'dark_site' ); ?> 
			<input type="text" name="<?php echo $data_field_name_banner; ?>" value="<?php echo  $opt_val_banner; ?>" size="20">
		</p>

		<p class="submit">
			<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
		</p>
	</form>
</div>

<?php

}