<?php get_header(); ?>
<?php get_componet('slider'); ?>

<div class="finish-rating">

</div>

<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-10 col-12">
        <div class="row grid">

        <?php if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                $postid = get_the_ID();
                $img = get_post_image_url( $postid, "medium" );
                $category_detail = get_the_category();
                $postPermalink = esc_url( get_permalink($postid) );
              	foreach($category_detail as $ci) {
              		$the_cat_id = $ci->cat_ID;
              		$the_cat_name = $ci->cat_name;
              	}
                $catPermalink = esc_url( get_category_link($the_cat_id) );
                $content = wp_strip_all_tags(get_the_content());
                $content = preg_replace("/&nbsp;/",'', mb_substr($content, 0, 120));
        ?>        
        <?php 
            get_componet('post-item', array(
                'image' => $img[0],
                'cat_ID' => $the_cat_id,
                'cat_name' => $the_cat_name,
                'cat_url' => $catPermalink,
                'title' => get_the_title(),
                'post_ID' => $postid,
                'post_time' => get_post_time('j M Y', true),
                'post_url' => $postPermalink,
                'content' => $content
            )); 
        ?>
        <?php endwhile; else: ?>
            <div class="row">
				<div class="col-xs-12 text-center">
					<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				</div>
			</div>
		<?php endif; ?>


        </div>
    </div>
</div>

<?php get_footer(); ?>