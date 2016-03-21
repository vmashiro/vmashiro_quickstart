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

class j02144editextra {
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=true; return;
			}
		
		$ePointFilepath = get_showtime('ePointFilepath');
		$mrConfig=getPropertySpecificSettings();

		$uid		= intval(jomresGetParam( $_REQUEST, 'uid', 0 ));

		$defaultProperty=getDefaultProperty();
		
		$jrportal_taxrate = jomres_singleton_abstract::getInstance( 'jrportal_taxrate' );
		
		$jomres_media_centre_images = jomres_singleton_abstract::getInstance( 'jomres_media_centre_images' );
		$jomres_media_centre_images->get_images($defaultProperty, array('extras'));
		
		$yesno = array();
		$yesno[] = jomresHTML::makeOption( '0', jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false) );
		$yesno[] = jomresHTML::makeOption( '1', jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false) );
		
		$output=array();
		
		$output[ 'EXTRA_IMAGE' ] = $jomres_media_centre_images->multi_query_images['noimage-small'];
		if (isset($jomres_media_centre_images->images['extras'][ $uid ][0]['small']))
			$output[ 'EXTRA_IMAGE' ] = $jomres_media_centre_images->images['extras'][ $uid ][0]['small'];
				
		$output['PAGETITLE']=jr_gettext('_JOMRES_HEDIT_EXTRA',_JOMRES_HEDIT_EXTRA,false);
		$output['HEXNAME']=jr_gettext('_JOMRES_COM_MR_EXTRA_NAME',_JOMRES_COM_MR_EXTRA_NAME,false);
		$output['HEXDESC']=jr_gettext('_JOMRES_COM_MR_EXTRA_DESC',_JOMRES_COM_MR_EXTRA_DESC,false);
		$output['HEXPRICE']=jr_gettext('_JOMRES_COM_MR_EXTRA_PRICE',_JOMRES_COM_MR_EXTRA_PRICE,false);
		$output['HMAXQUANTITY']=jr_gettext('_JOMRES_COM_MR_EXTRA_QUANTITY',_JOMRES_COM_MR_EXTRA_QUANTITY,false);
		$output['HTAXRATE']=jr_gettext('_JRPORTAL_INVOICES_LINEITEMS_TAX_RATE',_JRPORTAL_INVOICES_LINEITEMS_TAX_RATE,false);
		$output['HAUTO_SELECT']=jr_gettext('_JOMRES_COM_MR_EXTRA_AUTO_SELECT',_JOMRES_COM_MR_EXTRA_AUTO_SELECT,false);
		$output['HVALIDFROM']=jr_gettext('_JRPORTAL_COUPONS_VALIDFROM',_JRPORTAL_COUPONS_VALIDFROM,false);
		$output['HVALIDTO']=jr_gettext('_JRPORTAL_COUPONS_VALIDTO',_JRPORTAL_COUPONS_VALIDTO,false);
		$output['EXTRAS_INCLUDE_IN_PROPERTYDETAILS']=jr_gettext('EXTRAS_INCLUDE_IN_PROPERTYDETAILS',EXTRAS_INCLUDE_IN_PROPERTYDETAILS,false);
		$output['HIMAGE']=jr_gettext('_JOMRES_IMAGE',_JOMRES_IMAGE,false);
		$output['HROOMTYPEDROPDOWN']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS',_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS,false);

		
		$output['HMAXQUANTITYINFO']=jr_gettext('_JOMRES_COM_MR_EXTRA_QUANTITY_DESC',_JOMRES_COM_MR_EXTRA_QUANTITY_DESC,false);

		$jrtbar =jomres_getSingleton('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		$jrtb .= $jrtbar->toolbarItem('save','','',true,'saveExtra');
		$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL."&task=listExtras"),'');
		//$jrtb .= $jrtbar->toolbarItem('delete',jomresURL(JOMRES_SITEPAGE_URL."&task=deleteExtra&no_html=1&uid=$uid"),'');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$output['EXTRAID']= $uid;

		$output['EXTRAMODEL_PERWEEK_CHECKED']="";
		$output['EXTRAMODEL_PERDAYS_CHECKED']="";
		$output['EXTRAMODEL_PERBOOKING_CHECKED']="";
		$output['EXTRAMODEL_PERPERSONPERBOOKING_CHECKED']="";
		$output['EXTRAMODEL_PERPERSONPERDAY_CHECKED']="";
		$output['EXTRAMODEL_PERPERSONPERWEEK_CHECKED']="";
		$output['EXTRAMODEL_PERDAYSMINDAYS_CHECKED']="";
		$output['EXTRAMODEL_PERDAYSPERROOM_CHECKED']="";
		$output['EXTRAMODEL_PERROOMPERBOOKING_CHECKED']="";
		$output['EXTRAMODEL_COMMISSION_CHECKED']="";
		
		
		$force=0;
		$output['EXTRAMODEL_FORCE1']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE2']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE3']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE4']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE5']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE6']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE7']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE8']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE9']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		$output['EXTRAMODEL_FORCE100']	=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $force );
		
		$output['VALIDFROM']=generateDateInput("validfrom",'' );
		$output['VALIDTO']=generateDateInput("validto",'');
				
		$basic_property_details =jomres_singleton_abstract::getInstance('basic_property_details');
		$basic_property_details->gather_data($defaultProperty);
		
		if ( get_showtime( 'include_room_booking_functionality' ) ) 
			{
			$room_type_dropdown_contents = array();
			$room_type_dropdown_contents[] = jomresHTML::makeOption(0, jr_gettext('_JOMRES_FRONT_ROOMSMOKING_EITHER',_JOMRES_FRONT_ROOMSMOKING_EITHER,false,false) );
			
			foreach ($basic_property_details->room_types as $k=>$v)
				{
				$room_type_dropdown_contents[] = jomresHTML::makeOption($k, jr_gettext('_JOMRES_CUSTOMTEXT_ROOMTYPES_ABBV'.$k,stripslashes($v['abbv']),false,false) );
				}
			}
		
		$mindays = 1;
		if ($uid>0)
			{
			$query="SELECT model,params,`force` FROM #__jomcomp_extrasmodels_models WHERE extra_id = '".(int)$uid."' LIMIT 1";
			$model=doSelectSql($query,2);
			if (!isset($model['model']))
				$model['model']=2;
			switch ($model['model'])
				{
				case '1':
					$output['EXTRAMODEL_PERWEEK_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE1']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '2':
					$output['EXTRAMODEL_PERDAYS_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE2']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '3':
					$output['EXTRAMODEL_PERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE3']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '4':
					$output['EXTRAMODEL_PERPERSONPERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE4']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '5':
					$output['EXTRAMODEL_PERPERSONPERDAY_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE5']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '6':
					$output['EXTRAMODEL_PERPERSONPERWEEK_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE6']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '7':
					$output['EXTRAMODEL_PERDAYSMINDAYS_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE7']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
					$mindays=$model['params'];
				break;
				case '8':
					$output['EXTRAMODEL_PERDAYSPERROOM_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE8']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '9':
					$output['EXTRAMODEL_PERROOMPERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE9']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '100':
					$output['EXTRAMODEL_COMMISSION_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE100']=jomresHTML::selectList( $yesno, 'force[100]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] , false );
				break;
				}

			$query = $query="SELECT `name`,`desc`,`price`,`auto_select`,`tax_rate`,`maxquantity`,`validfrom`,`validto`,`include_in_property_lists`,`limited_to_room_type` FROM `#__jomres_extras` WHERE uid = '".(int)$uid."' AND property_uid = '".(int)$defaultProperty."'";
			$exList =doSelectSql($query);
			
			foreach($exList as $ex)
				{
				if ( is_null($ex->validfrom))
					{
					$ex->validfrom = date( "Y/m/d" );
					$ex->validto = date( "Y/m/d", strtotime( "+10 years" ) );
					}
				$output['EXDESCRIPTION']				= stripslashes($ex->desc);
				$output['EXNAME']						= stripslashes($ex->name);
				$output['EXPRICE']						= $ex->price;
				$output['MAXQUANTITYDROPDOWN']			= jomresHTML::integerSelectList( 01, 1000, 1, "maxquantity", 'size="1" class="inputbox"', $ex->maxquantity, "%02d" );
				$output['TAXRATEDROPDOWN']				= $jrportal_taxrate->makeTaxratesDropdown( $ex->tax_rate );
				$output['AUTO_SELECT']					= jomresHTML::selectList( $yesno, 'auto_select', 'class="inputbox" size="1"', 'value', 'text', $ex->auto_select );
				$output['VALIDFROM']					= generateDateInput("validfrom",str_replace("-","/",$ex->validfrom) );
				$output['VALIDTO']						= generateDateInput("validto",str_replace("-","/",$ex->validto));
				$output['INCLUDE_IN_PROPERTY_LISTS']	= jomresHTML::selectList( $yesno, 'include_in_property_lists', 'class="inputbox" size="1"', 'value', 'text', $ex->include_in_property_lists );
				if ( count ($room_type_dropdown_contents) > 0)
					$output['ROOMTYPEDROPDOWN']				= jomresHTML::selectList($room_type_dropdown_contents, 'limited_to_room_type', 'class="inputbox" size="1"', 'value', 'text', $ex->limited_to_room_type);
				}
			}
		else
			{
			$output['EXTRAMODEL_PERWEEK_CHECKED']	= "checked";
			$output['MAXQUANTITYDROPDOWN']			= jomresHTML::integerSelectList( 01, 1000, 1, "maxquantity", 'size="1" class="inputbox"', 1, "%02d" );
			$output['TAXRATEDROPDOWN']				= $jrportal_taxrate->makeTaxratesDropdown( $mrConfig['accommodation_tax_code'] );
			$model['model']							= 2;
			$model['force']							= 0;
			$output['AUTO_SELECT']					= jomresHTML::selectList( $yesno, 'auto_select', 'class="inputbox" size="1"', 'value', 'text', 0 );
			$output['INCLUDE_IN_PROPERTY_LISTS']	= jomresHTML::selectList( $yesno, 'include_in_property_lists', 'class="inputbox" size="1"', 'value', 'text', 1 );
			if ( count ($room_type_dropdown_contents) > 0)
				$output['ROOMTYPEDROPDOWN']				= jomresHTML::selectList($room_type_dropdown_contents, 'limited_to_room_type', 'class="inputbox" size="1"', 'value', 'text', 0 );
			
			switch ($model['model'])
				{
				case '1':
					$output['EXTRAMODEL_PERWEEK_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE1']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '2':
					$output['EXTRAMODEL_PERDAYS_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE2']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '3':
					$output['EXTRAMODEL_PERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE3']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '4':
					$output['EXTRAMODEL_PERPERSONPERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE4']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '5':
					$output['EXTRAMODEL_PERPERSONPERDAY_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE5']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '6':
					$output['EXTRAMODEL_PERPERSONPERWEEK_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE6']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '7':
					$output['EXTRAMODEL_PERDAYSMINDAYS_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE7']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
					$mindays=$model['params'];
				break;
				case '8':
					$output['EXTRAMODEL_PERDAYSPERROOM_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE8']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '9':
					$output['EXTRAMODEL_PERROOMPERBOOKING_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE9']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				case '100':
					$output['EXTRAMODEL_COMMISSION_CHECKED']="checked";
					$output['EXTRAMODEL_FORCE100']=jomresHTML::selectList( $yesno, 'force[]', 'class="inputbox" size="1"', 'value', 'text', $model['force'] );
				break;
				}
			
			}


		$output['MINDAYSDROPDOWN']= jomresHTML::integerSelectList( 1, 100, 1, 'mindays', 'size="1" class="inputbox"', $mindays, "" );

		$output['EXTRAMODEL_PERWEEK']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERWEEK',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERWEEK,false);
		$output['EXTRAMODEL_PERDAYS']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYS',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYS,false);
		$output['EXTRAMODEL_PERBOOKING']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERBOOKING',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERBOOKING,false);
		$output['EXTRAMODEL_PERPERSONPERBOOKING']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERBOOKING',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERBOOKING,false);
		$output['EXTRAMODEL_PERPERSONPERDAY']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERDAY',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERDAY,false);
		$output['EXTRAMODEL_PERPERSONPERWEEK']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERWEEK',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERWEEK,false);
		$output['EXTRAMODEL_PERDAYSMINDAYS']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYSMINDAYS',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYSMINDAYS,false);
		$output['EXTRAMODEL_PERDAYSPERROOM']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYSPERROOM',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYSPERROOM,false);
		$output['EXTRAMODEL_PERROOMPERBOOKING']=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERROOMPERBOOKING',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERROOMPERBOOKING,false);
		$output['_JOMRES_COMMISSION']=jr_gettext('_JOMRES_COMMISSION',_JOMRES_COMMISSION,false);

		$output['JOMRES_SITEPAGE_URL']=JOMRES_SITEPAGE_URL;
		
		if (get_showtime('include_room_booking_functionality'))
			{
			$r = array();
			$r['EXTRAMODEL_PERWEEK_CHECKED']=$output['EXTRAMODEL_PERWEEK_CHECKED'];
			$r['EXTRAMODEL_PERWEEK']=$output['EXTRAMODEL_PERWEEK'];
			$r['EXTRAMODEL_FORCE1']=$output['EXTRAMODEL_FORCE1'];
			$r['EXTRAMODEL_PERDAYS_CHECKED']=$output['EXTRAMODEL_PERDAYS_CHECKED'];
			$r['EXTRAMODEL_PERDAYS']=$output['EXTRAMODEL_PERDAYS'];
			$r['EXTRAMODEL_FORCE2']=$output['EXTRAMODEL_FORCE2'];
			$r['EXTRAMODEL_PERBOOKING_CHECKED']=$output['EXTRAMODEL_PERBOOKING_CHECKED'];
			$r['EXTRAMODEL_PERBOOKING']=$output['EXTRAMODEL_PERBOOKING'];
			$r['EXTRAMODEL_FORCE3']=$output['EXTRAMODEL_FORCE3'];
			$r['EXTRAMODEL_PERPERSONPERBOOKING_CHECKED']=$output['EXTRAMODEL_PERPERSONPERBOOKING_CHECKED'];
			$r['EXTRAMODEL_PERPERSONPERBOOKING']=$output['EXTRAMODEL_PERPERSONPERBOOKING'];
			$r['EXTRAMODEL_FORCE4']=$output['EXTRAMODEL_FORCE4'];
			$r['EXTRAMODEL_PERPERSONPERDAY_CHECKED']=$output['EXTRAMODEL_PERPERSONPERDAY_CHECKED'];
			$r['EXTRAMODEL_PERPERSONPERDAY']=$output['EXTRAMODEL_PERPERSONPERDAY'];
			$r['EXTRAMODEL_FORCE5']=$output['EXTRAMODEL_FORCE5'];
			$r['EXTRAMODEL_PERPERSONPERWEEK_CHECKED']=$output['EXTRAMODEL_PERPERSONPERWEEK_CHECKED'];
			$r['EXTRAMODEL_PERPERSONPERWEEK']=$output['EXTRAMODEL_PERPERSONPERWEEK'];
			$r['EXTRAMODEL_FORCE6']=$output['EXTRAMODEL_FORCE6'];
			$r['EXTRAMODEL_PERDAYSMINDAYS_CHECKED']=$output['EXTRAMODEL_PERDAYSMINDAYS_CHECKED'];
			$r['EXTRAMODEL_PERDAYSMINDAYS']=$output['EXTRAMODEL_PERDAYSMINDAYS'];
			$r['MINDAYSDROPDOWN']=$output['MINDAYSDROPDOWN'];
			$r['EXTRAMODEL_FORCE7']=$output['EXTRAMODEL_FORCE7'];
			$r['EXTRAMODEL_PERDAYSPERROOM_CHECKED']=$output['EXTRAMODEL_PERDAYSPERROOM_CHECKED'];
			$r['EXTRAMODEL_PERDAYSPERROOM']=$output['EXTRAMODEL_PERDAYSPERROOM'];
			$r['EXTRAMODEL_FORCE8']=$output['EXTRAMODEL_FORCE8'];
			$r['EXTRAMODEL_PERROOMPERBOOKING_CHECKED']=$output['EXTRAMODEL_PERROOMPERBOOKING_CHECKED'];
			$r['EXTRAMODEL_PERROOMPERBOOKING']=$output['EXTRAMODEL_PERROOMPERBOOKING'];
			$r['EXTRAMODEL_FORCE9']=$output['EXTRAMODEL_FORCE9'];
			$r['_JOMRES_EXTRAS_MODELS_MODEL']=jr_gettext('_JOMRES_EXTRAS_MODELS_MODEL',_JOMRES_EXTRAS_MODELS_MODEL,false);
			$r['_JOMRES_EXTRAS_MODELS_PARAMS']=jr_gettext('_JOMRES_EXTRAS_MODELS_PARAMS',_JOMRES_EXTRAS_MODELS_PARAMS,false);
			$r['_JOMRES_EXTRAS_MODELS_FORCE']=jr_gettext('_JOMRES_EXTRAS_MODELS_FORCE',_JOMRES_EXTRAS_MODELS_FORCE,false);
			$r['EXTRAMODEL_FORCE100']=$output['EXTRAMODEL_FORCE100'];
			$r['EXTRAMODEL_COMMISSION_CHECKED']=$output['EXTRAMODEL_COMMISSION_CHECKED'];
			$r['_JOMRES_COMMISSION']=$output['_JOMRES_COMMISSION'];
			$r['COMMISSION']=$percentage;
			$extra_models = array($r);
			}
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'edit_extra.html' );
		$tmpl->addRows( 'extra_models', $extra_models );
		$tmpl->addRows( 'pageoutput', $pageoutput );
		$tmpl->displayParsedTemplate();
		}

	function touch_template_language()
		{
		$output=array();

		$output[]		=jr_gettext('_JOMRES_COM_MR_EXTRA_TITLE',_JOMRES_COM_MR_EXTRA_TITLE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_EXTRA_NAME',_JOMRES_COM_MR_EXTRA_NAME);
		$output[]		=jr_gettext('_JOMRES_COM_MR_EXTRA_DESC',_JOMRES_COM_MR_EXTRA_DESC);
		$output[]		=jr_gettext('_JOMRES_COM_MR_EXTRA_PRICE',_JOMRES_COM_MR_EXTRA_PRICE);
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERWEEK','Calculated per week');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYS','Calculated per days');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERBOOKING','Calculated per booking');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERBOOKING','Calculated per person per booking');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERDAY','Calculated per person per day');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERPERSONPERWEEK','Calculated per person per week');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERDAYSMINDAYS','Calculated per days (min days)');
		$output[]		=jr_gettext('_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERROOMPERBOOKING',_JOMRES_CUSTOMTEXT_EXTRAMODEL_PERROOMPERBOOKING);
		$output[]		=jr_gettext('_JOMRES_COM_MR_EXTRA_AUTO_SELECT',_JOMRES_COM_MR_EXTRA_AUTO_SELECT);

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