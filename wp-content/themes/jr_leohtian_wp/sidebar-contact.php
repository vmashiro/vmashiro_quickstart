<?php
/**
 * Main Widget Template
 *
 *
 * @file           sidebar.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2005 - 2015 Jomres-Extras.com
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>
      
<div class="col-lg-3">
	<aside id="widgets" class="t3-sidebar">
	<?php responsive_widgets(); // above widgets hook ?>
		
		<?php if (!dynamic_sidebar('contact-widget')) : ?>
		
	
		<?php endif; //end of right-sidebar ?>
	
	<?php responsive_widgets_end(); // after widgets hook ?>
	</aside><!-- end of widgets -->
</div>