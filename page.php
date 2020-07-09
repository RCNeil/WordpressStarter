<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); 
	$bg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
?>
<div class="container" style="background:url('<?php echo $bg[0]; ?>') center center no-repeat;background-size:cover;">
	<div class="row">
		<div class="span100">
			<main role="main">
				<section>
					<h1><?php the_title(); ?></h1>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php the_content(); ?>
					</article>				
				</section>
			</main>		
		</div>
	</div>
<div class="clear"></div>
</div>
<?php endwhile; ?>
<?php endif; ?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>