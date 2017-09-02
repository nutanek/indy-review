<?php
	if ( post_password_required() ) {
		return;
	}
?>
<div id="comments" class="comments-area">
	<?php if ( have_comments() ) : ?>
		<?php $comment_count = get_comments_number(); ?>
		<div class="col-md-12 stat">
			<?php echo $comment_count ?>
			<?php if ($comment_count <= 1) : ?>
				comment
			<?php else : ?>
				comments
			<?php endif; ?>
		</div>
		<?php the_comments_navigation(); ?>
		<?php foreach ($comments as $comment) : ?>
				<div class="contentcomment__wrap">
					<div class="row">
						<div class="col-md-12">
							<div class="avatar">
								<?php echo get_avatar( get_comment_author_email() , 60 ); ?>
							</div>
							<div class="comment">
								<div class="header">
									<span class="author"><?php comment_author_link() ?></span> <span class="date">on <a href="#comment-<?php comment_ID() ?>" title=""><?php echo get_the_date() ?> <?php the_time() ?> <?php edit_comment_link('edit','&nbsp;&nbsp;',''); ?></a></span>
								</div>
								<div class="detail">
									<?php comment_text() ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php endforeach; /* end for each comment */ ?>
		<?php the_comments_navigation(); ?>
	<?php endif; // Check for have_comments(). ?>
	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'twentysixteen' ); ?></p>
	<?php endif; ?>
	<?php
		comment_form( array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
			'title_reply' => '',
			'comment_notes_before' => ''
		) );
	?>
</div><!-- .comments-area -->
