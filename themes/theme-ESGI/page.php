<?php // Template d'une page seule ?>
<?php get_header() ?>

<main id="site-content">
	<div class="container single-page">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<?php
				if(is_front_page()){ 
					get_template_part('template-parts/identity-card');
				}else{ ?>
					<h1 class="page-title"><?php the_title() ?></h1>
					<div class="page-content">
						<?php the_content() ?>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer() ?>