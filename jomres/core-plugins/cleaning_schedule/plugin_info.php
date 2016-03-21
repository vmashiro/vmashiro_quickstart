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

class plugin_info_cleaning_schedule
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"cleaning_schedule",
			"marketing"=>"A quick and dirty (sic) cleaning schedule that can be viewed under the Misc menu options in the frontend.",
			"version"=>(float)"2.3",
			"description"=> " A quick and dirty (sic) cleaning schedule that can be viewed under the Misc menu options in the frontend.",
			"lastupdate"=>"2016/01/16",
			"min_jomres_ver"=>"9.4.0",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/38-cleaning-schedule',
			'change_log'=>' 1.1 Modified headers to ensure script uses Jomres init check, not Joomla\'s old init check. 1.3 updated to work in v6 1.4 Cleaning schedule moved out to it\'s own mainmenu button. 1.5 updated to work with Jr7.1 v1.6  Made changes in support of the Text Editing Mode in 7.2.6. v1.7 modified plugin to use templates. v1.8 Changed menu allocation. v1.9 Added BS3 templates. v2.0 Added functionality to support new Jomres management view code. v2.1 Modified how queries are performed to take advantage of quicker IN as opposed to OR. v2.2 PHP7 related maintenance. v2.3 Cleaning schedule renumbered to 06001 trigger.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/cleaning_schedule.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=cleaning_schedule'
			);
		}
	}
?>