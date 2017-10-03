<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<title><?php wp_title( '-', true, 'right' ); ?></title>
		<meta name="description" content="<?php bloginfo('description'); ?>" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.png" type="image/x-icon"/>
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<?php wp_head(); ?>
		<script>
			var indyConfig = <?php echo get_theme_config(); ?>;
		</script>
	</head>
	<body ng-app="indyReview">
		<div class="container-fluid">
			<div ng-controller="header">
			<?php get_component('header'); ?>
			<?php get_component('nav-lg'); ?>
			<?php get_component('nav-xs'); ?>
			</div>
		
