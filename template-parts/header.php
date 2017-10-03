<div class="headerxs d-md-none">
    <div class="row">
        <div class="col headerxs__logo">
            <a href="<?php echo get_home_url(); ?>">
                <img src="<?php echo get_logo(); ?>" alt="logo">
            </a>
        </div>
        <div class="col headerxs__menu text-right">
            <i class="fa fa-bars" aria-hidden="true" ng-click="toggleNav(true)"></i>
        </div>
    </div>
</div>
<div class="headerxs__back d-md-none"></div>
<header class="header d-none d-md-block">
    <div class="row headertop justify-content-center">
        <div class="col-md-11">
            <div class="row align-items-center">
                <div class="col headertop__social" >
                    <?php get_component('social-following'); ?>
                </div>
                <div class="col-md-7 col-12 headertop__logo">
                    <div class="row justify-content-center">
                        <a href="<?php echo get_home_url(); ?>">
                            <img src="<?php echo get_logo(); ?>" class="img-fluid mx-auto d-block" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="col headertop__search" >
                    <?php get_component('search-form'); ?>
                </div>
            </div>
        </div>
    </div>
</header>
