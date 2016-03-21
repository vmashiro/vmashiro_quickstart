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

class plugin_info_random_review_inna_module
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"random_review_inna_module",
			"marketing"=>"Pulls a random review from the database, quote the review, output it\'s score and provide a link to the property.",
			"version"=>(float)"1.6",
			"description"=> 'Module. Pull a random review from the database, quote the review, output it\'s score and provide a link to the property. Use jomres_asamodule to output a random review, set the task to "random_review_inna_module". ',
			"lastupdate"=>"2015/11/09",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/15-core-plugins/97-random-review-inna-module',
			'change_log'=>'v1.1 Updated to work on Jr7 1.2  Templates bootstrapped. v1.3 Added some code to prevent the plugin from attempting to output a review when running Touch Templates. v1.4 Added BS3 templates. v1.5 Added changes to reflect addition of new Jomres root directory definition. v1.6 PHP7 related maintenance.',
			'highlight'=>'',
			'image'=>'',
			'demo_url'=>''
			);
		}
	}
?>