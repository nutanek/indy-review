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
<div class="paging hidden-xs">
    <?php
        if( is_array( $pages ) ) {
            $paged = get_query_var('paged');
            $pagination = '<ul class="pagination">';
            foreach ( $pages as $page ) {
                $pagination .= "<li>$page</li>";
            }
            $pagination .= '</ul>';
            echo $pagination;
        }
    ?>
</div>
<div class="paging visible-xs">
    <?php if (get_query_var('paged') == 0) : ?>
        <div class="col-xs-7"></div>
    <?php endif; ?>
    <?php
        posts_nav_link(
            '<div class="col-xs-2"></div>',
            '<div class="col-xs-5 text-left">
                <button type="button" class="btn btn-lg btn-default">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> '.__('Previous').'
                </button>
            </div>',
            '<div class="col-xs-5 text-right">
                <button type="button" class="btn btn-lg btn-default">
                    '.__('Next').' <i class="fa fa-chevron-right" aria-hidden="true"></i>
                </button>
            </div>'
        );
    ?>
</div>
