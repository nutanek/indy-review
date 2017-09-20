<?php get_header(); ?>

<?php 
	$post_ID = get_the_ID(); 
	$category = gen_category_detail(get_the_category());
?>


<?php set_post_views($post_ID) ?>

<article class="row article justify-content-center" style="background: #f5f5f5" ng-controller="article">
	<div class="col-12 article__header text-center" 
		style="background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
			 url('<?php echo get_post_image_url($post_ID, "large")[0]; ?>');">
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
			<div class="col-xl-9 col-lg-8 col-12 article__content frame">
				<div class="card">
					<div class="card-body">
						<?php while ( have_posts() ) : the_post(); ?>
							<p><?php the_content(); ?></p>
						<?php endwhile; ?>
					</div>
				</div>
			</div>
			<div class="col frame">
				<div class="card">
					<div class="card-body">
					sdsd
					</div>
				</div>
			</div>
		</div>
	</div>
		
</article>


<?php get_footer(); ?>
