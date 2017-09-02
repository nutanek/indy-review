<div class="content__share">
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink($postID); ?>" class="share-content" target="_blank" title="share to Facebook">
        <div class="contentshare__button contentshare__button--facebook">
            <span><i class="fa fa-facebook-official" aria-hidden="true"></i></span>
            <span>share</span>
        </div>
    </a>
    <a href="https://twitter.com/intent/tweet?text=<?php echo $post_title ?>&url=<?php echo get_permalink($postID); ?>" class="share-content" target="_blank" title="tweet to Twitter">
        <div class="contentshare__button contentshare__button--twitter">
            <span><i class="fa fa-twitter" aria-hidden="true"></i></span>
            <span>tweet</span>
        </div>
    </a>
    <a href="https://plus.google.com/share?url=<?php echo get_permalink($postID); ?>" class="share-content" target="_blank" title="share to Google+">
        <div class="contentshare__button contentshare__button--google">
            <span><i class="fa fa-google-plus" aria-hidden="true"></i></span>
            <span>share</span>
        </div>
    </a>
</div>
