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
 * Constructs and displays tariff list
 #
* @package Jomres
#
 */
class j06002list_tariffs_advanced {
	/**
	#
	 * Constructor: Constructs and displays tariff list - admin side
	#
	 */
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=true; return;
			}
		$ePointFilepath=get_showtime('ePointFilepath');
		$mrConfig=getPropertySpecificSettings();
		
		if ($mrConfig['tariffmode']!='1' || $mrConfig[ 'is_real_estate_listing' ] == '1' || get_showtime('is_jintour_property'))
			return;

		$siteConfig = jomres_singleton_abstract::getInstance('jomres_config_site_singleton');
		$jrConfig=$siteConfig->get();
		
		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$toolbar = jomres_singleton_abstract::getInstance( 'jomresItemToolbar' );
		
		$defaultProperty=getDefaultProperty();
		$query="SELECT rates_uid,rate_title,rate_description,validfrom,validto,roomrateperday,mindays,maxdays,minpeople,maxpeople,roomclass_uid,ignore_pppn,allow_ph,allow_we,weekendonly,property_uid FROM #__jomres_rates WHERE property_uid = '".(int)$defaultProperty."' ORDER BY roomclass_uid,validfrom,rate_description";
		$tariffList =doSelectSql($query);

		foreach($tariffList as $tariff)
			{
			$rw=array();
			$tariffRoomClass=$tariff->roomclass_uid;
			$roomClassAbbv="";
			if ($tariffRoomClass!="")
				{
				$roomClassAbbv = $current_property_details->all_room_types[ $tariffRoomClass ][ 'room_class_abbv' ];
				}
			if ($tariff->ignore_pppn)
				$ignore_pppn=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
			else
				$ignore_pppn=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);

			if ($tariff->allow_ph)
				$allow_ph=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
			else
				$allow_ph=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);

			if ($tariff->allow_we)
				$allow_we=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
			else
				$allow_we=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);

			if ($tariff->weekendonly)
				$weekendonly=jr_gettext('_JOMRES_COM_MR_YES',_JOMRES_COM_MR_YES,false);
			else
				$weekendonly=jr_gettext('_JOMRES_COM_MR_NO',_JOMRES_COM_MR_NO,false);

			if (!using_bootstrap())
				{
				$jrtbar =jomres_singleton_abstract::getInstance('jomres_toolbar');
				$jrtb  = $jrtbar->startTable();
				$jrtb .= $jrtbar->toolbarItem('edit',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_advanced&tariffUid=".$tariff->rates_uid ),'');
				$jrtb .= $jrtbar->toolbarItem('copy',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_advanced&tariffUid=".$tariff->rates_uid."&clone=1"),'');
				$jrtb .= $jrtbar->toolbarItem('delete',jomresURL(JOMRES_SITEPAGE_URL."&task=delete_tariff_advanced&tariffUid=".$tariff->rates_uid),'');
				$jrtb .= $jrtbar->endTable();
				$rw['LINKTEXT']=$jrtb;
				}
			else
				{
				$toolbar->newToolbar();
				$toolbar->addItem( 'icon-edit', 'btn btn-info', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=edit_tariff_advanced' . '&tariffUid=' . $tariff->rates_uid ), jr_gettext( 'COMMON_EDIT', COMMON_EDIT, false ) );
				$toolbar->addSecondaryItem( 'icon-copy', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=edit_tariff_advanced' . '&tariffUid=' . $tariff->rates_uid . "&clone=1" ), jr_gettext( '_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE', _JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE, false ) );
				$toolbar->addSecondaryItem( 'icon-trash', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=delete_tariff_advanced' . '&tariffUid=' . $tariff->rates_uid ), jr_gettext( 'COMMON_DELETE', COMMON_DELETE, false ) );
				$rw['LINKTEXT']=$toolbar->getToolbar();
				}
			
			$rw['RATETITLE']		=jr_gettext('_JOMRES_CUSTOMTEXT_TARIFF_TITLE'.$tariff->rates_uid,stripslashes($tariff->rate_title));
			$rw['RATEDESCRIPTION']		=jr_gettext('_JOMRES_CUSTOMTEXT_TARIFF_DESCRIPTION'.$tariff->rates_uid,stripslashes($tariff->rate_description));
			$rw['VALIDFROM']		=outputDate($tariff->validfrom);
			$rw['VALIDTO']			=outputDate($tariff->validto);
			$rw['ROOMRATEPERDAY']	=output_price($tariff->roomrateperday);
			$rw['MINDAYS']			=$tariff->mindays;
			$rw['MAXDAYS']			=$tariff->maxdays;
			$rw['MINPEOPLE']		=$tariff->minpeople;
			$rw['MAXPEOPLE']		=$tariff->maxpeople;
			$rw['ROOMCLASS']		=$roomClassAbbv;
			$rw['IGNOREPPN']		=$ignore_pppn;
			$rw['ALLOWWE']			=$allow_we;
			$rw['WEEKENDONLY']		=$weekendonly;
			$rows[]=$rw;
			}

		$output['HLINKTEXT']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXT',_JOMRES_COM_MR_LISTTARIFF_LINKTEXT,false);
		$output['HLINKTEXTCLONE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE',_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE,false);
		$output['HRATETITLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATETITLE',_JOMRES_COM_MR_LISTTARIFF_RATETITLE,false) ;
		$output['HRATEDESCRIPTION']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATEDESCRIPTION',_JOMRES_COM_MR_LISTTARIFF_RATEDESCRIPTION,false);
		$output['HVALIDFROM']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_VALIDFROM',_JOMRES_COM_MR_LISTTARIFF_VALIDFROM,false);
		$output['HVALIDTO']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_VALIDTO',_JOMRES_COM_MR_LISTTARIFF_VALIDTO,false);

		if ($mrConfig['tariffChargesStoredWeeklyYesNo']=="1")
			$output['HROOMRATEPERDAY']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERWEEK',_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERWEEK,false);
		else
			$output['HROOMRATEPERDAY']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERDAY',_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERDAY,false);
		$output['HMINDAYS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINDAYS',_JOMRES_COM_MR_LISTTARIFF_MINDAYS,false);
		$output['HMAXDAYS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXDAYS',_JOMRES_COM_MR_LISTTARIFF_MAXDAYS,false);
		$output['HMINPEOPLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE,false);
		$output['HMAXPEOPLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE,false);
		$output['HROOMCLASS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS',_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS,false);
		$output['HIGNOREPPN']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_IGNOREPPN',_JOMRES_COM_MR_LISTTARIFF_IGNOREPPN,false);
		$output['HALLOWWE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ALLOWWE',_JOMRES_COM_MR_LISTTARIFF_ALLOWWE,false);
		$output['HWEEKENDONLY']=jr_gettext('_JOMRES_COM_WEEKENDONLY',_JOMRES_COM_WEEKENDONLY,false);

		$jrtbar =jomres_singleton_abstract::getInstance('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		$jrtb .= $jrtbar->toolbarItem('new',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_advanced"),'');
		//$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL.""),'');
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$output['pagetitle']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_TITLE',_JOMRES_COM_MR_LISTTARIFF_TITLE,false);
		$output['JOMRES_SITEPAGE_URL']=JOMRES_SITEPAGE_URL;
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'list_advanced_tariffs.html');
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows', $rows );
		$tmpl->displayParsedTemplate();
		}

	function touch_template_language()
		{
		$output=array();

		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXT',_JOMRES_COM_MR_LISTTARIFF_LINKTEXT);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE',_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATETITLE',_JOMRES_COM_MR_LISTTARIFF_RATETITLE) ;
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATEDESCRIPTION',_JOMRES_COM_MR_LISTTARIFF_RATEDESCRIPTION);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_VALIDFROM',_JOMRES_COM_MR_LISTTARIFF_VALIDFROM);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_VALIDTO',_JOMRES_COM_MR_LISTTARIFF_VALIDTO);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERWEEK',_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERWEEK);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERDAY',_JOMRES_COM_MR_LISTTARIFF_ROOMRATEPERDAY);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINDAYS',_JOMRES_COM_MR_LISTTARIFF_MINDAYS);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXDAYS',_JOMRES_COM_MR_LISTTARIFF_MAXDAYS);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS',_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_IGNOREPPN',_JOMRES_COM_MR_LISTTARIFF_IGNOREPPN);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ALLOWWE',_JOMRES_COM_MR_LISTTARIFF_ALLOWWE);
		$output[]		=jr_gettext('_JOMRES_COM_WEEKENDONLY',_JOMRES_COM_WEEKENDONLY);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_TITLE',_JOMRES_COM_MR_LISTTARIFF_TITLE);

		foreach ($output as $o)
			{
			echo $o;
			echo "<br/>";
			}
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
		return $this->tpl;
		}
	}
