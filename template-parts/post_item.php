<div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 postitem grid-item">
    <div class="col card no-padding">
        <?php if ($data['image']) : ?>
        <a href="<?php echo $data['post_url']; ?>">
            <div style="overflow: hidden">
                <img class="card-img-top img_effect" src="<?php echo $data['image']; ?>">
            </div>
        </a>
        <?php endif; ?>
        <div class="card-body">
            <b class="card-text font-theme" style="font-size: 20pt; line-height: 1.1em"><?php echo $data['title']; ?></b>
            <p><?php echo $data['cat_name']; ?></p>
            <p><?php echo $data['content']; ?></p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-7">
                    <small class="text-muted postitem__time">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>&nbsp;
                        <?php echo $data['post_time']; ?>
                    </small>
                </div>
                <div class="col text-right">
                    <post-rating />
                </div>
            </div>
        </div>
    </div>
</div>