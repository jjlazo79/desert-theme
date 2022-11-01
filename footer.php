</div>
<footer id="footer" class="container-fluid">
	<div class="row container m-auto">
		<div class="col-12 col-sm-6">
			<?php dynamic_sidebar('footer-widget-area_1'); ?>
		</div>
		<div class="col-12 col-sm-6">
			<?php dynamic_sidebar('footer-widget-area_2'); ?>
		</div>
	</div>
	<div class="row pt-3 pb-3">
		<div class="col-12 text-center" id="copyright">
			<a class="pointer text-primary-color" onclick="window.open('<?php echo get_permalink(get_page_by_path('notas-legales')); ?>', '_blank');">Notal legales</a> | &copy; <?php echo esc_html(date_i18n(__('Y', 'desert'))); ?> <?php echo esc_html(get_bloginfo('name')); ?>
		</div>
	</div>
</footer>
</div>
<?php wp_footer(); ?>
</body>

</html>
