<?php get_header(); ?>
<?php get_componet('slider'); ?>

<div class="row posts justify-content-center">
    <div class="col-xl-10 col-lg-10 col-12">
        <?php 
            get_componet('posts', array(
                'category' => 'all'
            )); 
        ?>
    </div>
</div>

<?php get_footer(); ?>