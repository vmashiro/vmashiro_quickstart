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

class j03379media_centre_resource_type_room_features
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
		
		$task = get_showtime('task');
		if (
			strpos($task,"media_centre") === false && 
			$task != "list_resource_features" && 
			$task != "show_property_rooms" && 
			$task != "show_property_room" && 
			$task != "viewproperty" && 
			$task != "dobooking" && 
			$task != "handlereq" && 
			$task != "edit_resource_feature" && 
			$task != "asamodule_resources"
			)
			return;

		$defaultProperty = get_showtime('property_uid');
		$query = "SELECT room_features_uid FROM #__jomres_room_features WHERE property_uid = '" . (int) $defaultProperty . "' ";
		$roomFeaturesList = doSelectSql( $query );
		
		if ( count ($roomFeaturesList) > 0 )
			{
			$this->ret_vals = array ( "resource_type" => "room_features" , "resource_id_required" => true , "name" => jr_gettext( '_MEDIA_CENTRE_RESOURCE_FEATURES_ICONS', _MEDIA_CENTRE_RESOURCE_FEATURES_ICONS, false ) , "notes" => '' );
			if ( !AJAXCALL && !defined("MEDIACENTRE_ROOMJS") )
				{
				define ("MEDIACENTRE_ROOMJS",1);
				echo '
				<script>
				jomresJquery(function () {
					jomresJquery("#resource_id_dropdown").change(function () {
						get_existing_images(); 
						});
					});
				</script>
				';
				}
			}
		}

	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->ret_vals;
		}
	}

?>