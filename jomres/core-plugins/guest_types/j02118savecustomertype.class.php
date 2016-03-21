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

class j02118savecustomertype {
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}

		$defaultProperty=getDefaultProperty();
		
		$id				= (int)jomresGetParam( $_POST, 'typeid', "" );
		$type			= (string)jomresGetParam( $_POST, 'type', "" );
		$notes			= (string)jomresGetParam( $_POST, 'notes', "" );
		$maximum		= (int) jomresGetParam( $_POST, 'maximum', "" );
		$is_percentage	= (int)jomresGetParam( $_POST, 'is_percentage', 0 );
		$is_child		= (int)jomresGetParam( $_POST, 'is_child', 0 ) ;
		$posneg			= (int) jomresGetParam( $_POST, 'posneg', 0 );
		$variance		= (float)jomresGetParam( $_POST, 'variance', 0.0 );

		$saveMessage=jr_gettext('_JOMRES_COM_MR_CUSTOMERTYPE_UPDATED',_JOMRES_COM_MR_CUSTOMERTYPE_UPDATED,FALSE);
		if ($id=="")
			{
			$auditMessage=jr_gettext('_JOMRES_MR_AUDIT_INSERT_CUSTOMERTYPE',_JOMRES_MR_AUDIT_INSERT_CUSTOMERTYPE,FALSE);
			$query="INSERT INTO #__jomres_customertypes (`type`,`notes`,`maximum`,`is_percentage`,`posneg`,`variance`,`property_uid`,`is_child`)VALUES('$type','$notes','".(int)$maximum."','".(int)$is_percentage."','".(int)$posneg."','$variance','".(int)$defaultProperty."','".$is_child."')";
			}
		else
			{
			$auditMessage=jr_gettext('_JOMRES_MR_AUDIT_UPDATE_CUSTOMERTYPE',_JOMRES_MR_AUDIT_UPDATE_CUSTOMERTYPE,FALSE);
			$query="UPDATE #__jomres_customertypes SET `type`='$type',`notes`='$notes',`maximum`='".(int)$maximum."',`is_percentage`='".(int)$is_percentage."',`posneg`='".$posneg."',`variance`='$variance', `is_child`='".$is_child."' WHERE id = '$id' AND property_uid='$defaultProperty'";
			}
		
		$jomres_messaging =jomres_getSingleton('jomres_messages');
		//$jomres_messaging = new jomres_messages();
		$jomres_messaging->set_message($saveMessage);
		
		if (!doInsertSql($query,$auditMessage))
			trigger_error ("Unable to create customer type, mysql db failure ".$query, E_USER_ERROR);
		else
			jomresRedirect( jomresURL(JOMRES_SITEPAGE_URL."&task=listCustomerTypes"), $saveMessage );
		}

	/**
	#
	 * Must be included in every mini-component
	#
	 * Returns any settings the the mini-component wants to send back to the calling script. In addition to being returned to the calling script they are put into an array in the mcHandler object as eg. $mcHandler->miniComponentData[$ePoint][$eName]
	#
	 */
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
?>