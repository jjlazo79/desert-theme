<?php

declare(strict_types=1);

/**
 * Template part pair of videos
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 0.0.4
 */
?>

<div class="row">
	<div class="col-sm-12 col-md-6">
		<div class="iframe-container mt-2 mb-2">
			<iframe class="responsive-iframe" src="https://www.youtube.com/embed/<?php echo $video1; ?>?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
	<div class="col-sm-12 col-md-6">
		<div class="iframe-container mt-2 mb-2">
			<iframe class="responsive-iframe" src="https://www.youtube.com/embed/<?php echo $video2; ?>?controls=0" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</div>
</div>
