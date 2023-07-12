<?php // Template d'un article seul ?>
<?php get_header() ?>

<main id="site-content">
	<div class="container single-post">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<h1 class="post-title"><?php the_title() ?></h1>
				<div class="post-infos">
					<div>
						<?= get_the_author_meta('display_name', $post->post_author) ?>
					</div>
					<time>
						<?= wp_date('j F Y', strtotime($post->post_date)) ?>
					</time>
				</div>
				<div class="post-content">
					<?= get_the_post_thumbnail($post->ID, 'large'); ?>
					<?php the_content() ?>
				</div>
			</div>
			<?php 
			if(get_theme_mod('has_sidebar', false)){?>
				<div class="col-md-2 offset-md-1">
					<?php get_sidebar(); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</main>

<?php get_footer() ?>