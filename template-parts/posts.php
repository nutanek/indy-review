<div ng-controller="postsController">
    <div class="row">
        <div class="col text-right">
            <sort-selector sort-by="sortBy(option)"></sort-selector>
        </div>
    </div>
    <div class="row posts__body" ng-show="showContent" masonry='{ "transitionDuration" : "0.4s" , "itemSelector" : ".tile"}'>
        <?php 
            $options = array(
                'posts_per_page' => get_option('posts_per_page'),
                'paged' => 1
            );
            if ($data['category'] !== 'all') {
                $options['cat'] = $data['category'];
            }
            if ($data['orderBy'] == 'score') {
                $options['orderby'] = 'meta_value';
                $options['meta_query'] = array(
                    'relation' => 'OR',
                    array(
                        'key' => 'indyreview_rating_avg',
                        'compare' => 'NOT EXISTS'
                    ),
                    array(
                        'key' => 'indyreview_rating_avg',
                        'type' => 'numeric'
                    )
                );
            }
            $the_query = new WP_Query($options);
        ?>

        <?php if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) :
                $the_query->the_post();
                $postid = get_the_ID();
                $img = get_post_image_url( $postid, "medium" );
                $category_detail = get_the_category();
                $postPermalink = esc_url( get_permalink($postid) );
                $category = array();
                foreach($category_detail as $key=>$value) {
                    array_push($category, array(
                        'id' => $value->cat_ID,
                        'name' => $value->cat_name,
                        'url' => esc_url(get_category_link($value->cat_ID))
                    ));
                }
                $content = wp_strip_all_tags(get_the_content());
                $content = preg_replace("/&nbsp;/",'', add3dots($content, '...', 120));
        ?>        
        <?php 
            get_componet('post-item', array(
                'image' => $img[0],
                'category' => $category,
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
    <div class="row posts__loader align-items-center" ng-show="isLoading">
        <div class="col text-center">
            <slide-loader/>
        </div>
    </div>
    <div class="row posts__loadmore font-theme" ng-show="showLoadMore">
        <div class="col text-center">
            <button class="btn btn-lg btn-info" ng-click="loadMore()" >
                <?php echo __indy('load_more'); ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</div>
