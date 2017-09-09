			<footer class="row footer text-center">
				<div class="col-xs-12">
					<?php wp_footer(); ?>
					<?php footer_widget(); ?>
					<?php copyright(); ?>
				</div>
			</footer>
		</div>
		<script src="https://unpkg.com/masonry-layout@4.2.0/dist/masonry.pkgd.min.js"></script>
		<script src="https://unpkg.com/imagesloaded@4.1.3/imagesloaded.pkgd.min.js"></script>
		<script>
			$(document).ready(function () {
				var $container = $('.grid');
				$container.imagesLoaded( function() {
					$container.masonry({
						itemSelector: ".grid-item",
						layoutMode: 'masonry',
						transitionDuration: '0.5s'
					});
				});
			});
			
		</script>
	</body>
</html>
