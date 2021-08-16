<?php
/**
 * Add meta box 'Date'
 */
function date_meta() {
    $screens = array( 'post' );
    foreach ( $screens as $screen ) {
        add_meta_box(
            'date',
            'Date: ',
            'date_meta_html',
            $screen
        );
    }
}
add_action( 'add_meta_boxes', 'date_meta' );

/**
 * Callback for the add_meta_box function, returns the html of the current meta box
 */
function date_meta_html( $post ) {
    $date = get_post_meta( $post->ID, '_date_meta', true );
    ?>
    <label for="date_text">Date:</label>
    <input name="date_text" id="date_text" type="text" value="<?php echo esc_html( $date ); ?>" placeholder="YYYY/MM/DD">
    </input>
    <?php
}

/**
 * Saves the data from metaboxes
 */
function save_data_meta_boxes( $post_id ) {
    if ( ! empty( $_POST['date_text'] ) ) {
        update_post_meta(
            $post_id,
            '_date_meta',
            sanitize_meta( '_date_meta', $_POST['date_text'], 'post' )
        );
    }
}
add_action( 'save_post', 'save_data_meta_boxes' );
