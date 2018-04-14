<?php $menu = Theme_Helpers::get_menu(); ?>
<div class="col-12 resmenu animated font-theme d-md-none" ng-show="navStatus || isBusy" ng-cloak
    ng-class="navStatus ? 'fadeInRightBig' : 'fadeOutRightBig'">
	<div class="row resmenu__close justify-content-end">
	    <i class="fa fa-times" aria-hidden="true" ng-click="toggleNav(false)"></i>
	</div>
	<div class="row resmenu__search justify-content-center">
		<div class="col-9 font-normal">
		    <?php Theme_Helpers::get_component('search-form'); ?>
		</div>
	</div>
	<div class="row resmenu__item justify-content-center">
        <a href="<?php echo get_home_url(); ?>"><?php echo Theme_Locale::get('home'); ?></a>
	</div>
	<?php foreach ($menu as $key=>$item) : ?>
	<div class="row resmenu__item justify-content-center">
        <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>
    </div>
	<?php endforeach; ?>
</div>