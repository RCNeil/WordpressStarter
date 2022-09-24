<?php
$id = 'squatch-block-' . $block['id'];
if( !empty($block['anchor']) ) {
	$id = $block['anchor'];
}
$className = 'container innerblocks-example';
if( !empty($block['className']) ) {
	$className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
	$className .= ' align' . $block['align'];
}

$template = array(
	array( 'core/columns', array(
		'blockGap' => "0px",
	), array(
		array( 'core/column', array(
			'width' => '50%', 
			'className' => 'main-block'
		), array(
			array('core/heading',  array(
				'level' => 1,
				'content' => 'Title Goes Here',
			)),
			array( 'core/paragraph', array(
				'content' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
			))
		)),
		array( 'core/column', array(
			'className' => 'secondary-block'
		), array(
			array( 'core/cover', array(				
			), array(
				array('core/heading',  array(
					'level' => 3,
					'content' => 'A Secondary Heading',
					'textColor' => 'secondary'
				)),
			)),
		)),
	) )
);
?>
<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($className); ?>">
	<InnerBlocks template="<?php echo esc_attr(wp_json_encode($template)); ?>" />
</div>