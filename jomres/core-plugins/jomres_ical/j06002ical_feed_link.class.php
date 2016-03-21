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

//This is a month view chart the occupancy - number of rooms booked by day in the selected month
class j06002ical_feed_link
	{
	function __construct($componentArgs)
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;
			return;
			}
		$ePointFilepath=get_showtime('ePointFilepath');
		
		$property_uid=getDefaultProperty();
		
 		$pageoutput=array();
		$output=array();

		$output['PAGETITLE']							=jr_gettext('_JOMRES_ICAL_FEED_LINK',_JOMRES_ICAL_FEED_LINK,false,false);
		$output['_JOMRES_ICAL_FEED_LINK_INFO']			=jr_gettext('_JOMRES_ICAL_FEED_LINK_INFO',_JOMRES_ICAL_FEED_LINK_INFO,false,false);
		$output['_JOMRES_ICAL_ANON']					=jr_gettext('_JOMRES_ICAL_ANON',_JOMRES_ICAL_ANON,false,false);
		$output['FEED_LINK']							=JOMRES_SITEPAGE_URL_NOSEF."&task=ical_feed&property_uid=".$property_uid;


		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( "ical_feed_link.html" );
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows',$rows);
		$tmpl->displayParsedTemplate();
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}
