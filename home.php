<?php get_header(); ?>
<?php get_componet('slider'); ?>

<div class="row justify-content-center" style="background: #f5f5f5">
    <div class="col-xl-10 col-lg-10 col-12">
        <?php 
            get_componet('posts', array(
                'category' => 'all',
                'orderBy' => 'score',
            )); 
        ?>
    </div>
</div>

<?php get_footer(); ?>