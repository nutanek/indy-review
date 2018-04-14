<?php get_header(); ?>
<?php 
	$post_ID = get_the_ID(); 
	$category = Theme_Helpers::gen_category_detail(get_the_category());
	$image = Theme_Helpers::get_post_image_url($post_ID, "large")[0];
	Theme_Helpers::set_post_views($post_ID);
?>
<article class="row article justify-content-center" ng-controller="article">
	<div class="col-12 article__header text-center" style="
		<?php if ($image) : ?>
			background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(<?php echo $image; ?>)
		<?php else : ?>
			background-color: <?php echo Theme_Helpers::gen_background_color($post_ID); ?>
		<?php endif; ?>">
		<div class="row justify-content-center">
			<div class="col-xl-7 col-lg-9 col-11">
				<h1 class="font-theme"><?php the_title(); ?></h1>
				<div class="article__category category__tag">
					<?php foreach ($category as $cat) : ?>
						<a href="<?php echo $cat['url']; ?>">
							<div class="item item--color-<?php echo ($cat['id']%5) ?>">
								<?php echo $cat['name']; ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-xl-10 col-lg-12 col-12">
		<div class="row">
			<div class="col d-lg-none">
				<?php 
					Theme_Helpers::get_component('social-sharing', array(
						"url" => get_permalink(),
						"title" => get_the_title()
					)); 
				?>
			</div>
			<div class="col-xl-9 col-lg-8 col-12 article__content frame">
				<div class="card">
					<div class="card-body">
						<?php while ( have_posts() ) : the_post(); ?>
							<p><?php the_content(); ?></p>
						<?php endwhile; ?>
					</div>
				</div>
				<div class="card widget">
					<div class="card-body">
						<?php comments_template(); ?>
					</div>
				</div>
			</div>
			<aside class="col">
				<div class="d-none d-lg-block">
					<?php 
						Theme_Helpers::get_component('social-sharing', array(
							"url" => get_permalink(),
							"title" => get_the_title()
						)); 
					?>
				</div>
				<div class="card widget">
					<div class="card-body">
						<content-rating post-id="<?php echo $post_ID; ?>"></content-rating>
					</div>
				</div>
				<?php Theme_Helpers::get_component('new-posts', array('limit' => 3)); ?>
			</aside>
		</div>
	</div>
</article>
<?php get_footer(); ?>
