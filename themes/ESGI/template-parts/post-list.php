<?php 
$posts = $wp_query->posts;
echo '<ul class="post-list">';
foreach ($posts as $p) { ?>
<li>
	<article>
		<a href="<?= get_permalink($p) ?>">
			<h1><?= $p->post_title ?></h1>
			<time><?= wp_date('j F Y', strtotime($p->post_date)) ?></time>
		</a>
	</article>
</li>

<?php }
echo '</ul>';
?>
<div class="pagination">
	<?php 
	echo paginate_links( [	
		'current' => max( 1, $wp_query->query['paged'] ),
		'total' => $wp_query->max_num_pages,
		'base' => get_permalink(get_option('page_for_posts')) . '%_%',
	]);
	?>
</div>