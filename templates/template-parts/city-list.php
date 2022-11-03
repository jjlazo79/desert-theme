<?php

declare(strict_types=1);

/**
 * Template part city list
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 0.0.4
 */

// Get service slug if exist
$service_name  = (isset($service) && $service != false) ? $service : '';
$location_name = (isset($location) && $location != false) ? $location : '';
$service       = (isset($service_slug) && $service_slug != false) ? strtolower($service_slug) : '';
$location      = (isset($location_slug) && $location_slug != false) ? strtolower($location_slug) : false;
$args          = array(
	'post_type'      => 'seer-service',
	'post_status'    => 'published',
	'posts_per_page' => 1,
	'meta_query'     => array(
		array(
			'key'     => 'seer_service_pseudosticky',
			'value'   => "on",
			'compare' => '='
		),
		array(
			'key'     => 'generated',
			'value'   => true,
		),
	),
);
$sticky_services = new WP_Query($args);
if ($sticky_services->found_posts > 0) {
	$sticky_service_id   = $sticky_services->post->ID;
	$sticky_service      = $sticky_services->post->post_name;
	$sticky_service_name = $sticky_services->post->post_title;
}

if (is_page_template('ss-home-template.php')) {
	// $term_parent from ss-home-template.php
	$service      = $sticky_service;
	$service_name = $sticky_service_name;
	$city         = 'España';
	$button       = '';
} else {
	switch ($page_data[0]['type_page']) {
		case 'service':
			// $term_paren from ss-location-template.php
			$city        = 'España';
			$button      = '';
			break;
		case 'service/city':
			$term_parent = $page_data[0]['city_id'];
			$service     = $service . '/' . $term->slug;
			$city        = $location_name;
			$button      = '';
			break;
		case 'service/city/town':
			$city_parent = get_term($term->parent, $taxonomy);
			// $term_parent from ss-location-template.php
			$service     = $service . '/' . $city_parent->slug;
			$city        = $location_name;
			$button      = '
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-2">
				<a class="btn btn-light btn-block rounded-pill" href="/' . $service . '/">
					' . $service_name . ' ' . $city_parent->name . '
				</a>
			</div>';
			break;
	}
}
$city_array= array();

if ($term_parent === 0) {
	// Get cities
	if (is_page_template('ss-home-template.php')) {
		$terms = wp_get_post_terms($sticky_service_id, $taxonomy);
	} else {
		$current_url     = add_query_arg(array(), $wp->request);
		$current_service = get_page_by_path($current_url, OBJECT, 'seer-service');
		$terms           = wp_get_post_terms($current_service->ID, $taxonomy);
	}

	if ($terms != null) {
		foreach ($terms as $term) {
			if ($term->parent != 0) continue;
			$city_array[] = $term;
			// Get rid of the other data stored in the object, since it's not needed
			unset($term);
		}
	}
} else {
	// Get towns
	$city_array = get_terms(array(
		'taxonomy'   => $taxonomy,
		'hide_empty' => true,
		'parent'     => $term_parent
	));

} //endif

$pre_service = (strpos($service_name, "Tarot ") === 0) ? 'videntes de ' . $service_name : $service_name;

?>

<div class="row">
	<div class="container">
		<div class="col-12 mb-3">
			<h2>Encuentra las mejores <?php echo $pre_service; ?> de <?php echo $city; ?> en tu ciudad</h2>
		</div>
		<div class="col-12">
			<div class="row text-center">
				<?php echo $button; ?>
				<?php foreach ($city_array as $city) : ?>
					<?php if ($location === $city->slug) continue; ?>
					<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-2">
						<a class="btn btn-light btn-block rounded-pill" href="<?php echo get_home_url() . '/' . $service . '/' . $city->slug . '/'; ?>">
							<?php echo $service_name . ' ' . $city->name; ?>
						</a>
					</div>
					<?php unset($city); ?>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
