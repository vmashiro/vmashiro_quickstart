<?php
/**
 * File used for homepage static page content module
 *
 * @package WordPress
 */
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php while( have_posts() ) : the_post(); ?>
			
			<?php if ( has_post_thumbnail()) : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>
			<?php the_content(); ?>
			
			<?php endwhile; ?>
		</div>
	</div>
</div>

