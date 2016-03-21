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

class plugin_info_sms_clickatell
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"sms_clickatell",
			"marketing"=>"Adds a new tab to the property config tab for a manager's cellphone, and a new button to the administrator's control panel which allows them to configure clickatell settings so that managers can be advised when they've received a new booking.",
			"version"=>(float)"2.5",
			"description"=> "IMPORTANT : This plugin is old, the instructions in the manual may no longer be up-to-date, however we are advised by clients that the functionality still works. Adds a new tab to the property config tab for a manager's cellphone, and a new button to the administrator's control panel which allows them to configure clickatell settings so that managers can be advised when they've received a new booking.  ",
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/21-control-panel/integration/163-jomres-clickatell-settings',
			'change_log'=>'1.1 updated for use in v5.6 1.2 Fixed a bug caused by new filtering code in 6.6.7 1.3  updated to work with Jr7.1 1.4 Jr7.1 specific changes v1.5 Made changes in support of the Text Editing Mode in 7.2.6. v1.6 Minor tweak to ensure that editing mode does not interfere with buttons. v1.7 Removed references to Token functionality that is no longer used. v1.8 Removed an image call that is not used. v1.9 Hide menu option if Simple Site Config enabled. v2.0 Reordered button layout. v2.1 Added changes to reflect addition of new Jomres root directory definition. v2.2  Modified plugin to ensure correct use of jomresURL function. v2.3 Modified how queries are performed to take advantage of quicker IN as opposed to OR. v2.4 Fixed an issue where not having rooms ( eg jintour properties ) can create a PDO error. v2.5 PHP7 related maintenance. ',
			'highlight'=>'You will need your own clickatell account to make use of this functionality.',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>