<?php

declare(strict_types=1);

/**
 * Template part seers list
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
?>

<?php
// Availability handler
$available = (bool)random_int(0, 1);
if ($available) {
	$status_class = 'available';
	$status       = 'Disponible';
} else {
	$status_class = 'not-available';
	$status       = 'No disponible';
}

// Get 8 random seers
$args = array(
	'post_type'      => 'seer',
	'post_status'    => 'published',
	'posts_per_page' => 8,
	'orderby'        => 'rand'
);

$seers = new WP_Query($args);

// The Loop
if ($seers->have_posts()) :
	echo '<div class="container seer-container">';
	echo '<div class="row seers-list">';
	while ($seers->have_posts()) :
		$seers->the_post(); ?>
		<?php
		$available = (bool)random_int(0, 1);
		if ($available) {
			$status_class = 'available';
			$status       = 'Disponible';
		} else {
			$status_class = 'not-available';
			$status       = 'No disponible';
		}
		$seer_specialist   = get_post_meta(get_the_ID(), 'seer_specialist', true);
		$seer_specialist_2 = get_post_meta(get_the_ID(), 'seer_specialist_2', true);
		$seer_hits         = get_post_meta(get_the_ID(), 'seer_hits', true);
		$seer_inquiries    = get_post_meta(get_the_ID(), 'seer_inquiries', true);
		?>
		<div class="col-12 col-sm-6 col-lg-3">
			<div class="seer-item pointer mb-4" onclick="window.open('<?php echo get_the_permalink(); ?>');return false;">
				<div class="seer-item--inner">
					<div class="seer-title text-center">
						<div class="row">
							<div class="col-12">
								<?php the_title('<span class="text-uppercase">', '</span>'); ?>
							</div>
							<div class="col-12">
								<span class="js-seer-status <?php echo $status_class; ?>"><span class="js-seer-status-text complex-profile"><?php echo $status; ?></span></span>
							</div>
						</div>
					</div>

					<div class="seer-thumbnail mb-3 text-center">
						<div class="row mt-4">
							<div class="col-12 text-center">
								<?php the_post_thumbnail('thumbnail', array('title' => get_the_title(), 'class' => 'rounded-circle')); ?>
							</div>
						</div>
					</div>

					<div class="seer-excerpt pl-4 pr-4">
						<?php the_excerpt(); ?>
					</div>

					<div class="seer-meta text-center mb-4">
						<div class="col-12">
							<p class=""><?php echo $seer_hits; ?>% <small>Aciertos</small>
								<br><?php echo $seer_inquiries; ?> <small>Consultas</small>
							</p>
						</div>
					</div>

					<div class="btn-holder text-center">
						<div class="btn btn-primary btn-lg rounded-pill">Ver perfil</div>
					</div>
				</div>
			</div>
		</div>
<?php endwhile;
	echo '</div>';
	echo '</div>';
endif;
/* Restore original Post Data */
wp_reset_postdata();
