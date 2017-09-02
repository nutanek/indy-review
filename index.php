<?php get_header(); ?>
<div class="row headercover--cat text-center" style="background-image: url('<?php echo get_cover_homepage(); ?>');">
	<h1 class="title font-theme"><?php the_title(); ?></h1>
</div>
<article class="row">
    <div class="container listcontent article__content">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	        <div class="row">
				<div class="col-xs-12">
					<?php
					if ( has_post_thumbnail() ) {
						the_post_thumbnail();
					}
					?>
					<p><?php the_content(); ?></p>
				</div>
			</div>
			<div class="row text-center">
				<div class="col-xs-12">
					<?php indyblog_pagination(); ?>
				</div>
			</div>
		<?php endwhile; else: ?>
			<div class="row">
				<div class="col-xs-12 text-center">
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				</div>
			</div>
		<?php endif; ?>
	</div>
</article>
<?php get_footer(); ?>
