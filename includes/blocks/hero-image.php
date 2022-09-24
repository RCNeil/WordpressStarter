<?php
$id = 'squatch-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
$className = 'container hero-image-block';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$image = get_field('image');
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<img src="<?php echo $image['sizes']['large']; ?>" alt="<?php echo $image['alt']; ?>" class="animate" />
	<overlay></overlay>
</div>
<style type="text/css">
	#<?php echo $id; ?> {
		
	}
</style>