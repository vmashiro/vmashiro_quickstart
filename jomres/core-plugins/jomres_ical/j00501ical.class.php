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

class j00501ical
	{
	function __construct( $componentArgs )
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;

			return;
			}
		$configurationPanel = $componentArgs[ 'configurationPanel' ];
		$mrConfig           = getPropertySpecificSettings();
		
		if ( $mrConfig[ 'is_real_estate_listing' ] == 1 || get_showtime('is_jintour_property') ) 
			return;
		
		// make a standard yes/no list
		$yesno	= array ();
		$yesno[ ] = jomresHTML::makeOption( '0', jr_gettext( '_JOMRES_COM_MR_NO', _JOMRES_COM_MR_NO, false ) );
		$yesno[ ] = jomresHTML::makeOption( '1', jr_gettext( '_JOMRES_COM_MR_YES', _JOMRES_COM_MR_YES, false ) );
		
		$iCalIncludeEnquiries = jomresHTML::selectList( $yesno, 'cfg_iCalIncludeEnquiries', 'class="inputbox" size="1"', 'value', 'text', (int)$mrConfig[ 'iCalIncludeEnquiries' ] );
		$iCalAnonymousFeed = jomresHTML::selectList( $yesno, 'cfg_iCalAnonymousFeed', 'class="inputbox" size="1"', 'value', 'text', (int)$mrConfig[ 'iCalAnonymousFeed' ] );
		
		if ( !$thisJRUser->simple_configuration )
			{
			$configurationPanel->startPanel( jr_gettext( _JOMRES_ICAL_FEEDS, '_JOMRES_ICAL_FEEDS', false ) );
			
			//iCal feed settings			
			$configurationPanel->insertDescription(jr_gettext( _JOMRES_ICAL_FEED_SETTINGS_DESC, '_JOMRES_ICAL_FEED_SETTINGSS_DESC', false ));
			
			$configurationPanel->setleft( jr_gettext( "_JOMRES_ICAL_FEED_INCLUDE_ENQUIRIES", _JOMRES_ICAL_FEED_INCLUDE_ENQUIRIES, false ) );
			$configurationPanel->setmiddle( $iCalIncludeEnquiries );
			$configurationPanel->setright( jr_gettext( "_JOMRES_ICAL_FEED_INCLUDE_ENQUIRIES_DESC", _JOMRES_ICAL_FEED_INCLUDE_ENQUIRIES_DESC, false ) );
			$configurationPanel->insertSetting();
			
			$configurationPanel->setleft( jr_gettext( "_JOMRES_ICAL_ALLOW_ANON", _JOMRES_ICAL_ALLOW_ANON, false ) );
			$configurationPanel->setmiddle( $iCalAnonymousFeed );
			$configurationPanel->setright( jr_gettext( "_JOMRES_ICAL_ALLOW_ANON_DESC", _JOMRES_ICAL_ALLOW_ANON_DESC, false ) );
			$configurationPanel->insertSetting();

			$configurationPanel->endPanel();
			}
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
