<?php
/**
 * @package WordPress
 * @subpackage Leohtian
 * Template Name: Homepage
 */
?>
<?php get_header(); ?>


	<?php
	// Loop through homepage modules and get their corresponding files
	// See your theme's includes folder for editing these modules
    global $bi_option;
    $homepage_modules = $bi_option['homepage-layout']['enabled'];
    if ($homepage_modules):
		// Loop through each module
    	foreach ($homepage_modules as $key=>$value) :

			$value = preg_replace('/\s*/', '', $value); // remove white spaces
			$value = strtolower($value); // lowercase
    		get_template_part('includes/home', $value); // get correct file for each module
   		endforeach;
	endif; ?>


<?php get_footer(); ?>