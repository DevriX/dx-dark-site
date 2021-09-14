<?php
/**
* Template Name: Countdown Page
*
*/

get_header();
	$page_id = get_the_ID();
	$args = array(
        'post_type' => 'page',
		'p' => $page_id
    );

    $post_query = new WP_Query($args);

    if($post_query->have_posts() ) {
        while($post_query->have_posts() ) {
            $post_query->the_post();
            ?>
			<div class ="dx-dark-content">
            <h2 class="dx-dark-countdownheading"><?php the_title(); ?></h2>
			<div class="dx-dark-image" ><?php echo get_the_post_thumbnail( $page_id, 'large' ); ?></div>
			<div class="dx-dark-image" ><?php the_content(); ?></div>
			</div>
            <?php
            }
        };
get_footer();

?>

