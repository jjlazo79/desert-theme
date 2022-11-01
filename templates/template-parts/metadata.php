<?php

declare(strict_types=1);

/**
 * Template part seers single
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * To override this template, create folder /templates/ into your active theme
 * and copy this file in it
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 4.2.1
 */

$available = (bool)random_int(0, 1);
if ($available) {
	$status_class = 'available';
	$status       = 'Disponible';
} else {
	$status_class = 'not-available';
	$status       = 'No disponible';
}

?>

<div class="row">
	<div class="col-6 col-sm-4 text-primary-color">
		<p class="h4 ml-2"><?php echo $seer_hits; ?>%</p>
		<p><small>Aciertos</small></p>
	</div>
	<div class="col-12 col-sm-4 pt-3 font-macondo">
		<p>
			<span class="js-seer-status <?php echo $status_class; ?>"><span class="js-seer-status-text complex-profile h3"><?php echo $status; ?></span></span>
		</p>
	</div>
	<div class="col-6 col-sm-4 text-primary-color">
		<p class="h4 ml-2"><?php echo $seer_inquiries; ?></p>
		<p><small>Consultas</small></p>
	</div>
</div>
