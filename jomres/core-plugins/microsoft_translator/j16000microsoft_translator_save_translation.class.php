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


class j16000microsoft_translator_save_translation 
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$customText = jomresGetParam( $_REQUEST, 'newtext', '','string' );
		$theConstant =filter_var($_REQUEST['theConstant'],FILTER_SANITIZE_SPECIAL_CHARS);

		$query="SELECT customtext FROM #__jomres_custom_text WHERE constant = '".$theConstant."' and property_uid = 0 AND language = '".get_showtime('lang')."'";
		$textList=doSelectSql($query);
		if (strlen($customText)==0)
			{
			$query="DELETE FROM	#__jomres_custom_text WHERE constant = '".$theConstant."' AND property_uid = 0 AND language = '".get_showtime('lang')."'";
			}
		else
			{
			if (count($textList)<1)
				$query="INSERT INTO #__jomres_custom_text (`constant`,`customtext`,`property_uid`,`language`) VALUES ('".$theConstant."','".$customText."',0,'".get_showtime('lang')."')";
			else
				$query="UPDATE #__jomres_custom_text SET `customtext`='".$customText."' WHERE constant = '".$theConstant."' AND property_uid = 0 AND language = '".get_showtime('lang')."'";
			}
		if (doInsertSql($query))
			{
			$c = jomres_singleton_abstract::getInstance( 'jomres_array_cache' );
			$c->eraseAll();
			
			echo jomres_decode($customText);
			}
		else
			echo "Something burped";
		exit;
		}


	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
