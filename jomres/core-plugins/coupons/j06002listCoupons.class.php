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

class j06002listCoupons
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath = get_showtime('ePointFilepath');
		$thisJRUser=jomres_getSingleton('jr_user');
		if (!$thisJRUser->userIsManager)
			return;
		
		$toolbar = jomres_singleton_abstract::getInstance( 'jomresItemToolbar' );
		$defaultProperty=getDefaultProperty();
		$output=array();
		$pageoutput=array();
		
		$output['HEDITLINK']=jr_gettext('_JOMRES_COM_MR_EXTRA_LINKTEXT',_JOMRES_COM_MR_EXTRA_LINKTEXT,$editable=false,$isLink=true);
		
		$output['PAGETITLE']=jr_gettext('_JRPORTAL_COUPONS_TITLE',_JRPORTAL_COUPONS_TITLE,false);
		$output['INFO']=jr_gettext('_JRPORTAL_COUPONS_DESC_478',_JRPORTAL_COUPONS_DESC_478,false);
		$output['HCOUPONCODE']=jr_gettext('_JRPORTAL_COUPONS_CODE',_JRPORTAL_COUPONS_CODE,false);
		$output['HVALIDFROM']=jr_gettext('_JRPORTAL_COUPONS_VALIDFROM',_JRPORTAL_COUPONS_VALIDFROM,false);
		$output['HVALIDTO']=jr_gettext('_JRPORTAL_COUPONS_VALIDTO',_JRPORTAL_COUPONS_VALIDTO,false);
		$output['HAMOUNT']=jr_gettext('_JRPORTAL_COUPONS_AMOUNT',_JRPORTAL_COUPONS_AMOUNT,false);
		$output['HISPERCENTAGE']=jr_gettext('_JRPORTAL_COUPONS_ISPERCENTAGE',_JRPORTAL_COUPONS_ISPERCENTAGE,false);
		$output['HROOMONLY']=jr_gettext('_JRPORTAL_COUPONS_ROOMONLY',_JRPORTAL_COUPONS_ROOMONLY,false);
		$output['_JRPORTAL_COUPONS_BOOKING_VALIDFROM']=jr_gettext('_JRPORTAL_COUPONS_BOOKING_VALIDFROM',_JRPORTAL_COUPONS_BOOKING_VALIDFROM,false);
		$output['_JRPORTAL_COUPONS_BOOKING_VALIDTO']=jr_gettext('_JRPORTAL_COUPONS_BOOKING_VALIDTO',_JRPORTAL_COUPONS_BOOKING_VALIDTO,false);
		$output['_JRPORTAL_COUPONS_GUESTNAME']=jr_gettext('_JRPORTAL_COUPONS_GUESTNAME',_JRPORTAL_COUPONS_GUESTNAME,false);
		
		$query = "SELECT `coupon_id`,`coupon_code`,`valid_from`,`valid_to`,`amount`,`is_percentage`,`rooms_only`,`booking_valid_from`,`booking_valid_to`,`guest_uid` FROM #__jomres_coupons WHERE property_uid = ".$defaultProperty;
		$result = doSelectSql($query);
		$rows=array();
		
		$query = "SELECT guests_uid,surname, firstname FROM #__jomres_guests WHERE property_uid = '".(int)$defaultProperty."'";
		$customerDetails =doSelectSql($query);
		$guests_arrray = array();
		if (count($customerDetails)>0)
			{
			foreach ($customerDetails as $c)
				{
				$guests_arrray[$c->guests_uid] = array ("surname"=>$c->surname, "firstname"=>$c->firstname);
				}
			}
		
		$rw['EDITLINK']=$jrtb;
		if (count($result)>0)
			{
			foreach ($result as $coupon)
				{
				$r=array();
				
				if (!using_bootstrap())
					{
					$jrtbar =jomres_getSingleton('jomres_toolbar');
					$jrtb  = $jrtbar->startTable();
					$jrtb .= $jrtbar->toolbarItem('edit',jomresURL(JOMRES_SITEPAGE_URL."&task=editCoupon&coupon_id=".$coupon->coupon_id),'');
					$jrtb .= $jrtbar->toolbarItem('printer',jomresURL(JOMRES_SITEPAGE_URL."&task=print_coupons&tmpl=".get_showtime("tmplcomponent")."&popup=1&coupon_id=".$coupon->coupon_id),'');
					$jrtb .= $jrtbar->toolbarItem('delete',jomresURL(JOMRES_SITEPAGE_URL."&task=deleteCoupon&coupon_id=".$coupon->coupon_id),'');
					$jrtb .= $jrtbar->endTable();
					$r['EDITLINK']=$jrtb;
					}
				else
					{
					$toolbar->newToolbar();
					$toolbar->addItem( 'icon-edit', 'btn btn-info', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=editCoupon' . '&coupon_id=' . $coupon->coupon_id ), jr_gettext( 'COMMON_EDIT', COMMON_EDIT, false ) );
					$toolbar->addSecondaryItem( 'icon-print', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=print_coupons&tmpl='.get_showtime("tmplcomponent").'&popup=1' . '&coupon_id=' . $coupon->coupon_id ), jr_gettext( 'JOMRES_COUPONS_PRINT_COUPONS', JOMRES_COUPONS_PRINT_COUPONS, false ) );
					$toolbar->addSecondaryItem( 'icon-trash', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=deleteCoupon' . '&coupon_id=' . $coupon->coupon_id ), jr_gettext( 'COMMON_DELETE', COMMON_DELETE, false ) );
					$r['EDITLINK']=$toolbar->getToolbar();
					}

				$r['JOMRES_COUPONS_PRINT_COUPONS']=jr_gettext('JOMRES_COUPONS_PRINT_COUPONS',JOMRES_COUPONS_PRINT_COUPONS,false);
				
				$r['COUPONCODE']=$coupon->coupon_code;
				$r['VALIDFROM']=$coupon->valid_from;
				$r['VALIDTO']=$coupon->valid_to;
				$r['AMOUNT']=$coupon->amount;
				$r['ISPERCENTAGE']=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);
				if ($coupon->is_percentage)
					$r['ISPERCENTAGE']=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
				$r['ROOMONLY']=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);
				if ($coupon->rooms_only)
					$r['ROOMONLY']=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
				$r['BOOKING_VALIDFROM']=$coupon->booking_valid_from;
				$r['BOOKING_VALIDTO']=$coupon->booking_valid_to;
				$r['GUEST_NAME']='';
				if ( (int)$coupon->guest_uid > 0 && array_key_exists($coupon->guest_uid,$guests_arrray) )
					$r['GUEST_NAME']=$guests_arrray[$coupon->guest_uid]['firstname']." ".$guests_arrray[$coupon->guest_uid]['surname'];
				$rows[]=$r;
				}
			}

		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		$jrtb .= $jrtbar->toolbarItem('new',jomresURL(JOMRES_SITEPAGE_URL."&task=editCoupon"),'');
		//$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL.""),'');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'list_coupons.html' );
		$tmpl->addRows( 'pageoutput', $pageoutput );
		$tmpl->addRows( 'rows', $rows );
		$tmpl->displayParsedTemplate();
		}
	
	
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->retval;
		}
	}
	




?>