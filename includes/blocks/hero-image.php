<?php

/**
 * Hero Image Block Template.
 *
 * @param	array $block The block settings and attributes.
 * @param	string $content The block inner HTML (empty).
 * @param	bool $is_preview True during AJAX preview.
 * @param	(int|string) $post_id The post ID this block is saved to.
 */
 
// Create id attribute allowing for custom "anchor" value.
$id = 'hero-image-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container hero-image-block-container';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$image = get_field('image');
$title = get_field('title');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="animate" />
	<overlay></overlay>
	<?php if($title) : ?>
		<div class="row title-row">
			<div class="span100 text-center">
				<h1 class="animate"><?php echo $title; ?></h1>
			</div>
		</div>
	<?php endif; ?>
</div>
<style type="text/css">
	#<?php echo $id; ?> {
		
	}
</style>