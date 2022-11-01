<?php

declare(strict_types=1);

/**
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * To override this template, create folder /templates/ into your active theme
 * and copy this file in it
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 0.0.4
 */

get_header();

// Get options
$options     = get_option('ss_option_name');
$styles      = get_option('ss_option_styles');
$bg_text     = ($styles['ss_bg_text']) ? 'bg-text' : '';
$taxonomy    = 'service-city';
$term_parent = 0;
$video1      = $options['ss_video_1'];
$video2      = $options['ss_video_2'];


/* Start the Loop */
while (have_posts()) :
	the_post(); ?>
	<div class="container-fluid">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> role="main">
			<section class="pagehome-title mt-5 mb-5 pt-2 pb-2 <?php echo $bg_text; ?>">
				<div class="row container m-auto">
					<div class="col-12 col-sm-10 offset-sm-2 col-md-8 offset-md-4 font-cookie text-right font-cookie text-right">
						<?php the_title('<h1 class="display-4 custom-title">', '</h1>'); ?>
					</div>
				</div>
			</section>
			<section class="pagehome-header mt-5 mb-5 pt-2 pb-2 <?php echo $bg_text; ?>">
				<div class="row container m-auto">
					<div class="col-12">
						<div class="text-right h3">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>
			<!-- .page-header -->

			<section class="pagehome-seers mt-5">
				<?php
				if (file_exists(get_stylesheet_directory() . '/templates/template-parts/seers-list.php')) {
					include get_stylesheet_directory() . '/templates/template-parts/seers-list.php';
				} else {
					include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/seers-list.php';
				}
				?>
			</section>
			<!-- .pagehome--seers -->

			<?php if (isset($styles['ss_call_to_action'])) : ?>
				<section class="pagehome-cta pt-5 pb-5">
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

		</article><!-- #post-<?php the_ID(); ?> -->
	</div><!-- .container -->

<?php

endwhile; // End of the loop.
get_footer();
