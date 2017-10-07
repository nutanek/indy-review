<?php require_once ('../../../../wp-config.php'); ?>
<?php if (current_user_can('manage_options')) : ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000000">
    <script>
        <?php
            $userID = get_current_user_id();
            $user_info = get_userdata($userID);
        ?>
        var config = {
            rootUrl: "<?php echo get_site_url(); ?>",
            themeUrl: "<?php echo get_template_directory_uri(); ?>",
            setting: {
                profile: "<?php echo get_edit_user_link(); ?>",
                category: "<?php echo admin_url('edit-tags.php?taxonomy=category')?>"
            },
            admin: {
                id: <?php echo $user_info->ID; ?>,
                name: "<?php echo $user_info->user_nicename; ?>",
                email: "<?php echo $user_info->user_email; ?>",
                profile_img: "<?php echo get_avatar_indy_url( $user_info->user_email, 200); ?>",
            }
        };
    </script>
    <script async src="./build/bundle.js"></script>
    <title>IndyReview Manager</title>
  </head>
  <body>
    <noscript>
      You need to enable JavaScript to run this app.
    </noscript>
    <div id="root"></div>
  </body>
</html>
<?php endif; ?>