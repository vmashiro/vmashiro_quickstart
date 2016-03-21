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

class j02299regprop1_jintour 
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=true; return;
			}

		$this->next_step = "jintour";
		$this->title = jr_gettext('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS',_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS,FALSE);
		$this->description =jr_gettext('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS_DESC',_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS_DESC,FALSE);
		}

	function touch_template_language()
		{
		$output=array();

		$output[]		=jr_gettext('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS',_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS);
		$output[]		=jr_gettext('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS_DESC',_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS_DESC);

		foreach ($output as $o)
			{
			echo $o;
			echo "<br/>";
			}
		}
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return array('next_step'=>$this->next_step,'title'=>$this->title, 'description'=>$this->description);
		}
	}
?>