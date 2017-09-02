			<footer class="row footer text-center">
				<div class="col-xs-12">
					<?php wp_footer(); ?>
					<?php footer_widget(); ?>
					<?php copyright(); ?>
				</div>
			</footer>
		</div>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
	</body>
</html>
