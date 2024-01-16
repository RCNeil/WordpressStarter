<?php get_header(); ?>
<?php if (have_posts()): while (have_posts()) : the_post(); ?>
<main class="post-main">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<section class="feature-image">
			<?php if ( has_post_thumbnail()) : ?>
				<?php the_post_thumbnail();  ?>
			<?php endif; ?>
		</section>
		<section class="post-content">
			<div class="row">
				<?php $terms = get_the_terms($post->ID, 'category'); ?>
				<ul class="categories">
					<?php foreach($terms as $term) { ?>
						<li><a href="<?php echo get_term_link($term); ?>"><?php echo $term->name; ?></a></li>
					<?php } ?>
				</ul>
				<h1><?php the_title(); ?></h1>
				<ul class="post-meta">
					<li class="author"><?php the_author_posts_link(); ?></li>
					<li class="date"><?php the_time('F j, Y'); ?></li>				
					<li class="time"><?php the_time('h:i a'); ?></li>
				</ul>
				<?php the_content(); ?>
				<?php //comments_template(); ?>
				<?php get_template_part('includes/social-share'); ?>
			</div>
		</section>
	</article>
</main>
<?php endwhile; endif; ?>
<?php get_footer(); ?>