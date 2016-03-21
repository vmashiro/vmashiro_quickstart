<?php
/**
* Jomres CMS Agnostic Plugin
* @author Woollyinwales IT <sales@jomres.net>
* @version Jomres 9 
* @package Jomres
* @copyright	2005-2015 Woollyinwales IT
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project.
**/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to this file is not allowed.' );
// ################################################################

class j00001paypal_sdk_autoload
	{
	function __construct( $componentArgs )
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{ 
			$this->template_touchable = false; 
			return; 
			}
		$ePointFilepath = get_showtime('ePointFilepath');
		set_showtime('paypal_sdk_path' , $ePointFilepath );
		require_once($ePointFilepath.JRDS.'PayPal'.JRDS."autoload.php");
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
