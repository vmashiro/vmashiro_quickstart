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
class j06002ical_import
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
		
		$defaultProperty = getDefaultProperty();
		$mrConfig        = getPropertySpecificSettings($defaultProperty);
		
		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$current_property_details->gather_data($defaultProperty);
		
		$options = array();
		
		foreach ($current_property_details->room_types as $k=>$v)
			{
			$options[] = jomresHTML::makeOption( $k, $v['abbv'] );
			}
		
		$output['ROOM_TYPE_DROPDOWN'] = jomresHTML::selectList( $options, 'room_type', 'class="inputbox" size="1"', 'value', 'text', '' );
		
		$output['_JOMRES_ICAL_SELECT'] = jr_gettext('_JOMRES_ICAL_SELECT',_JOMRES_ICAL_SELECT,false,false);
		$output['_JOMRES_ICAL_IMPORT_INFO'] = jr_gettext('_JOMRES_ICAL_IMPORT_INFO',_JOMRES_ICAL_IMPORT_INFO,false,false);
		$output['_ROOM_TYPE_DROPDOWN'] = jr_gettext('_JOMRES_HRESOURCE_TYPE',_JOMRES_HRESOURCE_TYPE,false,false);
		
		$output['PAGETITLE'] = jr_gettext('_JOMRES_ICAL_IMPORT',_JOMRES_ICAL_IMPORT,false,false);
	
	
		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL."&task=dashboard"),"");
		$jrtb .= $jrtbar->toolbarItem('save','','',true,'ical_import_file');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;
		
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( "ical_import.html" );
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->displayParsedTemplate();
		
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}
