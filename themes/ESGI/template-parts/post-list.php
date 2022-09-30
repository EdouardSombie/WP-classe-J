<?php 
// Récupérer les 6 derniers posts
$args = [
	'numberposts' => 6,
	'post_status' => 'publish',
	'order' => 'DESC',
	'order_by' => 'date'
];

$posts = get_posts($args);
echo '<ul>';
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