<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="span100">
			<main role="main">
				<section>
					<h1><?php _e( 'Categories for ', 'html5blank' ); single_cat_title(); ?></h1>
					<?php get_template_part('loop'); ?>
					<?php get_template_part('pagination'); ?>
				</section>
			</main>
		</div>
	</div>
<div class="clear"></div>
</div>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>