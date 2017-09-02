<p>
    <h2>indyBlog Footer by indyTheme.com</h2>
</p>
<p>
    <label>
        <input class="checkbox" type="checkbox" <?php checked( $instance['facebook_status'] ); ?>
            name="<?php echo $this->get_field_name( 'facebook_status' ); ?>" />
        <i class="fa fa-facebook-official" aria-hidden="true"></i> Facebook
    </label>
</p>
<p>
    <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'facebook_url' ); ?>"
        value="<?php echo esc_attr( $instance['facebook_url'] ); ?>" placeholder="https://www.facebook.com/indytheme">
</p>
<p>
    <label>
        <input class="checkbox" type="checkbox" <?php checked( $instance['twitter_status'] ); ?>
            name="<?php echo $this->get_field_name( 'twitter_status' ); ?>" />
        <i class="fa fa-twitter" aria-hidden="true"></i> Twitter
    </label>
</p>
<p>
    <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'twitter_url' ); ?>"
        value="<?php echo esc_attr( $instance['twitter_url'] ); ?>" placeholder="https://www.twitter.com/indytheme">
</p>
<p>
    <label>
        <input class="checkbox" type="checkbox" <?php checked( $instance['google_status'] ); ?>
            name="<?php echo $this->get_field_name( 'google_status' ); ?>" />
        <i class="fa fa-google-plus-official" aria-hidden="true"></i> Google plus
    </label>
</p>
<p>
    <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'google_url' ); ?>"
        value="<?php echo esc_attr( $instance['google_url'] ); ?>" placeholder="https://plus.google.com/indytheme">
</p>
<p>
    <label>
        <input class="checkbox" type="checkbox" <?php checked( $instance['instagram_status'] ); ?>
            name="<?php echo $this->get_field_name( 'instagram_status' ); ?>" />
        <i class="fa fa-instagram" aria-hidden="true"></i> Instagram
    </label>
</p>
<p>
    <input type="text" class="widefat" name="<?php echo $this->get_field_name( 'instagram_url' ); ?>"
        value="<?php echo esc_attr( $instance['instagram_url'] ); ?>" placeholder="https://www.instagram.com/indytheme">
</p>
