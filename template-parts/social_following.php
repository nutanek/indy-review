<?php 
    $socials = get_social(); 
    $list = array(
        array('name' => 'facebook', 'icon' => 'facebook', 'url' => 'https://www.facebook.com/'),
        array('name' => 'twitter', 'icon' => 'twitter', 'url' => 'https://twitter.com/'),
        array('name' => 'google', 'icon' => 'google-plus', 'url' => 'https://plus.google.com/'),
        array('name' => 'linkedin', 'icon' => 'linkedin', 'url' => 'https://www.linkedin.com/in/'),
        array('name' => 'youtube', 'icon' => 'youtube-play', 'url' => 'https://www.youtube.com/channel/'),
        array('name' => 'instagram', 'icon' => 'instagram', 'url' => 'https://www.instagram.com/')
    );
?>
<?php foreach ($list as $item) : ?>
    <?php if ($socials[$item['name']]) : ?>
    <a href="<?php echo $item['url'].$socials[$item['name']]; ?>" target="_blank">
        <i class="item item--<?php echo $item['name']; ?> fa fa-<?php echo $item['icon']; ?>" aria-hidden="true"></i>
    </a>
    <?php endif; ?>
<?php endforeach; ?>