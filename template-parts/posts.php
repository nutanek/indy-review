<?php 
    $the_query = gen_query_post(array(
        'catID' => $data['category'],
        'orderBy' => 'new',
        'page' => 1,
        'tag' => $data['tag'],
        'search' => $data['search'],
    ));
?>
<div ng-controller="postsController" 
    ng-init="
        extension = {
            tag: '<?php echo $data['tag']; ?>',
            search: '<?php echo $data['search']; ?>',
            catID: <?php echo $data['category']; ?> }">
  
    <div class="row">
        <?php if ( $the_query->have_posts() ) : ?>
        <div class="col text-right">
            <sort-selector sort-by="sortBy(option)"></sort-selector>
        </div>
        <?php endif; ?>
    </div>
    
    <?php if ( $the_query->have_posts() ) : ?>
        <div class="row posts__body" ng-show="showContent" 
            masonry='{ 
                "transitionDuration" : "0.4s" , 
                "itemSelector" : ".tile"}'>
            <?php
                $postTotal = $the_query->post_count;
                while ($the_query->have_posts()) :
                    $the_query->the_post();
                    $postid = get_the_ID();
            ?>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 postitem tile"  masonry-tile>
                <?php
                    get_component('post-item', array(
                        'post_ID' => $postid,
                        'title' => get_the_title(),
                        'image' => get_post_image_url($postid, "medium")[0],
                        'post_time' => get_post_time('j M Y', true),
                        'post_url' => esc_url(get_permalink($postid)),
                        'content' => gen_summary(get_the_content(), 120),
                        'category' => gen_category_detail(get_the_category())
                    ));
                ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <div class="col posts__empty text-center">
            <img src="<?php echo get_template_directory_uri(); ?>/images/no_result.svg" />
            <p><?php echo __indy('no_posts_matched'); ?></p>
        </div>
    <?php endif; ?>

    <div class="row posts__loader align-items-center" ng-show="isLoading">
        <div class="col text-center">
            <slide-loader/>
        </div>
    </div>
    
    <?php if ($postTotal >= get_option('posts_per_page')) : ?>
    <div class="row posts__loadmore font-theme" ng-show="showLoadMore">
        <div class="col text-center">
            <button class="btn btn-lg btn-info" ng-click="loadMore()" >
                <?php echo __indy('load_more'); ?>
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </button>
        </div>
    </div>
    <?php endif; ?>
</div>
