<?php
/**
 * Spotlight Sidebar Jomres Page
 *
 *
 * @file           sidebar-spotlight.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2005 - 2015 Jomres-Extras.com
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>

<!--Ajax search Widget position-->
<div class="t3-sl t3-sl-3-subpage">
	<div class="t3-spotlight t3-spotlight-3 row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<aside id="widgets">
				<?php responsive_widgets(); // above widgets hook ?>
				
				<?php if (!dynamic_sidebar('spotlight-widget-1')) : ?>
				<?php endif; ?>
				
				<?php responsive_widgets_end(); // after widgets hook ?>
			</aside>
		</div>
	</div>
</div>
