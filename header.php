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
	</head>
	<body ng-app="indyBlog">
		<div class="container-fluid">
			<header class="header">
				<div class="hidden-sm hidden-xs">
					<?php nav_bar("lg"); ?>
				</div>
				<div class="hidden-lg hidden-md">
					<?php nav_bar("xs"); ?>
				</div>
				<?php if (is_home()) : ?>
					<div class="row headercover text-center" style="background-image: url('<?php echo get_cover_homepage(); ?>');">
						<h1 class="headercover__title font-theme"><?php echo get_bloginfo( 'description' ); ?></h1>
						<div class="col-sm-offset-3 col-sm-6 headercover__search">
							<div class="col-xs-12">
								<?php search_form(); ?>
							</div>
						</div>
					</div>
				<?php endif; ?>
			</header>
