<?php $menu = get_menu(); ?>
<nav class="row headernav--lg justify-content-center">
    <div class="col-md-11">
        <ul class="row justify-content-center font-theme">
            <li class="headernav--lg__menu --color-0">
                <a href="<?php echo get_home_url(); ?>"><?php echo __indy('home'); ?></a>
            </li>
            <?php foreach ($menu as $key=>$item) : ?>
            <li class="headernav--lg__menu --dotted --color-<?php echo (($key+1)%5); ?>">
                <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>
