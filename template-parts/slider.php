<?php 
    $the_query = gen_query_post(array(
        'catID' => 'all',
        'orderBy' => 'new',
        'numberOfPost' => 3
    ));
?>

<?php if ( $the_query->have_posts() ) : ?>
    <div class="row slider d-none d-sm-block" id="indy_slider">
    <?php 
        while ($the_query->have_posts()) :
            $the_query->the_post();
            $postid = get_the_ID();
            $image = get_post_image_url($postid, "full")[0];
            $category = gen_category_detail(get_the_category());
            $url = esc_url(get_permalink($postid));
    ?>
        <?php if ($image) : ?>
        <div indy-img ng-style="wrapSize" class="slider__item text-center">
            <div class="row align-items-center" ng-show="loading" ng-style="{'height': hFrame}">
                <div class="col"><slide-loader/></div>
            </div>
            
            <div class="slider__title slider__title--1">
                <div class="row justify-content-center">
                    <div class="col-10 col-sm-11 col-md-10">
                        <div class="slider__category category__tag">
                            <?php foreach ($category as $cat) : ?>
                                <a href="<?php echo $cat['url']; ?>">
                                    <div class="item item--color-<?php echo ($cat['id']%5) ?>">
                                        <?php echo $cat['name']; ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo $url; ?>">
                            <h1 class="slider__text slider__text--1 font-theme"><?php the_title(); ?></h1>
                            <p class="slider__time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_post_time('l, j F Y', true); ?></p>
                        </a>
                    </div>
                </div>
            </div>
            <a href="<?php echo $url; ?>">
                <img class="fideIn" ng-hide="loading" ng-style="imgSize" ng-src="<?php echo $image; ?>" alt="">
            </a>
        </div>
        <?php else : ?>
        <div class="slider__item text-center" style="background-color: <?php echo gen_background_color($postid); ?>">
            <div class="slider__title slider__title--2">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 col-11">
                        <div class="slider__category category__tag">
                            <?php foreach ($category as $cat) : ?>
                                <a href="<?php echo $cat['url']; ?>">
                                    <div class="item item--color-<?php echo ($cat['id']%5) ?>">
                                        <?php echo $cat['name']; ?>
                                    </div>
                                </a>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?php echo $url; ?>">
                            <h1 class="slider__text slider__text--2 font-theme"><?php the_title(); ?></h1>
                            <p class="slider__time"><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo get_post_time('l, j F Y', true); ?></p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
    <?php endwhile; ?>
    </div>
<script>
$("#indy_slider").responsiveSlides({
    auto: true,
    speed: 500,
    timeout: 5000,
    pause: false,
    pauseControls: true,
    nav: true,
    // pager: true,
    prevText: "<i class='fa fa-chevron-circle-left'></i>",
    nextText: "<i class='fa fa-chevron-circle-right'></i>",
});
</script>

<?php endif; ?>