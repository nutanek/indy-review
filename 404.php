<?php get_header(); ?>
<div class="row page404">
	<div class="col-12 text-center">
		<div class="row item">
			<div class="col-12">
				<img src="<?php echo get_template_directory_uri(); ?>/images/404.svg" />
			</div>
		</div>
		<div class="row item">
			<div class="col-12">
				<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'twentysixteen' ); ?></h1>
				<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'twentysixteen' ); ?></p>
			</div>
		</div>
		<div class="row item justify-content-center">
			<form class="col-lg-4" method="get"  action="<?php echo esc_url( home_url( '/' ) ); ?>">
    			<div class="input-group">
				<input type="text" class="form-control" name="s" placeholder="<?php echo Theme_Locale::get('enter_search'); ?>">
				<span class="input-group-btn">
					<button type="submit" class="btn btn-secondary" type="button"><i class="fa fa-search"></i></button>
				</span>
				</div>
			</form>
		</div>
	</div>
</div>
	
<?php get_footer(); ?>
