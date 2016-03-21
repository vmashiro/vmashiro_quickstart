<?php
/**
 * File used for homepage widgets
 *
 * @package WordPress
 */
?>

<div id="widgets" class="home">
	
	<?php responsive_widgets(); // above widgets hook ?>
	
	<?php if (!dynamic_sidebar('home-widget-1')) : ?>
	<div class="wrap t3-sl t3-sl-1">
		<div class="widget-title-home"><h3><?php _e('Home Widget 1', 'responsive'); ?></h3></div>
		<div class="textwidget"><?php _e('This is your first home widget box designed to hold a slideshow. To edit please go to Appearance > Widgets and choose Home Widget 1. Title is also managable from widgets as well.','responsive'); ?></div>
	</div>
	<?php endif; //end of home-widget-1 ?>
	
	
	<?php if (!dynamic_sidebar('home-widget-search')) : ?>
	<div class="wrap t3-sl t3-sl-search clearfix">
		<div class="widget-title-home"><h3><?php _e('Home Widget Search', 'responsive'); ?></h3></div>
		<div class="textwidget"><?php _e('This is your home widget box specifically designed to hold a Jomres search form. To edit please go to Appearance > Widgets and choose Home Widget Search. Title is also managable from widgets as well.','responsive'); ?></div>
	</div>
	<?php endif; //end of home-widget-search ?>
	
	
	<?php if (!dynamic_sidebar('home-widget-2')) : ?>
	<div class="wrap t3-sl t3-sl-2">
		<div class="widget-title-home"><h3><?php _e('Home Widget 2', 'responsive'); ?></h3></div>
		<div class="textwidget"><?php _e('This is your second home widget box. To edit please go to Appearance > Widgets and choose Home Widget 2. Title is also managable from widgets as well.','responsive'); ?></div>
	</div>
	<?php endif; //end of home-widget-2 ?>
	
	
	<?php if (!dynamic_sidebar('home-call-1')) : ?>
	<div class="wrap call-to-action1">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Call To Action 1', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your first home call to action widget box. To edit please go to Appearance > Widgets and choose Home Call To Action 1. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>
	<?php endif; //end of home-call-1 ?>
	
	
	<?php if (!dynamic_sidebar('home-widget-3')) : ?>
	<div class="wrap t3-sl t3-sl-3">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Widget 3', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your third home widget box. To edit please go to Appearance > Widgets and choose Home Widget 3. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>
	<?php endif; //end of home-widget-3 ?>
	
	
	<?php if (!dynamic_sidebar('home-call-2')) : ?>
	<div class="wrap call-to-action2">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Call To Action 2', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your second home call to action widget box. To edit please go to Appearance > Widgets and choose Home Call To Action 2. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>
	<?php endif; //end of home-call-2 ?>
	
	
	<?php if (!dynamic_sidebar('home-widget-4')) : ?>
	<div class="wrap t3-sl t3-sl-4">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Widget 4', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your fourth home widget box. To edit please go to Appearance > Widgets and choose Home Widget 4. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>
	<?php endif; //end of home-widget-4 ?>
	
	
	<?php if (!dynamic_sidebar('home-call-3')) : ?>
	<!--<div class="wrap call-to-action3">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Call To Action 3', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your third home call to action widget box. To edit please go to Appearance > Widgets and choose Home Call To Action 3. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>-->
	<?php endif; //end of home-call-3 ?>
	
	
	<?php if (!dynamic_sidebar('home-widget-5')) : ?>
	<div class="wrap t3-sl t3-sl-5">
		<div class="widget-title-home"><h3><?php _e('Home Widget 5', 'responsive'); ?></h3></div>
		<div class="textwidget"><?php _e('This is your fifth home widget box. To edit please go to Appearance > Widgets and choose Home Widget 5. Title is also managable from widgets as well.','responsive'); ?></div>
	</div>
	<?php endif; //end of home-widget-5 ?>
	
	
	<?php if (!dynamic_sidebar('home-call-4')) : ?>
	<!--<div class="wrap call-to-action4">
		<div class="container">	
			<div class="widget-title-home"><h3><?php _e('Home Call To Action 4', 'responsive'); ?></h3></div>
			<div class="textwidget"><?php _e('This is your fourth home call to action widget box. To edit please go to Appearance > Widgets and choose Home Call To Action 4. Title is also managable from widgets as well.','responsive'); ?></div>
		</div>
	</div>-->
	<?php endif; //end of home-call-4 ?>
	
	<?php responsive_widgets_end(); // responsive after widgets hook ?>

</div><!-- end of #widgets -->
