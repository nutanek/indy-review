<?php get_header(); ?>

<div class="row posts justify-content-center">
<div class="col-12 text-center font-theme" style="padding-top: 30px;">
        <h1><?php echo $s; ?></h1>
    </div>
    <div class="col-xl-10 col-lg-10 col-12">
        <?php
            Theme_Helpers::get_component('posts', array(
                'category' => 'all',
                'search' => $s
            )); 
        ?>
    </div>
</div>

<?php get_footer(); ?>
