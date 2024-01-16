<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div <?php post_class(); ?>>
		<figure class="wp-block-post-featured-image">
			<a href="<?php the_permalink(); ?>" target="_self">
				<?php the_post_thumbnail(); ?>
			</a>
		</figure>
		<h2><a href="<?php the_permalink(); ?>" target="_self"><?php the_title(); ?></a></h2>
		<time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
			<a href="<?php the_permalink(); ?>"><?php the_date('F j, Y'); ?></a>
		</time>
		<a href="<?php the_permalink(); ?>" class="button">Read More</a>
	</div>
<?php endwhile; endif; ?>
