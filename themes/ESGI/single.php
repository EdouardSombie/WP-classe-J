<?php get_header(); ?>

<?php
// Lors de l'affichage d'un post unique (article ou page)
// WP crée automatiquement une variable $post
//var_dump($post);
?>

<main id="site-content">
	<div class="container">
		<div class="col-md-6 offset-md-3">
			<h1 class="post-title"><?= $post->post_title ?></h1>
			<div class="post-meta">
				<div class="post-author">
					<img src="<?= get_avatar_url($post->post_author) ?>" alt="<?= get_the_author_meta('display_name', $post->post_author) ?>">
					<?= get_the_author_meta('display_name', $post->post_author) ?>
				</div>
				<?= getIcon('circle'); ?>
				<div class="post-date">
					<?= wp_date('j F Y', strtotime($post->post_date)) ?>
				</div>
			</div>
			<div class="post-image">
				<?= get_the_post_thumbnail() ?>
			</div>
			<div class="post-content">
				<?= $post->post_content ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer(); ?>