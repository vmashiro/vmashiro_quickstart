<?php
/**
 * Footer Sidebar All Pages
 *
 *
 * @file           sidebar-footer.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2005 - 2015 Jomres-Extras.com
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Widgets_.28sidebar.php.29
 * @since          available since Release 1.0
 */
?>

<div class="container">
	<div class="t3-spotlight t3-footnav row">
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			<?php if (!dynamic_sidebar('footer-widget-1')) : ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			<?php if (!dynamic_sidebar('footer-widget-2')) : ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			<?php if (!dynamic_sidebar('footer-widget-3')) : ?>
			<?php endif; ?>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
			<?php if (!dynamic_sidebar('footer-widget-4')) : ?>
			<?php endif; ?>
		</div>
	</div>
</div>
