<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?></title>

<link rel="icon" type="image/png" href="<?php bloginfo('template_url'); ?>/images/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/svg+xml" href="<?php bloginfo('template_url'); ?>/images/favicon.svg" />
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" />
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_url'); ?>/images/apple-touch-icon.png" />
<meta name="apple-mobile-web-app-title" content="<?php bloginfo('name'); ?>" />
<link rel="manifest" href="<?php bloginfo('template_url'); ?>/images/site.webmanifest" />
<link href="<?php bloginfo('template_url'); ?>/images/favicon.ico" rel="icon" type="image/x-icon">

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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
	<div class="menu-toggle">MENU</div>
<div class="clear"></div>
</div>

</header>
<!-- /header -->
