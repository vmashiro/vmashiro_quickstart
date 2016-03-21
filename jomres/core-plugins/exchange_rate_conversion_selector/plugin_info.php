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

class plugin_info_exchange_rate_conversion_selector
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"exchange_rate_conversion_selector",
			"marketing"=>"Provides the exchange rate selection dropdown that site users can utilise to show prices in their selected currency.",
			"version"=>"2.6",
			"description"=> "Provides the exchange rate selection dropdown that site users can utilise to show prices in their selected currency. Should be called by ASAModule or a descreet task (eg task=exchange_rate_conversion_selector). If you'd like to use the bootstrap template for putting dropdowns in the toolbar (a href based as opposed to select lists) add &alternate_template=1 to the ASAModule arguments.",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/56-exchange-rate-conversion-selector',
			'change_log'=>' v1.1 added code required to trigger the automatic configuration of a user\'s currency code based on their IP. 1.2 Updated to add a menu option to Jomres 6 mainmenu. 1.3 Layout improved. 1.4 Removed need for plugin to be on a jomres page for it to show data. 1.5 Updated to work on Jr7 v1.6  Templates bootstrapped. 1.7 Fix for exchange rate conversion dropdown sometimes not showing. 1.8  updated to work with Jr7.1 v1.9 Added BS3 templates. v2.0 Tweaked functionality to support Wordpress, in relation to storing user settings. v2.1 Added changes to reflect addition of new Jomres root directory definition. v2.2 added a check for jomres temp booking handler for edge cases where the module is called but Jomres is not used else where. 2.4 added a switch to allow use of bootstrapped templates for setting up dropdowns in bootstrap toolbars. v2.5 Added an option to use an alternative template. v2.6 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
		

	}
?>