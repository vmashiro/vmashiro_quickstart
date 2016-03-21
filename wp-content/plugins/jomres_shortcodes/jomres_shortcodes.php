<?php
/*
Plugin Name: Jomres Shortcodes
Description: Plugin. Allows you to use Jomres shortcodes.
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

defined('WPINC') or die;

/* Start Adding Functions Below this Line */

/*
 * Allow shortcodes in widgets. This is disabled, since for widgets we have the jomres_asamodule plugin.
 * @since v0.1
 */
//add_filter('widget_text', 'do_shortcode');

/*
 * Fix Shortcodes
 * @since v0.1
 */
if( !function_exists('jomres_fix_shortcodes') )
	{
	function jomres_fix_shortcodes($content)
		{   
		$array = array (
			'<p>[' => '[', 
			']</p>' => ']', 
			']<br />' => ']'
			);
		$content = strtr($content, $array);
		return $content;
		}
	add_filter('the_content', 'jomres_fix_shortcodes');
	}

/*
 * Jomres Shortcodes
 * @since v0.1
 */
if( !function_exists('jomres_shortcodes') ) 
	{
	function jomres_shortcodes( $atts, $content = null )
		{
		extract( shortcode_atts( array(
			'task' => '',
			'params' => '',
			), $atts ) );

		if ($task != '')
			{
			ob_start();
			if ($params != '')
				{
				$params = str_replace("&amp;","&",$params);
				$params = str_replace("&#038;","&",$params);
				
				$args_array = explode("&",$params);
				foreach ($args_array as $arg)
					{
					$vals = explode ("=",$arg);
					if(array_key_exists(1,$vals))
						{
						$vals[1] = str_replace("+","-",$vals[1]);
						$_REQUEST[$vals[0]]=$vals[1];
						$_GET[$vals[0]]=$vals[1];
						}
					}
				}
			
			$MiniComponents =jomres_getSingleton('mcHandler');
			set_showtime('task',$task);
			$MiniComponents->specificEvent('06000',$task);
			
			return ob_get_clean();
			}
		else
			return '';
		}
	add_shortcode('jomres', 'jomres_shortcodes');
	}
			
/* Stop Adding Functions Below this Line */
