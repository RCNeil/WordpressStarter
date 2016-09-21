<?php get_header(); ?>
<div class="container">
	<div class="row">
		<div class="span100">
			<main role="main">
			<section>
			<?php if (have_posts()): while (have_posts()) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php if ( has_post_thumbnail()) : ?>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<?php the_post_thumbnail();  ?>
						</a>
					<?php endif; ?>


					<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>

					<span class="date"><?php the_time('F j, Y'); ?> </span>
					<span class="author"><?php _e( 'Published by', 'html5blank' ); ?> <?php the_author_posts_link(); ?></span>
					<span class="comments"><?php if (comments_open( get_the_ID() ) ) comments_popup_link( __( 'Leave your thoughts', 'html5blank' ), __( '1 Comment', 'html5blank' ), __( '% Comments', 'html5blank' )); ?></span>


					<?php the_content(); ?>
					<?php comments_template(); ?>

				</article>


			<?php endwhile; ?>
			<?php endif; ?>

			</section>
			</main>
		</div>
	</div>
<div class="clear"></div>
</div>

<?php //get_sidebar(); ?>

<?php get_footer(); ?>