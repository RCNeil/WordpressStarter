<?php get_header(); 
	if (is_author()) {
		$archive_title = 'Author: ' . get_the_author();
	} elseif (is_tag()) {
		$archive_title = 'Tag: ' . single_tag_title('', false);
	} elseif (is_category()) {
		$archive_title = 'Category: ' . single_cat_title('', false);
	} else {
		$archive_title = 'Archives';
	}
?>
<main role="main" id="main-content">
	<article id="post-archive post-listing" <?php post_class(); ?>>
		<h1><?php echo $archive_title; ?></h1>
		<?php get_template_part('loop'); ?>
		<?php get_template_part('pagination'); ?>
	</article>
</main>
<?php get_footer(); ?>