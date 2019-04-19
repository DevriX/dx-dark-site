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
    add_options_page( __('Dark Site','dx_dark_site'), __('Dark Site','dx_dark_site'), 'manage_options', 'dx-darksite-settings', 'dx_settings_page' );
}
add_action( 'admin_menu', 'dx_add_menu_page' );


/**
 *
 * Adds the settigns fields and saves the data of them to wp_options table
 *
 */
function dx_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
      wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    // set all input names as php vars
    $dx_hidden_field_name = 'dx_submit_hidden';
    $dx_name_redirect = 'dx_redirect_to';
    $dx_margin_field_name = 'dx_margin_top';
    $dx_editor_id = 'dx_my_editor';

    // checks if the 3 fields have data stored
    if( ! empty( get_option( $dx_editor_id ) ) ) {
        $dx_editor_content = get_option( $dx_editor_id );
    } else {
        $dx_editor_content = '';
    }

    if( ! empty( get_option( $dx_name_redirect ) ) ) {
        $dx_redirect_value = get_option( $dx_name_redirect );
    } else {
        $dx_redirect_value = '';
    }

    if( ! empty( get_option( $dx_margin_field_name ) ) ) {
        $dx_margin_field_value = get_option( $dx_margin_field_name );
    } else {
        $dx_margin_field_value = 0;
    }

    // saves data from the 3 input fields in wp_options table
    if( isset( $_POST[ $dx_hidden_field_name ]) && $_POST[ $dx_hidden_field_name ] == 'Y' ) {
        $dx_redirect_value = $_POST[ $dx_name_redirect ];
        $dx_editor_content = $_POST[ $dx_editor_id ];
        $dx_margin_field_value = $_POST[ $dx_margin_field_name ];

        $dx_sanitized_content = sanitize_text_field( htmlentities( $_POST[ $dx_editor_id ] ) );

        update_option( $dx_name_redirect, $dx_redirect_value );
        update_option( $dx_editor_id, $dx_sanitized_content );
        update_option( $dx_margin_field_name, $dx_margin_field_value );
        ?> <div class="updated"><p><strong><?php _e('Settings saved.', 'dx_dark_site' ); ?></strong></p></div> <?php
    } ?>
    <div class="wrap">
    	<h2><?php _e( 'Dark Site', 'dx_dark_site' ); ?></h2>
    	<form name="form1" method="post" action="">
    		<input type="hidden" name="<?php echo $dx_hidden_field_name; ?>" value="Y">
    		<h3> <?php _e( 'REDIRECTION', 'dx_dark_site' ); ?></h3>
    		<p><?php _e("Redirect to:", 'dx_dark_site' ); ?>
    			<input type="text" name="<?php echo $dx_name_redirect; ?>" value="<?php echo $dx_redirect_value; ?>" size="40">
    		</p><hr />
    		<h3> <?php _e( 'BANNER', 'dx_dark_site' ); ?></h3>
            <p>
                <?php wp_editor( $dx_editor_content, $dx_editor_id ); ?>
            </p>
            <p> <?php _e( "Margin from top (in rem Units) :", 'dx_dark_site' ); ?>
                <input type="number" name="<?php echo $dx_margin_field_name?>" value="<?php echo $dx_margin_field_value ?>" min=0 max=20>
            </p>
    		<p class="submit">
                <?php submit_button( 'save', 'primary' ); ?>
    		</p>
    	</form>
    </div>
<?php }