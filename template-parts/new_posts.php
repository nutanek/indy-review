<?php 
    $the_query = gen_query_post(array(
        'catID' => 'all',
        'orderBy' => 'new',
        'numberOfPost' => $data['limit'],
        'exclude' => array(get_the_ID())
    ));
?>

<?php if ( $the_query->have_posts() ) : ?>
    <?php
        $postTotal = $the_query->post_count;
        while ($the_query->have_posts()) :
        $the_query->the_post();
        $postid = get_the_ID();
    ?>
    <div class="widget">
    <?php
        get_component('post-item', array(
            'post_ID' => $postid,
            'title' => get_the_title(),
            'image' => get_post_image_url($postid, "medium")[0],
            'post_time' => get_post_time('j M Y', true),
            'post_url' => esc_url(get_permalink($postid)),
            'content' => gen_summary(get_the_content(), 120),
            'category' => gen_category_detail(get_the_category())
        ));
    ?>
    </div>
    <?php endwhile; ?>
<?php endif; ?>