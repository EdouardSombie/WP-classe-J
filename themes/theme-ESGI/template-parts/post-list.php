<?php
$args = [
	'numberposts' => 6,
	'post_type' => 'post'
];

$posts = get_posts($args);

?>

<ul class="post-list">
	<?php 
	foreach($posts as $p){ ?>
		<li>
			<a href="<?= get_permalink($p->ID) ?>">
				<?= $p->post_title ?> 
				<time><?= wp_date('j F Y', strtotime($p->post_date))  ?></time>
			</a>
		</li>
	<?php } ?>
</ul>