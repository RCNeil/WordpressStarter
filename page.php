<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<div class="container" id="main-content">
	<main role="main">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<?php the_content(); ?>
		</article>				
	</main>		
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php get_footer(); ?>