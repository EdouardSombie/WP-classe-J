<?php get_header() ?>

<main id="site-content">
	<div class="container">
		<?php get_template_part('template-parts/identity-card'); // pas besoin de l'extension ?>
		<?php if(!is_front_page()){
			get_template_part('template-parts/post-list');
		}
		?>
	</div>
</main>

<?php get_footer() ?>