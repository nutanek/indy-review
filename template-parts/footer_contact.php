<div class="row footer__contact">
    <div class="col-xs-12">
        <?php if ($instance['facebook_status']) : ?>
            <a href="<?php echo $instance['facebook_url']?>" target="_blank" class="footer__contact--fb">
                <i class="fa fa-facebook-official" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
        <?php if ($instance['twitter_status']) : ?>
            <a href="<?php echo $instance['twitter_url']?>" target="_blank" class="footer__contact--tw">
                <i class="fa fa-twitter" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
        <?php if ($instance['google_status']) : ?>
            <a href="<?php echo $instance['google_url']?>" target="_blank" class="footer__contact--gg">
                <i class="fa fa-google-plus-official" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
        <?php if ($instance['instagram_status']) : ?>
            <a href="<?php echo $instance['instagram_url']?>" target="_blank" class="footer__contact--ig">
                <i class="fa fa-instagram" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
    </div>
</div>
