<?php

declare(strict_types=1);

/**
 * Template part services list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 3.0.2
 */
?>

<?php
$service_name      = (isset($service)  && $service  != false) ? $service  : '';
$location_name     = (isset($location) && $location != false) ? $location : 'España';
$scraper_page      = false;
$page_clairvoyance = get_page_by_path('/clarividencia/');
if (!is_null($page_clairvoyance)) {
	$scraper_page = '<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-2">';
	$scraper_page .= '<a class="btn btn-light btn-block rounded-pill" href="' . get_the_permalink($page_clairvoyance->ID) . '">' . get_the_title($page_clairvoyance->ID) . '</a>';
	$scraper_page .= '</div>';
}
// Get seervices
$args = array(
	'post_type'      => 'seer-service',
	'post_status'    => 'publish',
	'posts_per_page' => -1,
	'orderby'        => 'rand',
	'meta_query'     => array(
		array(
			'key'   => 'generated',
			'value' => true,
		),
	),
);

$services = new WP_Query($args);
if ($services->have_posts()) : ?>
	<div class="container">
		<div class="row">
			<div class="col-12 mb-3">
				<h2>Encuentra los mejores servicios de videncia de <?php echo $location_name; ?> en tu ciudad</h2>
			</div>
			<div class="col-12">
				<div class="row text-center">
					<?php if (false != $scraper_page) echo $scraper_page; ?>
					<?php while ($services->have_posts()) :
						$services->the_post(); ?>
						<?php if ($post->post_title === $service_name && $page_data[0]['type_page'] === 'service') continue; ?>
						<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-2">
							<a class="btn btn-light btn-block rounded-pill" href="<?php echo get_home_url() . '/' . $post->post_name; ?>/"><?php the_title(); ?></a>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
		</div>
	</div>
<?php endif;

/* Restore original Post Data */
wp_reset_postdata();
