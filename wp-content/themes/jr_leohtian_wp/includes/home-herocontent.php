<?php
/**
 * File used for homepage static page hero module
 *
 * @package WordPress
 */
?>
<div class="container">
	<div class="jumbotron">
	  <div class="row">
		
		<div class="col-lg-6">
	
		  <?php
		  
		  // First let's check if headline was set
		  if(bi_option('featured_heading', 'no entry')) {
			echo '<h1 class="featured-title">'; 
			echo bi_option('featured_heading', '' );
			echo '</h1>'; 
		  // If not display dummy headline for preview purposes
		  } else { 
			echo '<h1 class="featured-title">';
			echo __('Responsive!','responsive');
			echo '</h1>';
		  }
		  ?>
		  
		  <?php 
		  // First let's check if headline was set
		  if(bi_option('home_subheadline', 'no entry')) {
			echo '<h2 class="featured-subtitle">'; 
			echo bi_option('home_subheadline', '');
			echo '</h2>'; 
		  // If not display dummy headline for preview purposes
		  } else { 
			echo '<h2 class="featured-subtitle">';
			echo __('Bootstrap WordPress Theme','responsive');
			echo '</h2>';
		  }
		  ?>
		  
		  <?php 
		  // First let's check if content is in place
		  if(bi_option('home_content_area', 'no entry')) {
			echo '<p>'; 
			echo bi_option('home_content_area', '');
			echo '</p>'; 
		  // If not let's show dummy content for demo purposes
		  } else { 
			echo '<p>';
			echo __('A responsive WordPress theme with all the Twitter Bootstrap goodies. Check out the page layouts, features,
			  and shortcodes this theme has to offer. Feel free to look around.','responsive');
			echo '</p>';
		  }
		  ?>
		  
		  <?php  
		  $cta_btn_size = 'btn-'.bi_option('cta_size', '' );
		  $cta_btn_color = 'btn-'.bi_option('cta_color', '' );
		  $cta_btn_text = bi_option('cta_text', '' );
		  $cta_btn_url = bi_option('cta_url', '' );
	
		  if(bi_option('button_block', '1')) {
			$cta_btn_block = "btn-block";
		  }
		  ?>
		  <?php if(bi_option('display_button', '1')) {?>    
		  <div class="call-to-action">
	
			<?php
		  // First let's check if button was set
			if(bi_option('cta_text', 'no entry' )) {
			  echo '<a href="'.$cta_btn_url.'" class="btn '.$cta_btn_block.' '.$cta_btn_size.' '.$cta_btn_color.'">'; 
			  echo bi_option('cta_text', '' );
			  echo '</a>';
		  // If not display dummy button text for preview purposes
			} else { 
			  echo '<a href="#nogo" class="btn btn-block btn-lg btn-warning">'; 
			  echo __('Call to Action','responsive');
			  echo '</a>';
			}
			?>  
			
		  </div><!-- end of .call-to-action -->
		  <?php } ?>           
		  
		</div><!-- end of col-lg-6 -->
	
		<div id="hero-image" class="col-lg-6"> 
		 
		  <?php 
		  // First let's check if headline was set
		  if (bi_option('featured_content', 'no entry')) {
			echo bi_option('featured_content', 'no entry');
			// If not display dummy headline for preview purposes
		  } else {             
			echo '<img class="aligncenter" src="'.get_stylesheet_directory_uri().'/images/featured-image.png" width="440" height="300" alt="" />'; 
		  }
		  ?> 
		  
		</div><!-- end of col-lg-6 --> 
	  </div>
	</div><!-- end of .jumbotron -->
</div>
