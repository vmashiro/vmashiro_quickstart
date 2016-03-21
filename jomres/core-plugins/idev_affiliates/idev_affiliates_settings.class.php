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
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class jrportal_idev_affiliates_settings {
	function __construct()
		{
		$this->idaConfigOptions=array();
		$this->idaConfigOptions['idev_affiliates_pathtosalephp']="";
		$this->idaConfigOptions['profile']="";
		}

	function get_idev_affiliates_settings()
		{
		
		$query="SELECT setting,value FROM #__jomres_pluginsettings WHERE prid = 0 AND plugin = 'idev_affiliates_settings'";
		$settingList=doSelectSql($query);
		foreach ($settingList as $s)
			{
			$this->idaConfigOptions[$s->setting]=$s->value;
			}
		return $this->idaConfigOptions;
		}

	function save_idev_affiliates_settings()
		{
		foreach ($_POST as $k=>$v)
			{
			$dirty = (string) $k;
			$k=addslashes($dirty);
			if ($k!='task' && $k!='plugin' && $k !="option" )
				{
				$k=str_replace("http://","", $k);
				$values[$k]=jomresGetParam( $_POST, $k, "" );
				}
			}
			
		foreach ($values as $k=>$v)
			{
			$query="SELECT id FROM #__jomres_pluginsettings WHERE prid = 0 AND plugin = 'idev_affiliates_settings' AND setting = '$k'";
			$settingList=doSelectSql($query);
			if (count($settingList)>0)
				{
				foreach ($settingList as $set)
					{
					$id=$set->id;
					}
				$query="UPDATE #__jomres_pluginsettings SET `value`='$v' WHERE prid = 0 AND plugin = 'idev_affiliates_settings' AND setting = '$k'";
				doInsertSql($query,"");
				}
			else
				{
				$query="INSERT INTO #__jomres_pluginsettings
					(`prid`,`plugin`,`setting`,`value`) VALUES
					(0,'idev_affiliates_settings','$k','$v')";
				doInsertSql($query,"");
				}
			}
		}
	}
?>