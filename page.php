<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<main role="main" id="main-content">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php the_content(); ?>
	</article>				
</main>		
<?php endwhile; endif; ?>
<?php get_footer(); ?>