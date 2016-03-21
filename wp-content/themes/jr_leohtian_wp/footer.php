<?php
/**
 * Footer Template
 *
 *
 * @file           footer.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2005 - 2015 Jomres-Extras.com
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Footer_.28footer.php.29
 * @since          available since Release 1.0
 */
?>

	<?php if (has_nav_menu('footer-menu', 'responsive')) { ?>
	<nav class="wrap t3-navhelper" role="navigation">
		<div class="container">
			<?php wp_nav_menu(array(
			  'container'       => '',
			  'menu_class'      => 'footer-menu',
			  'theme_location'  => 'footer-menu')
			); 
			?>
		</div>
	</nav>
	<?php } ?>
	
	<footer id="t3-footer" class="wrap t3-footer">
	
		<?php get_sidebar('footer'); ?>
		
		<section class="t3-copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 copyright">
						<?php if( bi_option('custom_copyright') ) : ?>
							<?php echo bi_option('custom_copyright'); ?>
						<?php else : ?>
							&copy; <?php _e('Copyright', 'responsive'); ?> 2005 - <?php echo date('Y'); ?> <a href="https://www.jomres.net/" title="Jomres.net">Jomres.net</a>
						<?php endif; ?>
						<br />
						<?php if( bi_option('custom_power') ) : ?>
							<?php echo bi_option('custom_power'); ?>
						<?php else : ?>
							Developed by Aladar Barthi - <a href="<?php echo esc_url(__('http://www.jomres-extras.com','responsive')); ?>" title="<?php esc_attr_e('Jomres Extras', 'responsive'); ?>">
							<?php printf('Jomres-Extras.com'); ?></a>
						<?php endif; ?>
					</div>
					
					<div class="col-lg-8">
						<?php if( bi_option('disable_social_footer') == '1') { ?>     
						<div class="social-icons">
							<?php $social_options = bi_option( 'social_icons' ); ?>
								<?php foreach ( $social_options as $key => $value ) {
										if ( $value ) { ?>
										<a href="<?php echo $value; ?>" title="<?php echo $key; ?>" target="_blank">
											<i class="fa fa-<?php echo $key; ?>"></i>
										</a>
									<?php }
								} ?>
						</div>
						<?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 scroll-top hidden-print">
						<a href="#scroll-top" title="<?php esc_attr_e( 'scroll to top', 'responsive' ); ?>"><?php _e( '<i class="fa fa-chevron-up"></i>', 'responsive' ); ?></a>
					</div>
				</div>
			</div>
		</section>
		<?php responsive_container_end(); // after container hook ?>
	</footer>
	
	<?php wp_footer(); ?>

</div><!-- end of t3-wrapper-->
<?php responsive_wrapper_end(); // after wrapper hook ?>

</body>
</html>