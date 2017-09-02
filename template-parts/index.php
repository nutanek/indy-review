<?php require_once ('../../../../wp-config.php'); ?>
<?php if (current_user_can('manage_options')) : ?>
<!DOCTYPE html>
<html ng-app="indyManager">
  <head>
    <title ng-bind="title +' - indyBlog'">Dashboard</title>
    <meta charset="utf-8" />
    <?php
        $userID = get_current_user_id();
        $user_info = get_userdata($userID);
    ?>
    <script>
        var config = {
            "site_url": "<?php echo site_url(); ?>",
            "theme_url": "<?php echo get_template_directory_uri(); ?>",
            "setting": {
                "category": "<?php echo admin_url('edit-tags.php?taxonomy=category')?>"
            },
            "admin": {
                "id": <?php echo $user_info->ID; ?>,
                "name": "<?php echo $user_info->user_nicename; ?>",
                "email": "<?php echo $user_info->user_email; ?>",
                "profile_img": "<?php echo get_avatar_indy_url( $user_info->user_email, 200); ?>",
            }
        };
    </script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/angular.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/lodash.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>//manager/js/angular-route.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>//manager/js/angular-dragable.min.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/controllers.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/services.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/directives.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/routes.js"></script>
    <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/manager/js/toast.js"></script>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/animate.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/manager/css/toast.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/manager/css/style.css" />
    <script type="text/javascript">
        toastr.options = {
          "debug": false,
          "closeButton": true,
          "positionClass": "toast-bottom-right",
        }
    </script>
  </head>
  <body>
    <div class="container-fluid">
        <header class="row header">

        </header>
        <?php if (current_user_can('manage_options')) : ?>
            <div class="row body">
                <sidebar></sidebar>
                <div class="col-md-10 col-sm-8 content" menu-height ng-style="{'height': menuHeight}">
                    <div ng-view></div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>
<?php endif; ?>
