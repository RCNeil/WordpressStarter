<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

<link href="//www.google-analytics.com" rel="dns-prefetch">
<link href="<?php bloginfo('template_url'); ?>/images/favicon.ico" rel="shortcut icon" type="image/x-icon">
<link href="<?php bloginfo('template_url'); ?>/images/favicon.ico" rel="icon" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="<?php bloginfo('description'); ?>">

<?php wp_head(); ?>
<script>
// conditionizr.com
// configure environment tests
conditionizr.config({
assets: '<?php echo get_template_directory_uri(); ?>',
tests: {}
});
</script>

</head>
<body <?php body_class(); ?>>



<!-- header -->
<header>
<div class="header container clear" role="banner">
	<div class="row">
		<div class="span100">
			<nav class="nav" role="navigation">
				<?php wp_nav_menu(array('theme_location' => 'header-menu' )); ?>
			</nav>
		</div>
	</div>
<div class="clear"></div>
</div>

</header>
<!-- /header -->
