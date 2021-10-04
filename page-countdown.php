<?php
/**
* Template Name: DX-Dark Site: Countdown Page
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
			<div class ="dx-dark-content" style="background-image: url(<?php  echo get_the_post_thumbnail_url($post) ?>)">
            <h2 class="dx-dark-countdownheading"><?php the_title(); ?></h2>
			<div class="dx-dark-countdown"></div>
			<div class="dx-dark-content" ><?php the_content(); ?></div>
			</div>
            <?php
            }
        };
get_footer();

?>

<style>
/* Countdown page css */
.dx-dark-content {
	max-width:1024px;
	width:100%;
	margin:auto;
	background-size: 100% 100%;
	border: 1 px solid white;
	border-radius:10%;
}
.dx-dark-countdownheading {
	text-align:center;
	padding:30px;
}
.dx-dark-content {
	padding:20px;
	background-color: #ffffff85;
}
.dx-dark-countdown {
	width:50%;
	margin:auto;
	background-color:aliceblue;
	font-size:40px;
	text-align:center;
	font-weight:700;
	margin-bottom:30px;
	border-radius:20%;
	border: 3px solid black;
}
</style>