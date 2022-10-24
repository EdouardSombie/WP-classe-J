<?php get_header() ?>
<?php
global $wp_query; // variable créée par WP
?>
<main id="site-content">
	<div class="col-md-6 offset-md-3">
		<h1 class="post-title">Résultats de la recherche pour "<?= $wp_query->query['s'] ?>"</h1>
		<?php
		$posts = $wp_query->posts;
		get_template_part('template-parts/post-list');
		?>
	</div>
</main>

<?php get_footer() ?>