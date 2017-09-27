<?php
    global $wp_query;
    $big = 999999999;
    $pages = paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?page=%#%',
            'total' => $wp_query->max_num_pages,
            'current' => max( 1, get_query_var( 'paged') ),
            'show_all' => false,
            'end_size' => 2,
            'mid_size' => 2,
            'prev_next' => True,
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
            'type'  => 'array'
        )
    );
?>

<div class="d-none d-lg-block">
    <div class="row paging justify-content-center">
        <?php
            if( is_array( $pages ) ) {
                $paged = get_query_var('paged');
                $pagination = '<div class="btn-group" role="group">';
                foreach ( $pages as $page ) {
                    $pagination .= "<button type='button' class='btn btn-lg btn-secondary'>$page</button>";
                }
                $pagination .= '</div>';
                echo $pagination;
            }
        ?>
    </div>
</div>

<div class="d-lg-none">
    <div class="paging row">
        <?php if (get_query_var('paged') == 0) : ?>
            <div class="col-7"></div>
        <?php endif; ?>
        <?php
            posts_nav_link(
                '<div class="col"></div>',
                '<div class="col-5 text-left">
                    <button type="button" class="btn btn-lg btn-secondary">
                        <i class="fa fa-chevron-left" aria-hidden="true"></i> '.__('Previous').'
                    </button>
                </div>',
                '<div class="col-5 text-right">
                    <button type="button" class="btn btn-lg btn-secondary">
                        '.__('Next').' <i class="fa fa-chevron-right" aria-hidden="true"></i>
                    </button>
                </div>'
            );
        ?>
    </div>
</div>

