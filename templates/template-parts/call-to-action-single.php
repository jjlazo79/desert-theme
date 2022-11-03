<?php

declare(strict_types=1);

/**
 * Template part call to action
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-page
 *
 * @package WordPress
 * @subpackage SeersServices
 * @since SeersServices 4.2.1
 */
?>

<div class="row">
	<div class=" col-12 col-sm-6 pt-2 pb-2 text-center">
		<button class="btn btn-secondary btn-block btn-lg rounded-pill" onclick="window.location.assign('tel:<?php echo $options['ss_phone_1']; ?>');return false;">
			<span class="d-block"><?php echo $options['ss_phone_1']; ?></span>
		</button>
	</div>
	<div class="col-12 col-sm-6 pt-2 pb-2 text-center">
		<button class="btn btn-primary btn-block btn-lg rounded-pill" onclick="window.location.assign('tel:<?php echo $options['ss_phone_2']; ?>');return false;">
			<span class="d-block"><?php echo $options['ss_phone_2']; ?></span>
		</button>
	</div>
	<div class="col-12 pagehome-cta--advise">
		<small class="small">
			<?php _e('Solo mayores edad. Coste 911: Gratis con tarifa plana, móvil en función de tarifa contratada. Coste 806: Red fija: 1,21€ (IVA incl.) y red móvil: 1,57€ (IVA incl.). + Info en Notas legales', SEERSSERVICES_TEXT_DOMAIN); ?>
		</small>
	</div>
</div>
<a onclick="window.location.assign('tel:<?php echo $options['ss_phone_1']; ?>');return false;" class="d-sm-none btn btn-primary btn--sticky" id="js-click-to-call-bar">Llama ahora</a>
