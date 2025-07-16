<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<title><?php wp_title(''); ?></title>

<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>



<!-- header -->
<header>
<div class="header container clear" role="banner">
	<div class="row">
		<a href="<?php echo bloginfo('url'); ?>" title="<?php echo bloginfo('name'); ?>">LOGO</a>
		<nav class="nav" role="navigation">
			<?php wp_nav_menu(array('theme_location' => 'header-menu' )); ?>
		</nav>
		<div class="menu-toggle">MENU</div>
	</div>	
</div>
<div class="header-spacer"></div>
</header>
<!-- /header -->
