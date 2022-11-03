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
				<section class="pagehome-title">
					<div class="container">
						<div class="row">
							<div class="col-12 col-md-8 offset-md-2 text-center">
								<?php $id_frontpage = get_option('page_on_front');
								echo '<h1 class="custom-title">' . get_the_title($id_frontpage) . '</h1>'; ?>
							</div>
						</div>
					</div>
				</section>
				<section class="pagehome-header">
					<div class="container">
						<div class="row">
							<div class="col-12">
								<div class="pagehome-content p-5">



									<div class="seer-item">
										<div class="row align-items-center pl-5 pr-5">
											<div class="col-12 col-sm-4">
												<div class="seer-thumbnail">
													<?php the_post_thumbnail('seer-thumb', array('title' => get_the_title(), 'class' => 'rounded-circle')); ?>
												</div>
											</div>

											<div class="col-12 col-sm-8">
												<?php the_title('<span class="text-primary-color h2 text-capitalize word-no-break">', '</span>'); ?>
												<p><?php echo $seer_specialist . ' - ' . $seer_specialist_2; ?></p>
												<div class="seer-content--caltoaction">
													<?php
													if (file_exists(get_stylesheet_directory() . '/templates/template-parts/call-to-action-single.php')) {
														include get_stylesheet_directory() . '/templates/template-parts/call-to-action-single.php';
													} else {
														include SEERSSERVICES_PLUGIN_DIR_PATH . 'templates/template-parts/call-to-action-single.php';
													}
													?>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-12 text-center">
												<div class="seer-content--iframe">
													<div class="pt-4">
														<?php echo $iframe_payment; ?>
													</div>
												</div>
											</div>
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</section>
			</div>
		</header>

		<div class="seer-content mt-5">

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

			<section class="row m-auto seer-content--biography pt-3">
				<div class="col-12 pb-5">
					<div class="container">
						<div id="complex-profile"></div>
					</div>
				</div>
			</section>

			<section class="pagehome-cta background-secondary-color-darken p-5 text-center">
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
