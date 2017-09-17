<?php get_header(); ?>

<div class="row posts justify-content-center">
    <div class="col-xl-10 col-lg-10 col-12">
        <?php
            get_componet('posts', array(
                'category' => 'all',
                'search' => $s
            )); 
        ?>
    </div>
</div>

<?php get_footer(); ?>
