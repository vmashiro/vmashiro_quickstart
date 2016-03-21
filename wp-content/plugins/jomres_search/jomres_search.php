<?php
/*
Plugin Name: Jomres Search Widget
Description: Widget. Allows you to display a Jomres search form in a widget.
Version: 0.1 
*/

/**
* Jomres CMS Specific Plugin
* @author Woollyinwales IT <sales@jomres.net>
* @version Jomres 9 
* @package Jomres
* @copyright	2005-2015 Woollyinwales IT
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project.
**/


/* Start Adding Functions Below this Line */
// Creating the widget 
defined('WPINC') or die;

class jomres_search extends WP_Widget 
	{
	function __construct() 
		{
		parent::__construct(
			// Base ID of your widget
			'jomres_search_widget', 
	
			// Widget name will appear in UI
			__('Jomres Search Widget', 'jomres_search_widget_domain'), 
	
			// Widget description
			array( 'description' => __( 'Widget. Allows you to display a Jomres search form.', 'jomres_search_widget_domain' ), ) 
			);
		}

	// Creating widget front-end
	// This is where the action happens
	public function widget( $args, $instance ) 
		{
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
	
		$calledByModule="mod_jomsearch_m0";
		$doSearch=false;
		$includedInModule=true;

		$MiniComponents =jomres_getSingleton('mcHandler');
		$componentArgs=array('doSearch'=>$doSearch,'includedInModule'=>$includedInModule,'calledByModule'=>$calledByModule);
		$MiniComponents->triggerEvent('00030',$componentArgs);
		
		echo $args['after_widget'];
		}
	
	// Widget Backend 
	public function form( $instance ) 
		{
		if ( isset( $instance[ 'title' ] ) ) 
			{
			$title = $instance[ 'title' ];
			}
		else 
			{
			$title = __( 'New title', 'jomres_search_widget_domain' );
			}
	
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		
		<p>You can enable/disable search options for this widget from Jomres Site configuration->Integrated search tab.</p>
		
		<?php 
		}
		
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) 
		{
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		return $instance;
		}
	
	} // Class wpb_widget ends here
	
// Register and load the widget
function jomres_search_load_widget()
	{
	register_widget( 'jomres_search' );
	}

function jomres_search_init()
	{
	if (!defined('_JOMRES_INITCHECK'))
		define( '_JOMRES_INITCHECK', 1 );

	require_once (dirname(__FILE__).'/../../../jomres_root.php');
			
	if (file_exists(dirname(__FILE__).'/../../../'.JOMRES_ROOT_DIRECTORY.'/core-plugins/alternative_init/alt_init.php'))
		{
		require_once(dirname(__FILE__).'/../../../'.JOMRES_ROOT_DIRECTORY.'/core-plugins/alternative_init/alt_init.php');
		}
	else
		echo "Error: Alternative Init plugin is not installed.";
	}

function jomres_search_add_jomres_js_css()
	{
	$wp_jomres = wp_jomres::getInstance();
	$wp_jomres->add_jomres_js_css();
	}

function jomres_search_wp_end_session() 
	{
	$_SESSION['jomres_wp_session'] = array();
	}

if (!defined('AUTO_UPGRADE'))
	{
	add_action('widgets_init', 'jomres_search_init');
	add_action('widgets_init', 'jomres_search_load_widget');
	add_action('wp_enqueue_scripts', 'jomres_search_add_jomres_js_css', 9999);
	add_action( 'wp_footer', 'jomres_search_add_jomres_js_css' );
	}
add_action('wp_logout',	'jomres_search_wp_end_session');
add_action('wp_login', 'jomres_search_wp_end_session');
			
/* Stop Adding Functions Below this Line */
