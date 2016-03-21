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
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class plugin_info_core_gateway_cheque
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"core_gateway_cheque",
			"marketing"=>"Adds the 'cheque' gateway to the system, allowing guests who're booking to get the property's details for sending a cheque to pay for their deposit.",
			"version"=>(float)"2.2",
			"description"=> " Adds the 'cheque' gateway to the system, allowing guests who're booking to get the property's details for sending a cheque to pay for their deposit.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/46-core-gateway-cheque',
			'change_log'=>'v1.1 submit button made translatable. 1.2 Fixed a broken url v1.3 added code to prevent buttons being clicked twice. v1.4 Reversed the previous change as it does not work on Chrome. v1.5 Changed how the url to the configuration window is constructed. Added support for double-click prevention. v1.6 Removed references to Token functionality that is no longer used. v1.7 Added functionality to support new Jomres management view code. v1.8 modified cheque plugin to use a dedicated manager contact details if available (super property manager details will not be used if a non-super managers details are not available). v1.9 bug fixed an issue from the previous, test, release. v2.1 Added Subscription specific functionality v2.2 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>