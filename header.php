<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?></title>

<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_url'); ?>/images/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_url'); ?>/images/favicon-16x16.png">
<link rel="manifest" href="<?php bloginfo('template_url'); ?>/images/site.webmanifest">
<link rel="mask-icon" href="<?php bloginfo('template_url'); ?>/images/safari-pinned-tab.svg" color="#000000">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="theme-color" content="#ffffff">
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
	<div class="mobile-menu"><i class="fa fa-bars" aria-hidden="true"></i></div>
<div class="clear"></div>
</div>

</header>
<!-- /header -->
