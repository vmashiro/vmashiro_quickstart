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

class plugin_info_core_gateway_paypal
	{
	function __construct()
	{
		$this->data=array(
			"name"=>"core_gateway_paypal",
			"category"=>"Bookings Configuration",
			"marketing"=>" Adds paypal gateway functionality. Apart from ordinary deposit payments, this plugin is required if you want to use the subscription functionality. Once installed you can either allow individual properties to setup their own Paypal settings, or you can override that and force all properties to pay into one central Paypal account.",
			"version"=>(float)"3.9",
			"description"=> " Adds paypal gateway functionality. Apart from ordinary deposit payments, this plugin is required if you want to use the subscription functionality.",
			"lastupdate"=>"2016/02/19",
			"min_jomres_ver"=>"9.5.6",
			"manual_link"=>'http://www.jomres.net/manual/site-managers-guide/23-control-panel/payment-methods/173-edit-gateway-paypal',
			'change_log'=>'v3.4 added Paypal SDK and enabled handling of invoice payments. v3.5 Added functionality to support payments of booking invoices. v3.5 Modified invoice_payment_send.class.php, disabled optional line item addition to Paypal payment when paying invoices. For reasons best known to Paypal, a previously paid transaction item (e.g. deposit ) with a negative figure is not a valid line item and will cause a 400 error from Paypal, even though the balance works out as correct. v3.6 fixed a version number issue. v3.7 PHP7 related maintenance. v3.8 changed how the currency code is determined. v3.9 Updated PP SDK to allow for better determination of SSL level when talking to the remote server.',
			'highlight'=>'',
			'image'=>'http://www.jomres.net/non-joomla/plugin_list/plugin_images/paypal_gateway.png',
			'demo_url'=>''
			);
		}
	}
?>