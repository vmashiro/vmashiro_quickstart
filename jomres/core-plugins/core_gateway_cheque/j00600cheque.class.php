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

/**
#
 * Outgoing interrupt for cheque details
 #
* @package Jomres
#
 */

class j00600cheque {
	function __construct($componentArgs)
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=true; return;
			}
		$mrConfig=getPropertySpecificSettings();
		$plugin="cheque";
		$bookingdata=$componentArgs['bookingdata'];
		
		$output=array();
		
		$output['DEPOSIT']=output_price($bookingdata['deposit_required']);
		$output['TOTAL']=output_price($bookingdata['contract_total']);
		$bal=(float)$bookingdata['contract_total']-(float)$bookingdata['deposit_required'];
		$output['BALANCE']=output_price($bal);

		$all_super_property_managers = get_all_super_property_managers();
		$query = "SELECT manager_id FROM #__jomres_managers_propertys_xref WHERE property_uid = ".(int)$bookingdata['property_uid'];
		$result = doSelectSql($query);
		
		$valid_manager_id = 0;
		
		if (count($result)>0)
			{
			foreach ($result as $manager)
				{
				if (!array_key_exists( $manager->manager_id , $all_super_property_managers)) // Make sure this manager isn't a super property manager
					{
					$valid_manager_id = $manager->manager_id;
					}
				}
			}
		
		$manager_details = false;
		if ($valid_manager_id > 0)
			{
			$query = "SELECT `firstname`,`surname`,`house`,`street`,`town`,`county`,`country`,`postcode`,`tel_landline`,`email` FROM #__jomres_guest_profile WHERE `cms_user_id` = ".(int)$valid_manager_id;
			$manager_details = doSelectSql($query,2);
			}

		if ($manager_details != false )
			{
			$output['PROP_NAME']=$manager_details['firstname']." ".$manager_details['surname'] ;
			$output['PROP_STREET']=$manager_details['house']." ".$manager_details['street'];
			$output['PROP_TOWN']=$manager_details['town'];
			$output['PROP_POSTCODE']=$manager_details['postcode'];
			
			$jomres_regions = jomres_singleton_abstract::getInstance( 'jomres_regions' );
			$region_name = jr_gettext( "_JOMRES_CUSTOMTEXT_REGIONS_" .$manager_details['county'], $jomres_regions->regions[ $manager_details['county'] ][ 'regionname' ], false, false );
			
			$output['PROP_REGION']=$region_name;
			$countryname=getSimpleCountry($manager_details['country']);
			$output['PROP_COUNTRY']=ucfirst($countryname);
			$output['PROP_TEL']=$manager_details['tel_landline'];
			$output['PROP_EMAIL']=$manager_details['email'];
			}
		else
			{
			$propertyAddressArray=getPropertyAddressForPrint((int)$bookingdata['property_uid']);
			$propertyContactArray=$propertyAddressArray[1];
			$propertyAddyArray=$propertyAddressArray[2];

			$output['PROP_NAME']=$propertyContactArray[0];
			$output['PROP_STREET']=$propertyContactArray[1];
			$output['PROP_TOWN']=$propertyContactArray[2];
			$output['PROP_POSTCODE']=$propertyContactArray[3];
			$output['PROP_REGION']=$propertyContactArray[4];
			$countryname=getSimpleCountry($propertyContactArray[5]);
			$output['PROP_COUNTRY']=ucfirst($countryname);
			$output['PROP_TEL']=$propertyAddyArray[0];
			$output['PROP_EMAIL']=$propertyAddyArray[2];
			}

		$output['PROP_FAX']=$propertyAddyArray[1];
		
		$output['PROP_URL']=$propertyAddyArray[3];
		
		$output['GATEWAY']=$plugin;
		$output['JR_GATEWAY_SENDDEPOSITTO']=jr_gettext('_JOMRES_CUSTOMTEXT_SENDDEPOSITTO'.$plugin,"Please send your deposit of ");
		$output['JR_GATEWAY_BELOWADDRESS']=jr_gettext('_JOMRES_CUSTOMTEXT_BELOWADDRESS'.$plugin," to the address below ");
		$output['JR_GATEWAY_CONTACTUS1']=jr_gettext('_JOMRES_CUSTOMTEXT_CONTACTUS1'.$plugin,"If you have any problems, please do not hesitate to contact us. You can ring us on ");
		$output['JR_GATEWAY_CONTACTUS2']=jr_gettext('_JOMRES_CUSTOMTEXT_CONTACTUS2'.$plugin," or email us at ");
		$output['_JOMRES_REVIEWS_SUBMIT'] = jr_gettext('_JOMRES_REVIEWS_SUBMIT',_JOMRES_REVIEWS_SUBMIT,false);
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( get_showtime('ePointFilepath') );
		$tmpl->readTemplatesFromInput( 'j00600'.$plugin.'.html' );
		$tmpl->addRows( 'interrupt_outgoing', $pageoutput );
		$tmpl->displayParsedTemplate();
		}
		
	function touch_template_language()
		{
		$output=array();
		$plugin="cheque";

		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_SENDDEPOSITTO'.$plugin,"Please send your deposit of ");
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_BELOWADDRESS'.$plugin," to the address below ");
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_CONTACTUS1'.$plugin,"If you have any problems, please do not hesitate to contact us. You can ring us on ");
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_CONTACTUS2'.$plugin," or email us at ");
		
		foreach ($output as $o)
			{
			echo $o;
			echo "<br/>";
			}
		}
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}		
	}
	
?>