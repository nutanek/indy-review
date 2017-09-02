<?php get_header(); ?>

<?php $post_ID = get_the_ID(); ?>
<?php
	$category_detail = get_the_category($post->ID);
	foreach($category_detail as $ci) {
		$the_cat_id = $ci->cat_ID;
		$the_cat_name = $ci->cat_name;
	}
?>
<?php $post_title = get_the_title($post_ID); ?>
<?php set_post_views($post_ID) ?>

<article class="row" ng-controller="article">
	<div class="container">
		<div class="row article__header">
			<div class="col-xs-12">
				<div class="col-xs-12">
					<h1 class="article__title font-theme"><?php echo $post_title; ?></h1>
					<div class="row article__extension">
						<div class="col-sm-6 sub">
							<a href="<?php echo get_category_link($the_cat_id); ?>">
								<strong><?php echo $the_cat_name; ?></strong>
							</a> /
							<i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_time('j F Y', $post_ID); ?> /
							<i class="fa fa-eye" aria-hidden="true"></i> <?php echo get_post_views($post_ID) ?>
						</div>
						<div class="col-sm-6 text-right sub">
							<?php share_social($post_ID); ?>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="row">
			<div class="col-sm-8 article">
				<div class="col-xs-12">
					<div class="row">
						<div class="col-xs-12 article__content">
							<?php while ( have_posts() ) : the_post(); ?>
								<p><?php the_content(); ?></p>
							<?php endwhile; ?>
						</div>
						<?php  if (get_the_tags()) :?>
							<div class="col-md-12">
								<p><?php the_tags('<i class="fa fa-tags" aria-hidden="true"></i> ', ', ', '<br />'); ?></p><br/>
							</div>
						<?php endif;?>
					</div>
					<div class="row">
						<?php if (useComment('facebook')) :?>
							<div class="col-md-12 content__comment">
								<div class="fb-comments" data-href="<?php echo get_permalink(get_the_ID()); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
							</div>
						<?php endif;?>
						<?php if (useComment('wordpress')) :?>
							<div class="col-md-12 content__comment">
								<?php comments_template(); ?>
							</div>
						<?php endif;?>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<?php sidebar_new_category($the_cat_id, $post_ID, 5); ?>
			</div>
		</div>
	</div>
</article>

<?php get_footer(); ?>
