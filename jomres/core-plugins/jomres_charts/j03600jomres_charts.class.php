<?php
/**
 * Core file
 *
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 8
 * @package Jomres
 * @copyright	2005-2015 Vince Wooll
 * Jomres (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly.
 **/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

//This is a month view chart of all paid bookings, excludes cancelled/pending/unpaid ones)
class j03600jomres_charts
	{
	function __construct($componentArgs)
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;
			return;
			}
		
		$all_jomres_charts = get_showtime("all_jomres_charts");
		
		//occupancy chart
		$all_jomres_charts[] = array(
									 "id" => 'chart_occupancy',
									 "title"=> jr_gettext("_JOMRES_STATUS_BOOKINGS",_JOMRES_STATUS_BOOKINGS,false,false),
									 "description"=> jr_gettext("_JOMRES_CHART_OCCUPANCY_DESC",_JOMRES_CHART_OCCUPANCY_DESC,false,false)
									 );
		
		//guests countries
		$all_jomres_charts[] = array(
									 "id" => 'chart_guests_countries',
									 "title"=> jr_gettext("_JOMRES_HLIST_GUESTS",_JOMRES_HLIST_GUESTS,false,false),
									 "description"=> jr_gettext("_JOMRES_COM_MR_VRCT_PROPERTY_HEADER_COUNTRY",_JOMRES_COM_MR_VRCT_PROPERTY_HEADER_COUNTRY,false,false)
									 );
		
		//property visits
		$all_jomres_charts[] = array(
									 "id" => 'chart_property_visits',
									 "title"=> jr_gettext("_JOMRES_COM_MR_QUICKRES_STEP2_PROPERTYNAME",_JOMRES_COM_MR_QUICKRES_STEP2_PROPERTYNAME,false,false),
									 "description"=> jr_gettext("_JOMRES_HPROPERTY_VISITS_DESC",_JOMRES_HPROPERTY_VISITS_DESC,false,false)
									 );
		
		set_showtime("all_jomres_charts", $all_jomres_charts);
		}

	function getRetVals()
		{
		return null;
		}
	}
