<?php get_header(); ?>

<main id="site-content">
	<div class="container">
		<?php get_template_part('template-parts/identity-block'); ?>
		
		<div class="col-md-6 offset-md-3">
		<?php if(!is_front_page()){
			// Récupérer les 6 derniers posts
			// $args = [
			// 	'numberposts' => 6,
			// 	'post_status' => 'publish',
			// 	'order' => 'DESC',
			// 	'order_by' => 'date'
			// ];
			// $posts = get_posts($args);

			$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
			$args = [
				'posts_per_page' => get_option('posts_per_page'),
				'post_status' => 'publish',
				'order' => 'DESC',
				'order_by' => 'date',
				'paged' => $paged,
			];

			$wp_query = new WP_Query($args);
			get_template_part('template-parts/post-list');
		}
		?>
		</div>
	</div>
</main>

<?php get_footer(); ?>