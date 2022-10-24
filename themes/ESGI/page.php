<?php get_header() ?>

<main id="site-content">
	<div class="container">
		<div class="row">
			<div class="col-md-6 offset-md-3">
				<?php if(is_front_page()){ ?>
					<?php get_template_part('template-parts/identity-block'); ?>
				<?php }else{ ?>
				<h1 class="post-title"><?= $post->post_title ?></h1>
				<div class="post-content">
					<?= $post->post_content ?>
				</div>
				<?php } ?>
			</div>
		</div>
	</div>
</main>

<?php get_footer() ?>	