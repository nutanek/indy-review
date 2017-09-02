<?php get_header(); ?>
<div class="row headercover--cat text-center" style="background-image: url('<?php echo get_cover_homepage(); ?>');">
	<h1 class="title font-theme">
		<p>ผลการค้นหา:</p>
		<p><?php echo $s; ?></p>
		<div class="col-sm-offset-3 col-sm-6 headercover__search">
			<div class="col-xs-12 font-normal">
				<?php search_form(); ?>
			</div>
		</div>
	</h1>
</div>
<article class="row">
    <div class="container listcontent">
        <div class="row">

        <?php if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                $count++;
                $postid = get_the_ID();
                $img = get_post_image_url( $postid, "large" );
                $category_detail = get_the_category($postid);
                $postPermalink = esc_url( get_permalink($postid) );
              	foreach($category_detail as $ci) {
              		$the_cat_id = $ci->cat_ID;
              		$the_cat_name = $ci->cat_name;
              	}
                $catPermalink = esc_url( get_category_link($the_cat_id) );
        ?>
            <section class="col-md-4 col-sm-6 col-xs-12">
				<?php if ($the_cat_id) : ?>
	                <a href="<?php echo $catPermalink; ?>" target="_blank">
	                    <div class="tag tag--<?php echo $the_cat_id%5 ?>">
	                        <?php echo $the_cat_name; ?>
	                    </div>
	                </a>
				<?php endif; ?>
                <a href="<?php echo $postPermalink; ?>" target="_blank">
                    <div class="col-xs-12 boxshadow listcontent__section">
                        <div class="row cover" indy-img wrap-height="0.8" ng-style="wrapSize">
                            <img class="img" ng-style="imgSize" src="<?php echo $img[0]; ?>" />
                        </div>
                        <div class="row detail">
                            <div class="col-xs-12">
                                <h2 class="title"><?php the_title(); ?></h2>
                            </div>
                            <div class="col-xs-12 extension">
                                <div class="row">
                                    <div class="col-xs-6 text-left">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_the_time('j F Y', $postid); ?>
                                    </div>
                                    <div class="col-xs-6 text-right">
                                        <i class="fa fa-eye" aria-hidden="true"></i> <?php echo get_post_views($postid) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </section>
            <?php if ($count%3 == 0) : ?>
                <div class="col-xs-12 hidden-sm"></div>
            <?php elseif ($count%2 == 0) : ?>
                <div class="col-xs-12 visible-sm"></div>
            <?php endif; ?>
        <?php endwhile; else: ?>
            <div class="row text-center">
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
			</div>
		<?php endif; ?>

        </div>
        <div class="row text-center">
			<div class="col-xs-12">
				<?php indyblog_pagination(); ?>
			</div>
		</div>
    </div>
</article>

<?php get_footer(); ?>
