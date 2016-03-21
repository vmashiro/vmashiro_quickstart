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

class plugin_info_coupons
	{
	function __construct()
		{
		$this->data=array(
			"name"=>"coupons",
			"marketing"=>"Adds a new button to the manager's toolbar which is used to add/edit/delete discount codes which can be used by guests when making a booking. Coupons are specific to individual properties and can be configured to be used within certain dates, and only be valid for certain dates. Additionally they can be specific to only a certain guest. When a coupon is displayed it can be viewed in a printable screen, including a QR code. This code can be scanned into a phone and the user will be taken direct to the booking form, with that discount code already applied.",
			"version"=>(float)"2.8",
			"description"=> " Adds a new button to the manager's toolbar which is used to add/edit/delete discount vouchers which can be used by guests when making a booking.",
			"lastupdate"=>"2015/11/11",
			"min_jomres_ver"=>"9.2.1",
			"manual_link"=>'http://www.jomres.net/manual/property-managers-guide/48-your-toolbar/settings/256-discount-coupons',
			'change_log'=>'v2.5 Added BS3 related template changes. v2.6 Added functionality related to new subscription features in Jomres 9 v2.7 PHP7 related maintenance. v2.8 Changed some forms to use JOMRES_SITEPAGE_URL_NOSEF instead of JOMRES_SITEPAGE_URL.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/manual/images/Manual/All_Listings_-_Mozilla_Firefox_m8eix.png',
			'demo_url'=>'http://userdemo.jomres.net/index.php?option=com_jomres&Itemid=103&lang=en&task=listCoupons'
			);
		}
	}
?>