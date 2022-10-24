<?php 
global $wp_query;
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
		'current' => max( 1, get_query_var('paged') ),
		'total' => $wp_query->max_num_pages
	]);
	?>
</div>