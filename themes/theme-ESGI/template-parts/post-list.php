<?php

$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

$args = [
	'posts_per_page' => 2,
	'post_type' => 'post',
	'paged' => $paged
];

// $posts = get_posts($args);


$the_query = new WP_Query( $args );

?>

<ul class="post-list">
	<?php 
	if($the_query->have_posts()){

		while($the_query->have_posts()){
			$the_query->the_post(); // itération et déclaration d'une variable $post
			$p = get_post();
		?>
			<li>
				<a href="<?= get_permalink($p->ID) ?>">
					<?= $p->post_title ?> 
					<time><?= wp_date('j F Y', strtotime($p->post_date))  ?></time>
				</a>
			</li>
		<?php } ?>
	<?php } ?>
</ul>

<nav class="post-list-pagination">
<?php

$big = 999999999; // need an unlikely integer

echo paginate_links( array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'current' => max( 1, $paged ),
		'total' => $the_query->max_num_pages,
	) );
?>
</nav>
