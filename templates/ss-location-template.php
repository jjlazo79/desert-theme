<?php

declare(strict_types=1);

/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 0.0.4
 */

get_header();

global $wpdb;
// Get data
$table_name    = $wpdb->prefix . 'services_pages_relationships';
$post_id       = get_the_ID();
$page_data     = $wpdb->get_results("SELECT type_page, city_id FROM {$table_name} WHERE  page_id = $post_id", ARRAY_A);
$taxonomy      = 'service-city';
$term          = get_term($page_data[0]['city_id'], $taxonomy);
$location      = (!is_wp_error($term)) ? $term->name : '';
$location_slug = (!is_wp_error($term)) ? $term->slug : '';
$term_parent   = (!is_wp_error($term)) ? $term->parent : 0;
$service       = get_post_meta($post_id, 'page_service', true);
$service_slug  = sanitize_title($service);
$page_title    = str_replace('Mejores Tarot ', 'Mejores videntes de Tarot ', get_the_title());


// Get options
$options   = get_option('ss_option_name');
$styles    = get_option('ss_option_styles');
$bg_text   = ($styles['ss_bg_text']) ? 'bg-text' : '';

/* Start the Loop */
while (have_posts()) :
	the_post();

	// Format texts
	$page_intro = get_post_meta(get_the_ID(), 'page_intro', true);
	$page_intro = str_replace('%SERVICIO%', $service, $page_intro);
	$page_intro = str_replace('%UBICACION%', $location, $page_intro);

	$page_content = get_the_content();
	$page_content = str_replace('%SERVICIO%', $service, $page_content);
	$page_content = str_replace('%UBICACION%', $location, $page_content);

?>
	<div class="container-fluid">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="main">
			<section class="pagehome-title">
				<div class="container">
					<div class="row">
						<div class="col-12 col-md-6 offset-md-3 text-center">
							<?php the_title('<h1 class="custom-title">', '</h1>'); ?>
						</div>
					</div>
				</div>
			</section>
			<section class="pagehome-header">
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="pagehome-content p-5">
								<?php echo $page_intro; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
			<!-- .page-header -->

			<section class="pagehome-seers background-secondary-color pt-4 pb-4 mt-5">
				<?php
				if (file_exists(get_stylesheet_directory() . '/templates/template-parts/seers-list.php')) {
					include get_stylesheet_directory() . '/templates/template-parts/seers-list.php';
				} else {
					include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/seers-list.php';
				}
				?>
			</section>
			<!-- .pagehome--seers -->

			<section class="pagehome-prefooter p-5">
				<div class="row container m-auto">
					<div class="col-12">
						<?php echo $page_content; ?>
					</div>
				</div>
			</section>
			<!-- .pagehome-prefooter -->

			<div class="background-secondary-color-darken mt-5 container">
				<?php if (isset($styles['ss_call_to_action'])) : ?>
					<section class="pagehome-cta pt-5">
						<?php
						if (file_exists(get_stylesheet_directory() . '/templates/template-parts/call-to-action.php')) {
							include get_stylesheet_directory() . '/templates/template-parts/call-to-action.php';
						} else {
							include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/call-to-action.php';
						}
						?>
					</section>
					<!-- .pagehome-cta -->
				<?php endif; ?>

				<section class="pagehome-serviceslist p-5">
					<?php
					if (file_exists(get_stylesheet_directory() . '/templates/template-parts/services-list.php')) {
						include get_stylesheet_directory() . '/templates/template-parts/services-list.php';
					} else {
						include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/services-list.php';
					}
					?>
				</section>
				<!-- .pagehome-serviceslist -->

				<?php if (!empty($video1) || !empty($video2)) : ?>
					<section class="pagehome-videos p-5">
						<?php
						if (file_exists(get_stylesheet_directory() . '/templates/template-parts/videos.php')) {
							include get_stylesheet_directory() . '/templates/template-parts/videos.php';
						} else {
							include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/videos.php';
						}
						?>
					</section>
					<!-- .pagehome-videos -->
				<?php endif; ?>

				<section class="pagehome-citylist p-5">
					<?php
					if (file_exists(get_stylesheet_directory() . '/templates/template-parts/city-list.php')) {
						include get_stylesheet_directory() . '/templates/template-parts/city-list.php';
					} else {
						include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/city-list.php';
					}
					?>
				</section>
				<!-- .pagehome-citylist -->
			</div>

		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- .container -->

<?php

endwhile; // End of the loop.

get_footer();
