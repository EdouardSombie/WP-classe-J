<?php get_header() ?>

<main id="site-content">
	<div class="container">
		<?php get_template_part('template-parts/identity-card'); // pas besoin de l'extension ?>
		<?php if(!is_front_page()){ ?>
			<div class="row">
				<div class="col-md-6 offset-md-3"> 
					<?php get_template_part('template-parts/post-list'); ?>
				</div>
			</div>
		<?php } ?>
	</div>
</main>

<?php get_footer() ?>