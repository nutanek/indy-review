<?php
    $the_query = new WP_Query( array(
        'cat' => $catID,
        'posts_per_page' => $limit,
        'post__not_in' => array($postID)
    ) );
?>
<div class="col-xs-12">
    <div class="panel panel-default" style="margin-top: 30px;">
        <div class="panel-heading">
            <strong><?php echo get_cat_name($catID); ?></strong>
        </div>
        <div class="panel-body">
            <?php if ( $the_query->have_posts() ) : ?>
                <?php
                $count    = 0;
                while ( $the_query->have_posts() ) :
                  $the_query->the_post();
                  $postid = get_the_ID();
                  $count++;
                  $postPermalink = esc_url( get_permalink($postid) );
              ?>

              <?php $img = get_post_image_url( $postid, "medium" ); ?>

              <div class="row">
                  <a href="<?php echo $postPermalink; ?>">
                      <div class="col-xs-12 sidebar__list">
                          <div class="col-xs-12">
                              <div class="row sidebar__cover" indy-img wrap-height="0.5" ng-style="wrapSize">
                                  <img class="img" ng-style="imgSize" src="<?php echo $img[0]; ?>" />
                              </div>
                              <div class="row sidebar__title">
                                  <?php echo get_the_title() ?>
                              </div>
                          </div>
                      </div>
                  </a>
              </div>
              <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
