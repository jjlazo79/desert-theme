<?php

declare(strict_types=1);

/**
 * The template for displaying single seers
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 0.1.0
 */

get_header();

// Get options
$options           = get_option('ss_option_name');
$iframe_payment    = $options['ss_payment_iframe'];
$seer_specialist   = get_post_meta(get_the_ID(), 'seer_specialist', true);
$seer_specialist_2 = get_post_meta(get_the_ID(), 'seer_specialist_2', true);
$seer_hits         = get_post_meta(get_the_ID(), 'seer_hits', true);
$seer_inquiries    = get_post_meta(get_the_ID(), 'seer_inquiries', true);

/* Start the Loop */
while (have_posts()) :
	the_post();

?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<header class="seer-header">
			<div class="container-fluid">
				<div class="row align-items-center">
					<div class="col-12 col-md-6 col-lg-6">
						<div class="pagehome-header">
							<div class="row align-items-center">
								<div class="col-12 col-sm-3 text-center">
									<img src="/wp-content/themes/desert/img/logo-header.png">
								</div>
								<div class="col-12 col-sm-9 p-4">
									<?php $id_frontpage = get_option('page_on_front');
									echo '<h1 class="custom-title">' . get_the_title($id_frontpage) . '</h1>'; ?>
								</div>
							</div>
						</div>
					</div>
					<div class="col-12 col-md-6 offset-lg-1 col-lg-4">
						<div class="p-4 p-sm-5 p-md-4 p-lg-1 pt-lg-5">
							<div class="transform-bg">
								<div class="seer-item">
									<div class="row align-items-center p-4">
										<div class="col-6 text-center">
											<?php the_title('<span class="text-primary-color h2 text-capitalize word-no-break">', '</span>'); ?>
											<p><?php echo $seer_specialist . ' - ' . $seer_specialist_2; ?></p>
										</div>
										<div class="col-6">
											<div class="seer-thumbnail">
												<?php the_post_thumbnail('seer-thumb'); ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>

		<div class="seer-content container-fluid">
			<section class="seer-content--caltoaction">
				<div class="container pt-4">
					<?php
					if (file_exists(get_stylesheet_directory() . '/templates/template-parts/call-to-action-single.php')) {
						include get_stylesheet_directory() . '/templates/template-parts/call-to-action-single.php';
					} else {
						include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/call-to-action-single.php';
					}
					?>
				</div>
			</section>

			<section class="seer-content--iframe">
				<div class="pt-4">
					<?php echo $iframe_payment; ?>
				</div>
			</section>

			<section class="seer-content--about pt-3">
				<div class="row container m-auto">
					<div class="col-12">
						<div class="pt-4 pb-4">
							<p class="bio-about font-weight-bold h4">Sobre mi:</p>
							<?php the_content(); ?>
						</div>
					</div>
				</div>
			</section>

			<section class="row container m-auto seer-content--biography pt-3">
				<div class="col-12 pb-5">
					<div id="complex-profile"></div>
				</div>
			</section>

			<section class="pagehome-cta text-center">
				<?php
				if (file_exists(get_stylesheet_directory() . '/templates/template-parts/call-to-action.php')) {
					include get_stylesheet_directory() . '/templates/template-parts/call-to-action.php';
				} else {
					include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/call-to-action.php';
				}
				?>
			</section>
			<!-- .pagehome-cta -->

			<?php //include 'template-parts/videos.php';
			?>
		</div><!-- .seer-content -->

	</article><!-- #post-<?php the_ID(); ?> -->

<?php

endwhile; // End of the loop.

get_footer();
