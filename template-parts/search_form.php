<form class="input-group" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="text" class="form-control" name="s" placeholder="<?php echo __indy('enter_search'); ?>" value="<?php echo $s; ?>">
    <span class="input-group-btn">
    	<button type="submit" class="btn btn-secondary">
			<i class="fa fa-search" aria-hidden="true"></i>
		</button>
    </span>
</form>
