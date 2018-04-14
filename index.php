<?php get_header(); ?>
<article class="row article justify-content-center" ng-controller="article">
	<div class="col-12 col-lg-10">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<div class="card widget">
  			<div class="card-body">
				<h1 class="card-title article__title font-theme text-center"><?php the_title(); ?></h1>  
				<div class="article__content">
					<?php
						if ( has_post_thumbnail() ) {
							the_post_thumbnail();
						}
					?>
					<p><?php the_content(); ?></p>
				</div>
				
			</div>
		</div>
		<?php endwhile; ?> 
			<?php Theme_Helpers::get_component('pagination'); ?>
		<?php else: ?>
			<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
		<?php endif; ?>
	</div>
</article>
<?php get_footer(); ?>
