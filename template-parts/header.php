<header class="header" ng-controller="header">
    <div class="row headertop justify-content-center">
        <div class="col-md-11">
            <div class="row align-items-center">
                <div class="col" >
                    social
                </div>
                <div class="col-md-7 col-12 headertop__logo">
                    <div class="row text-center">
                        <img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" class="img-fluid mx-auto d-block" alt="logo">
                    </div>
                </div>
                <div class="col headertop__search" >
                    <?php get_component('search-form'); ?>
                </div>
            </div>
        </div>
    </div>
</header>
