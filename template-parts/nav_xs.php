<?php
    $menuList = get_list_indyblog('indyblog_ordered_categories');
    if (is_user_logged_in()) {
        $topNav = 90;
    } else {
        $topNav = 50;
    }
?>
<div nav-slider top=<?php echo $topNav; ?> class="font-theme">
    <div class="row navxs">
        <div class="col-xs-8">
            <a href="<?php echo site_url(); ?>">
                <img class="navxs__logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo">
            </a>
        </div>
        <div class="col-xs-4 text-right navxs__toggle" ng-click="toggle()">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
    </div>
    <div class="row navxs__slider animated" ng-class="effect" ng-style="{'height': menuHeight+'px'}" ng-show="toggleStatus">
        <ul>
            <a href="<?php echo site_url(); ?>">
                <li>
                    <i class="fa fa-play" aria-hidden="true"></i> <?php echo __('หน้าแรก'); ?>
                </li>
            </a>
            <?php foreach ($menuList as $menu) : ?>
                <a href="<?php echo esc_url(get_category_link($menu)) ?>">
                    <li>
                        <i class="fa fa-play" aria-hidden="true"></i> <?php echo get_cat_name($menu); ?>
                    </li>
                </a>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
