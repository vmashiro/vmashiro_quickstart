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

class j03379media_centre_resource_type_x_extras
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
			$task != "listExtras" && 
			$task != "editExtra" && 
			$task != "show_property_extras" && 
			$task != "viewproperty" && 
			$task != "dobooking" && 
			$task != "handlereq" 
			)
			return;

		$defaultProperty = get_showtime('property_uid');
		$query="SELECT `uid` FROM `#__jomres_extras` WHERE property_uid = ".(int)$defaultProperty." ";
		$exList =doSelectSql($query);
		
		if ( count($exList) > 0 )
			{
			$this->ret_vals = array ( "resource_type" => "extras" , "resource_id_required" => true , "name" => jr_gettext( '_JOMRES_COM_MR_EXTRA_TITLE', _JOMRES_COM_MR_EXTRA_TITLE, false ) , "notes" => jr_gettext( '_JOMRES_MEDIA_CENTRE_NOTES_CORE_EXTRAS', _JOMRES_MEDIA_CENTRE_NOTES_CORE_EXTRAS, false )  );
			
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