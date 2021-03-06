<?php
/**
 * Landing Page Template
 *
   Template Name:  Landing Page 
 *
 * @file           landing-page.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2013 Brag Interactive
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Pages_.28page.php.29
 * @since          available since Release 1.0
 */
?>
<?php get_header(); ?>
<div class="container">
	<div class="row">
		<?php if( bi_option('enable_disable_breadcrumbs','1') == '1') {?>
			<div class="t3-breadcrumbs" id="t3-breadcrumbs">
				<?php echo responsive_breadcrumb_lists(); ?>
			</div>
		<?php } ?>
	</div>
</div>
<div id="t3-mainbody" class="t3-mainbody">
	<div class="container">
		<div class="row">
			<div id="t3-content" class="t3-content col-md-12">
				<div id="landing-content-full">
			
					<?php if (have_posts()) : ?>
					
					<?php while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<header class="page-header">
							<h1 class="page-title"><?php the_title(); ?></h1> 
						</header>
						
						<section class="post-entry">
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
						
					   <footer class="article-footer">
							<?php if ( comments_open() ) : ?>
							<div class="post-data">
								<?php the_tags(__('Tagged with:', 'responsive') . ' ', ', ', '<br />'); ?> 
								<?php the_category(__('Posted in %s', 'responsive') . ', '); ?> 
							</div><!-- end of .post-data -->
							<?php endif; ?>             
							
							<div class="post-edit"><?php edit_post_link(__('Edit', 'responsive')); ?></div> 
						</footer>
					</article><!-- end of #post-<?php the_ID(); ?> -->
							
					<?php endwhile; ?> 
				
					<?php if (  $wp_query->max_num_pages > 1 ) : ?>
					<nav class="navigation">
						<div class="previous"><?php next_posts_link( __( '&#8249; Older posts', 'responsive' ) ); ?></div>
						<div class="next"><?php previous_posts_link( __( 'Newer posts &#8250;', 'responsive' ) ); ?></div>
					</nav><!-- end of .navigation -->
					<?php endif; ?>
					
					<?php else : ?>
					
					<article id="post-not-found" class="hentry clearfix">
						<header>
						   <h1 class="title-404"><?php _e('404 &#8212; Fancy meeting you here!', 'responsive'); ?></h1>
						</header>
						<section>
						   <p><?php _e('Don&#39;t panic, we&#39;ll get through this together. Let&#39;s explore our options here.', 'responsive'); ?></p>
						</section>
						<footer>
						   <h6><?php _e( 'You can return', 'responsive' ); ?> <a href="<?php echo home_url(); ?>/" title="<?php esc_attr_e( 'Home', 'responsive' ); ?>"><?php _e( '&#9166; Home', 'responsive' ); ?></a> <?php _e( 'or search for the page you were looking for', 'responsive' ); ?></h6>
						   <?php get_search_form(); ?>
						</footer>
					</article>
					<?php endif; ?>
				</div><!-- end of #content-full -->
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>