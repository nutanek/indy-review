<div class="fb-comments" data-href="<?php echo get_permalink(); ?>" data-width="100%" data-numposts="5" data-colorscheme="light"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<?php if (false) : ?>
<?php
	if ( post_password_required() ) {
		return;
	}
?>
<div id="comments">
	<?php if ( have_comments() ) : ?>
		<?php the_comments_navigation(); ?>
		<?php foreach ($comments as $comment) : ?>
			<div class="row">
				<div class="col-3 col-sm-2 comment__avatar text-center">
					<?php echo get_avatar( get_comment_author_email() , 80 ); ?>
				</div>
				<div class="col">
					<span class="comment__author"><?php comment_author_link() ?></span> <span class="comment__date">on <a href="#comment-<?php comment_ID() ?>" title=""><?php echo get_the_date() ?> <?php the_time() ?> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></a></span>
					<?php comment_text() ?>
				</div>
			</div>
			<hr>
		<?php endforeach; ?>
		<?php the_comments_navigation(); ?>
	<?php endif; ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
	<?php endif; ?>
	<?php
		comment_form(array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'title_reply' => '',
			'comment_notes_before' => ''
		));
	?>
</div><!-- .comments-area -->

<?php endif; ?>