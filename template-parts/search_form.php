<?php
	// Search form by INDYTHEME.com
?>
<form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="input-group searchbar">
		<input type="text" class="form-control input-lg" name="s" placeholder="Search here.." autofocus>
		<span class="input-group-btn">
			<button class="btn btn-default btn-lg" type="submit">
				<i class="fa fa-search" aria-hidden="true"></i>
			</button>
		</span>
	</div>
</form>
