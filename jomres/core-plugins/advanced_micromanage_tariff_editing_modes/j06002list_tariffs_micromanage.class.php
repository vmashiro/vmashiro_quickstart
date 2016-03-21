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
class j06002list_tariffs_micromanage {
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
		
		if ($mrConfig['tariffmode']!='2' || $mrConfig[ 'is_real_estate_listing' ] == '1' || get_showtime('is_jintour_property'))
			return;

		$siteConfig = jomres_singleton_abstract::getInstance('jomres_config_site_singleton');
		$jrConfig=$siteConfig->get();
		$defaultProperty=getDefaultProperty();
	 	if ($jrConfig['useGlobalRoomTypes']=="1")
			$roomTypeSearchParameter="0";
		else
			$roomTypeSearchParameter=$defaultProperty;
		
		$current_property_details = jomres_singleton_abstract::getInstance( 'basic_property_details' );
		$toolbar = jomres_singleton_abstract::getInstance( 'jomresItemToolbar' );

		$query="SELECT `id`,`name` FROM #__jomcomp_tarifftypes WHERE property_uid = '".(int)$defaultProperty."'";
		$tariffList =doSelectSql($query);
		foreach($tariffList as $tariff)
			{
			$rw=array();
			$tariff_type_id = $tariff->id;
			$query="SELECT tariff_id,roomclass_uid FROM #__jomcomp_tarifftype_rate_xref WHERE tarifftype_id = '".(int)$tariff->id."' LIMIT 1";
			$tariffRoomClass =doSelectSql($query,2);
			$query="SELECT mindays,maxdays,minpeople,maxpeople FROM #__jomres_rates WHERE rates_uid = '".(int)$tariffRoomClass['tariff_id']."' LIMIT 1";
			$tariffDetails =doSelectSql($query,2);
			$roomClassAbbv="";
			if ($tariffRoomClass!="")
				{
				$rmClassId=$tariffRoomClass['roomclass_uid'];
				$roomClassAbbv = $current_property_details->all_room_types[ $rmClassId ][ 'room_class_abbv' ];
				}

			if (!using_bootstrap())
				{
				$jrtbar =jomres_singleton_abstract::getInstance('jomres_toolbar');
				$jrtb  = $jrtbar->startTable();
				$jrtb .= $jrtbar->toolbarItem('edit',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_micromanage&tarifftypeid=".($tariff->id) ),'');
				$jrtb .= $jrtbar->toolbarItem('copy',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_micromanage&tarifftypeid=".($tariff->id)."&clone=1"),'');
				$jrtb .= $jrtbar->toolbarItem('delete',jomresURL(JOMRES_SITEPAGE_URL."&task=delete_tariff_micromanage&tarifftypeid=".($tariff->id) ),'');
				$jrtb .= $jrtbar->endTable();
				$rw['LINKTEXT']=$jrtb;
				}
			else
				{
				$toolbar->newToolbar();
				$toolbar->addItem( 'icon-edit', 'btn btn-info', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=edit_tariff_micromanage' . '&tarifftypeid=' . $tariff->id ), jr_gettext( 'COMMON_EDIT', COMMON_EDIT, false ) );
				$toolbar->addSecondaryItem( 'icon-copy', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=edit_tariff_micromanage' . '&tarifftypeid=' . $tariff->id . "&clone=1" ), jr_gettext( '_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE', _JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE, false ) );
				$toolbar->addSecondaryItem( 'icon-trash', '', '', jomresURL( JOMRES_SITEPAGE_URL . '&task=delete_tariff_micromanage' . '&tarifftypeid=' . $tariff->id ), jr_gettext( 'COMMON_DELETE', COMMON_DELETE, false ) );
				$rw['LINKTEXT']=$toolbar->getToolbar();
				}
			
			$rw['RATETITLE']			=$tariff->name;
			$rw['RATETITLE']			=jr_gettext('_JOMRES_CUSTOMTEXT_TARIFF_TITLE_TARIFFTYPE_ID'.$tariff_type_id,stripslashes($tariff->name));
			$rw['MINDAYS']				=$tariffDetails['mindays'];
			$rw['MAXDAYS']				=$tariffDetails['maxdays'];
			$rw['MINPEOPLE']			=$tariffDetails['minpeople'];
			$rw['MAXPEOPLE']			=$tariffDetails['maxpeople'];
			$rw['ROOMCLASS']			=$roomClassAbbv;
			$rows[]=$rw;
			}
		$output['HLINKTEXT']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXT',_JOMRES_COM_MR_LISTTARIFF_LINKTEXT,false);
		//$output['HLINKTEXTCLONE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE',_JOMRES_COM_MR_LISTTARIFF_LINKTEXTCLONE);
		$output['HRATETITLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATETITLE',_JOMRES_COM_MR_LISTTARIFF_RATETITLE,false) ;
		$output['HMINDAYS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINDAYS',_JOMRES_COM_MR_LISTTARIFF_MINDAYS,false);
		$output['HMAXDAYS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXDAYS',_JOMRES_COM_MR_LISTTARIFF_MAXDAYS,false);
		$output['HMINPEOPLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE,false);
		$output['HMAXPEOPLE']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE,false);
		$output['HROOMCLASS']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS',_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS,false);

		$jrtbar =jomres_singleton_abstract::getInstance('jomres_toolbar');
		$jrtb  = $jrtbar->startTable();
		//$jrtb .= $jrtbar->toolbarItem('cancel',jomresURL(JOMRES_SITEPAGE_URL),'');
		$jrtb .= $jrtbar->toolbarItem('new',jomresURL(JOMRES_SITEPAGE_URL."&task=edit_tariff_micromanage"),'');
		
		$jrtb .= $jrtbar->endTable();
		$output['JOMRESTOOLBAR']=$jrtb;

		$output['pagetitle']=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_TITLE',_JOMRES_COM_MR_LISTTARIFF_TITLE,false);
		$output['JOMRES_SITEPAGE_URL']=JOMRES_SITEPAGE_URL;
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'list_micromanage_tariffs.html');
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows', $rows );
		$tmpl->displayParsedTemplate();
		}

	function touch_template_language()
		{
		$output=array();
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_LINKTEXT',_JOMRES_COM_MR_LISTTARIFF_LINKTEXT);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_RATETITLE',_JOMRES_COM_MR_LISTTARIFF_RATETITLE) ;
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINDAYS',_JOMRES_COM_MR_LISTTARIFF_MINDAYS);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXDAYS',_JOMRES_COM_MR_LISTTARIFF_MAXDAYS);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MINPEOPLE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE',_JOMRES_COM_MR_LISTTARIFF_MAXPEOPLE);
		$output[]		=jr_gettext('_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS',_JOMRES_COM_MR_LISTTARIFF_ROOMCLASS);
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
