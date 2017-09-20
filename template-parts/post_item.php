<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 postitem tile"  masonry-tile>
    <div class="col card no-padding">
        <?php if ($data['image']) : ?>
        <a href="<?php echo $data['post_url']; ?>" target="_blank">
            <div style="overflow: hidden">
                <img class="card-img-top img_effect" src="<?php echo $data['image']; ?>">
            </div>
        </a>
        <?php endif; ?>
        <div class="card-body">
            <div class="postitem__category category__tag">
                <?php foreach($data['category'] as $cat) : ?>
                <a href="<?php echo $cat['url']; ?>">
                    <div class="item item--color-<?php echo ($cat['id']%5) ?>">
                        <?php echo $cat['name']; ?>
                    </div>
                </a>
                <?php endforeach; ?>
            </div>
            <a href="<?php echo $data['post_url']; ?>" target="_blank">
                <h2 class="card-text postitem__title font-theme"><?php echo $data['title']; ?></h2>
            </a>
            <p class="postitem__description"><?php echo $data['content']; ?></p>
        </div>
        <div class="card-footer">
            <div class="row align-items-center">
                <div class="col-7">
                    <small class="text-muted postitem__time">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                        <?php echo $data['post_time']; ?>
                    </small>
                </div>
                <div class="col text-right">
                    <post-rating post-id="<?php echo $data['post_ID']; ?>"/>
                </div>
            </div>
        </div>
    </div>
</div>