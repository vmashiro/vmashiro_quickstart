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
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to this file is not allowed.' );
// ################################################################

class j00011manager_option_01_tariffs
	{
	function __construct( $componentArgs )
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = true; return;
			}
		$property_uid=getDefaultProperty();
		$mrConfig=getPropertySpecificSettings($property_uid);
		
		if ( $mrConfig[ 'is_real_estate_listing' ] == '1' )
			return;
		
		$title=jr_gettext( '_JOMRES_COM_MR_LISTTARIFF_TITLE', _JOMRES_COM_MR_LISTTARIFF_TITLE, false, false );
		if ($mrConfig['tariffmode']=='0')
			{
			$task="edit_tariffs_normal";
			$title=jr_gettext( '_JOMRES_COM_MR_LISTTARIFF_TITLE', _JOMRES_COM_MR_LISTTARIFF_TITLE, false, false ) . " &amp; " . jr_gettext( '_JOMRES_COM_MR_VRCT_TAB_ROOM', _JOMRES_COM_MR_VRCT_TAB_ROOM, false, false );
			}
		elseif ($mrConfig['tariffmode']=='1')
			$task="list_tariffs_advanced";
		elseif ($mrConfig['tariffmode']=='2')
			$task="list_tariffs_micromanage";

		$this->cpanelButton = jomres_mainmenu_option( JOMRES_SITEPAGE_URL . "&task=".$task, 'enterDeposit.png', $title, null, jr_gettext( "_JOMRES_CUSTOMCODE_JOMRESMAINMENU_RECEPTION_SETTINGS", _JOMRES_CUSTOMCODE_JOMRESMAINMENU_RECEPTION_SETTINGS, false, false ) );
		}

	function touch_template_language()
		{
		$output = array ();

		$output[ ] = jr_gettext( "_JOMRES_CUSTOMCODE_JOMRESMAINMENU_RECEPTION_SETTINGS", _JOMRES_CUSTOMCODE_JOMRESMAINMENU_RECEPTION_SETTINGS );

		foreach ( $output as $o )
			{
			echo $o;
			echo "<br/>";
			}
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->cpanelButton;
		}
	}

?>