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

class j03381room_features
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
		$thisJRUser = jomres_singleton_abstract::getInstance( 'jr_user' );
		if (!$thisJRUser->userIsManager)
			{
			return;
			}
		
		$dropdown = '';
		$defaultProperty = getDefaultProperty();

		$query = "SELECT `room_features_uid`,`feature_description` FROM #__jomres_room_features WHERE property_uid = " . (int) $defaultProperty . " ";
		$featuresList = doSelectSql ($query);
		if (count ($featuresList) > 0 )
			{
			$resource_options = array();
			foreach ( $featuresList as $feature )
				{
				$resource_options[ ] = jomresHTML::makeOption( $feature->room_features_uid, jr_gettext( '_JOMRES_CUSTOMTEXT_ROOMFEATURE_DESCRIPTION' . $feature->room_features_uid, htmlspecialchars( trim( stripslashes( $feature->feature_description ) ), ENT_QUOTES ) ) );
				}
			$use_bootstrap_radios = false;
			$dropdown = jomresHTML::selectList( $resource_options, 'resource_id', ' autocomplete="off" class="inputbox" size="1" ', 'value', 'text', '' , $use_bootstrap_radios );
			}
		$this->ret_vals = $dropdown;
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->ret_vals;
		}
	}

?>