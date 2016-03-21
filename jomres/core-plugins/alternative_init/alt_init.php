<?php
/**
* Jomres CMS Agnostic Plugin
* @author Woollyinwales IT <sales@jomres.net>
* @version Jomres 9 
* @package Jomres
* @copyright	2005-2015 Woollyinwales IT
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project.
**/

// Designed to allow a non-jomres script to include jomres functionality without actually running Jomres itself

if (!defined('_JOMRES_INITCHECK'))
	define('_JOMRES_INITCHECK', 1 );

require_once (dirname(__FILE__).'/../../../jomres_root.php');

require_once(dirname(__FILE__).'/../../../'.JOMRES_ROOT_DIRECTORY.'/integration.php');


$siteConfig = jomres_singleton_abstract::getInstance('jomres_config_site_singleton');
$thisJRUser=jomres_singleton_abstract::getInstance('jr_user');
$tmpBookingHandler =jomres_singleton_abstract::getInstance('jomres_temp_booking_handler');

if (is_null($tmpBookingHandler->jomressession) || $tmpBookingHandler->jomressession == '')
	{
	$tmpBookingHandler->initBookingSession(get_showtime('jomressession'));
	$jomressession  = $tmpBookingHandler->getJomressession();
	}

$property_uid = detect_property_uid();
if ($property_uid > 0)
	{
	$current_property_details =jomres_singleton_abstract::getInstance('basic_property_details');
	$current_property_details->gather_data($property_uid);
	$propertytype=$current_property_details->property_type;
	$jomreslang =jomres_singleton_abstract::getInstance('jomres_language');
	$jomreslang->get_language($propertytype);
	}
else
	{
	$jomreslang =jomres_singleton_abstract::getInstance('jomres_language');
	$jomreslang->get_language('');
	}


$customTextObj =jomres_singleton_abstract::getInstance('custom_text');

jr_import( 'jomres_currency_exchange_rates' );
$exchange_rates = new jomres_currency_exchange_rates( "GBP" );

if (!defined('JOMRES_IMAGELOCATION_ABSPATH'))
	{
	define('JOMRES_IMAGELOCATION_ABSPATH',JOMRESCONFIG_ABSOLUTE_PATH.JRDS.'jomres'.JRDS.'uploadedimages'.JRDS);
	define('JOMRES_IMAGELOCATION_RELPATH',get_showtime('live_site').'/jomres/uploadedimages/');
	}

$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
$MiniComponents->triggerEvent('00003'); // 
init_javascript(); // 00004 is triggered in this function now.
$MiniComponents->triggerEvent('00005');
$componentArgs=array();
$MiniComponents->triggerEvent('99999',$componentArgs); // Javascript and CSS caching handling is needed 
$componentArgs=array();
