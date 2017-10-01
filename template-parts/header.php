<header class="header" ng-controller="header">
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
