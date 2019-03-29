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


/**
 *
 * Adds the settigns fields and saves the data of them to wp_options table
 *
 */

function dx_settings_page() {

    if (!current_user_can('manage_options'))
    {
      wp_die( __('You do not have sufficient permissions to access this page.') );
    }

    $hidden_field_name = 'dx_submit_hidden';
    $opt_name_redirect = 'dx_redirect_to';
    $data_field_name_redirect = 'redirect_to';

    $editor_content = '';
    $editor_id = 'dx_my_editor';

    $opt_val_redirect = get_option( $opt_name_redirect );

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ) {
        $opt_val_redirect = $_POST[ $data_field_name_redirect ];
        $editor_content = $_POST['dx_my_editor'];

        $sanitized_content = sanitize_text_field( htmlentities($_POST['dx_my_editor']) );

        update_option( $opt_name_redirect, $opt_val_redirect );
        update_option( $editor_id, $sanitized_content );
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
        <p>
            <?php  wp_editor( $editor_content, $editor_id ); ?>
        </p>
		<p class="submit">
            <?php submit_button( 'save' ); ?>
		</p>
	</form>
</div>

<?php

}