<?php
    $menuList = get_list_indyblog('indyblog_ordered_categories');
?>
<nav class="row navlg">
    <div class="col-xs-12">
        <div class="col-xs-3">
            <a href="<?php echo site_url(); ?>">
                <img class="navlg__logo" src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="logo">
            </a>
        </div>
        <div class="col-xs-9 navlg__menu text-right font-theme">
            <a href="<?php echo site_url(); ?>">
                <div class="item">
                    <?php echo __('หน้าแรก'); ?>
                </div>
            </a>
            <?php foreach ($menuList as $menu) : ?>
                <a href="<?php echo esc_url(get_category_link($menu)) ?>">
                    <div class="item">
                        <?php echo get_cat_name($menu); ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>
</nav>
