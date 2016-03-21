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
class j06002ical_feeds
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
		$pageoutput=array();
		$output=array();
		$rows = array();
		
		$defaultProperty = getDefaultProperty();
		$mrConfig        = getPropertySpecificSettings();
		
		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$current_property_details->gather_data($defaultProperty);
		
		//api key of this property. Without it, we won`t allow access to the ical feed or, depending on setting, allow access to the anynimised ical feed
		$apikey = $current_property_details->apikey;
		
		foreach ($current_property_details->room_types as $k=>$v)
			{
			$r = array();

			if (!using_bootstrap())
				{
				$jrtbar = jomres_singleton_abstract::getInstance( 'jomres_toolbar' );
				$jrtb = $jrtbar->startTable();
				$jrtb .= $jrtbar->toolbarItem( 'edit', jomresUrl(JOMRES_SITEPAGE_URL_NOSEF . '&task=ical_export&property_uid=' . $defaultProperty .'&room_type='. $k .'&apikey='. $apikey), jr_gettext( 'COMMON_DOWNLOAD', COMMON_DOWNLOAD, false ) );
				$r['TOOLBAR'] = $jrtb .= $jrtbar->endTable();
				}
			else 
				{
				$toolbar = jomres_singleton_abstract::getInstance( 'jomresItemToolbar' );
				$toolbar->newToolbar();
				$toolbar->addItem( 'fa fa-download', 'btn btn-primary ', '', jomresUrl(JOMRES_SITEPAGE_URL_NOSEF . '&task=ical_export&property_uid=' . $defaultProperty .'&room_type='. $k .'&apikey='. $apikey), jr_gettext( 'COMMON_DOWNLOAD', COMMON_DOWNLOAD, false ) );
				$r['TOOLBAR'] = $toolbar->getToolbar();
				}
				
			$r['ROOM_TYPE'] = $v['abbv'];
			$r['ICAL_FEED_LINK'] = jomresUrl(JOMRES_SITEPAGE_URL_NOSEF . '&task=ical_export&property_uid=' . $defaultProperty .'&room_type='. $k .'&apikey='. $apikey);
			$r['ANONYMISED_ICAL_FEED_LINK'] = jomresUrl(JOMRES_SITEPAGE_URL_NOSEF . '&task=ical_export&property_uid=' . $defaultProperty .'&room_type='. $k);
			
			$rows[] = $r;
			}
		
		$output['PAGETITLE'] = jr_gettext('_JOMRES_ICAL_FEEDS',_JOMRES_ICAL_FEEDS,false,false);
		$output['DESCRIPTION'] = jr_gettext('_JOMRES_ICAL_FEEDS_DESC',_JOMRES_ICAL_FEEDS_DESC,false,false);
		$output['HROOM_TYPE'] = jr_gettext('_JOMRES_HRESOURCE_TYPE',_JOMRES_HRESOURCE_TYPE,false,false);
		$output['HICAL_FEED_LINK'] = jr_gettext('_JOMRES_ICAL_FEED_LINK',_JOMRES_ICAL_FEED_LINK,false,false);
		$output['HANONYMISED_ICAL_FEED_LINK'] = jr_gettext('_JOMRES_ICAL_ANON',_JOMRES_ICAL_ANON,false,false);
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( "ical_feeds.html" );
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows',$rows);
		$tmpl->displayParsedTemplate();
		
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}
