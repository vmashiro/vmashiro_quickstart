<?php
/**
 * Header Template
 *
 *
 * @file           header.php
 * @package        Leohtian 
 * @author         Aladar Barthi 
 * @copyright      2005 - 2015 Jomres-Extras.com
 * @license        license.txt
 * @version        Release: 1.0.0
 * @link           http://codex.wordpress.org/Theme_Development#Document_Head_.28header.php.29
 * @since          available since Release 1.0
 */
?>
<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>

<meta charset="<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

<title><?php wp_title('&#124;', true, 'right');?><?php bloginfo('name'); ?></title>
<?php if( bi_option('custom_favicon') !== '' ) : ?>
	<link rel="icon" type="image/png" href="<?php echo bi_option('custom_favicon', false, 'url'); ?>" />
<?php endif; ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if( bi_option('enable_disable_animations') ) : ?>
<script type="text/javascript">var addon_animations_enable = true;</script>
<?php else : ?>
<script type="text/javascript">var addon_animations_enable = false;</script>
<style type="text/css">.appear {opacity:1 !important;}</style>
<?php endif; ?>

<?php wp_head(); ?> 

<!-- Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="<?php bloginfo('template_url'); ?>/js/respond.min.js"></script>
<![endif]-->

<!-- GOOGLE FONT -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600,700">
<!-- //GOOGLE FONT -->

</head>

<body <?php body_class(); ?>>

	<?php responsive_wrapper(); // before wrapper ?>
	<div id="wrapper" class="clearfix t3-wrapper">
		<?php responsive_in_wrapper(); // wrapper hook ?>
                 
	<?php responsive_container(); // before container hook ?>
		<?php responsive_header(); // before header hook ?>
		<header id="t3-header" class="t3-header navigation navigation-fixed">
			<?php responsive_in_header(); // header hook ?>
			<nav id="t3-mainnav" class="navbar navbar-default t3-mainnav" role="navigation">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".t3-navbar">
							<i class="fa fa-bars"></i>
						</button>
						
						<?php if( bi_option('custom_logo', false, 'url') !== '' ) { ?>
						<a class="navbar-brand" href="<?php echo home_url(); ?>/" title="<?php bloginfo( 'name' ); ?>" rel="home">
							<img class="logo-img" src="<?php echo bi_option('custom_logo', false, 'url'); ?>" alt="<?php bloginfo( 'name' ) ?>" />
						</a>
						<?php } else { ?>
						<?php if (is_front_page()) { ?>
						<a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
						<?php } else { ?>
						<a class="navbar-brand" href="<?php bloginfo( 'url' ) ?>/" title="<?php bloginfo( 'name' ) ?>" rel="homepage"><?php bloginfo( 'name' ) ?></a>
						<?php } } ?>
					</div>
					
					<div class="t3-navbar navbar-collapse collapse">
						<?php
						$args = array(
							'theme_location' => 'top-bar',
							'depth'      => 2,
							'container'  => false,
							'menu_class'     => 'nav navbar-nav',
							'walker'     => new Bootstrap_Walker_Nav_Menu()
						);

						if (has_nav_menu('top-bar')) {
							   wp_nav_menu($args);
							}
						?>
		
						<?php if( bi_option('enable_disable_search') == '1') {?>
						<form class="navbar-form navbar-right" role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
							<input name="s" id="s" type="text" class="form-control" placeholder="<?php _e('Search','responsive'); ?>">
						</form>
						<?php } ?>
					</div>
				</div>
			</nav>
		</header><!-- end of header -->
		<?php responsive_header_end(); // after header hook ?>
