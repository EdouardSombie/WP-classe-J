<?php // Template d'une page seule ?>
<?php get_header() ?>

<main id="site-content">
	<div class="container single-page">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h1 class="page-title"><?php the_title() ?></h1>
				<div class="page-content">
					<?php the_content() ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php get_footer() ?>