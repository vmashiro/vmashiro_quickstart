<?php
/**
 * File used for homepage static page hero blog module
 *
 * @package WordPress
 */
?>
<div class="container">
	<div class="jumbotron">
		<div class="row">
			<div class="col-md-12">
				  <?php
					$recentPosts = new WP_Query();
					$recentPosts->query('showposts=1');
				?>
				<?php global $more; $more = 0; ?>
				<?php while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
				  <article>
					<header>
					 <h1><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php printf(__('Permanent Link to %s', 'responsive'), the_title_attribute('echo=0')); ?>"><?php the_title(); ?></a></h1>
						</header>        
								<section class="post-meta">
								<?php 
									printf( __( '<i class="fa fa-clock-o"></i> %2$s <i class="fa fa-user"></i> %3$s', 'responsive' ),'meta-prep meta-prep-author',
								sprintf( '<a href="%1$s" title="%2$s" rel="bookmark">%3$s</a>',
								  get_permalink(),
								  esc_attr( get_the_time() ),
								  get_the_date()
								),
								sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
								  get_author_posts_url( get_the_author_meta( 'ID' ) ),
							  sprintf( esc_attr__( 'View all posts by %s', 'responsive' ), get_the_author() ),
								  get_the_author()
									)
							  );
							?>
							<?php if ( comments_open() ) : ?>
										<span class="comments-link">
										<span class="mdash">&mdash;</span>
									<?php comments_popup_link(__('No Comments', 'responsive'), __('1 Comment', 'responsive'), __('% Comments', 'responsive')); ?>
										</span>
									<?php endif; ?> 
								</section><!-- end of .post-meta -->
								
								<section class="post-entry">
									<?php if ( has_post_thumbnail()) : ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" >
									<?php the_post_thumbnail(); ?>
										</a>
									<?php endif; ?>
									<?php the_content(); ?>
									   <?php custom_link_pages(array(
											'before' => '<nav class="pagination"><ul>' . __(''),
											'after' => '</ul></nav>',
											'next_or_number' => 'next_and_number', # activate parameter overloading
											'nextpagelink' => __('&rarr;'),
											'previouspagelink' => __('&larr;'),
											'pagelink' => '%',
											'echo' => 1 )
											); ?>
								</section><!-- end of .post-entry -->           
							<div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div> 
							</article>
				
				<?php endwhile; ?>
			</div>
		</div>
	</div>
</div>
