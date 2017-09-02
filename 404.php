<?php get_header(); ?>
	<div class="container text-center page404">
		<div class="row">
			<div class="col-xs-12">
				<img src="<?php echo get_template_directory_uri(); ?>/images/404.png" />
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12">
				<form class="form-inline" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="form-group">
					  <input type="text" class="form-control" name="s" placeholder="Enter search">
					</div>
					<button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
				</form>
			</div>
		</div>
	</div>
<?php get_footer(); ?>
