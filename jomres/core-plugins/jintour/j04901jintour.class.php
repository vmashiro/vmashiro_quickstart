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

class j04901jintour {
	function __construct($componentArgs)
		{
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$management_process					= jomresGetParam( $_POST, 'management_process','' );
		if ($management_process == 'jintour')
			{
			$property_uid=$componentArgs['property_uid'];
			$query = "INSERT INTO #__jomres_jintour_properties (`property_uid`)VALUES (".(int)$property_uid.")";
			$result = doInsertSql($query);
			if (!$result) 
				trigger_error ("Sql error when adding new jintour property to database.", E_USER_ERROR);
			// We'll add on tariff to the rates table to supress the Jomres sanity check, however we will not actually use it
			$query = "INSERT INTO #__jomres_rates (`property_uid`)VALUES (".(int)$property_uid.")";
			if (!doInsertSql($query)) 
				trigger_error ("Sql error when adding new jintour tariff to database.", E_USER_ERROR);
			}
		}


	function getRetVals()
		{
		return null;
		}
	}
?>