<?php
/**
 * Core file
 *
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 8
 * @package Jomres
 * @copyright	2005-2015 Vince Wooll
 * Jomres (tm) PHP, CSS & Javascript files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly.
 **/


// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

class jomres_check_support_key
	{
	function __construct( $task , $force_check = false )
		{
		$this->task      = $task;
		$this->key_valid = false;
		$this->force_check = $force_check;
		
		if ( isset( $_REQUEST[ 'support_key' ] ) && strlen( $_REQUEST[ 'support_key' ] ) > 0 ) 
			$this->save_key( $task );
		
		if (!isset($_REQUEST['task']))
			$_REQUEST['task'] = "";
		
		if ($_REQUEST['task'] == "site_settings" || $_REQUEST['task'] == "showplugins" || $_REQUEST['task'] == "addplugin" )
			$this->force_check = true;
		
		$this->check_license_key(  );
		}

	function check_license_key(  )
		{
		$siteConfig = jomres_singleton_abstract::getInstance( 'jomres_config_site_singleton' );
		$jrConfig	= $siteConfig->get();
		
		$str            = "key=" . $jrConfig['licensekey'];
		$this->key_hash =  $jrConfig['licensekey'];
		
		if (file_exists( JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php"))
			{
			$last_modified    = filemtime( JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php");
			$seconds_timediff = time() - $last_modified;
			if ( $seconds_timediff > 3600 ) 
				{
				unlink(JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php" );
				}
			else
				{
				include( JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php" );
				}
			}

		if ( function_exists( "curl_init" ) && !file_exists( JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php") || $this->force_check )
			{
			$buffer = queryUpdateServer( "check_key.php", $str, "updates" );
			if ($buffer != "")
				{
				$license_data =json_decode($buffer);
				if ($license_data->license_valid === true)
					$license_data->license_valid = "1";
				else
					$license_data->license_valid = "0";
				
				$lic_data = '<?php
defined( \'_JOMRES_INITCHECK\' ) or die( \'\' );
$license_data	= new stdClass;
$license_data->expires = "'.$license_data->expires.'";
$license_data->key_status = "'.$license_data->key_status.'";
$license_data->owner = "'.$license_data->owner.'";
$license_data->license_valid = "'.$license_data->license_valid.'";
$license_data->allows_plugins = "'.$license_data->allows_plugins.'";
';

				file_put_contents( JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . "temp" . JRDS . "license_key_check_cache.php", $lic_data);
				}
			}

		if ( empty( $license_data ) ) // Query failed for some reason, perhaps slow connection
			{
			$this->expires		= "Unknown";
			$this->key_status	= "Unknown";
			$this->owner		= "Unknown";
			$this->owner		= "Unknown";
			$this->allows_plugins = false;
			}
		else
			{
			$this->expires		= $license_data->expires;
			$this->key_status	= $license_data->status;
			$this->owner		= $license_data->owner;
			if ( $license_data->license_valid == true ) 
				$this->key_valid = true;
			$this->allows_plugins		= $license_data->allows_plugins;
			}
		}
	
	
	function show_key_input()
		{
		?>
		<center>
			<form action="<?php echo $this->task; ?>" method="post">
				<div class="jomresinstaller_panel">
					Please enter your support number in the following field.<br/>
					<input class="inputbox" type="text" name="support_key" value="" size="35"/>
				</div>
				<button name="combo" type="submit" value="0"><strong>Save support key</strong></button>
			</form>
		</center>
		<?php
		}

	function save_key( $return_url )
		{
		$siteConfig = jomres_singleton_abstract::getInstance( 'jomres_config_site_singleton' );
		$jrConfig	= $siteConfig->get();
		
		$jrConfig['licensekey'] = trim( $_REQUEST[ 'support_key' ] );
		
		file_put_contents(JOMRESCONFIG_ABSOLUTE_PATH . JRDS . JOMRES_ROOT_DIRECTORY . JRDS . 'configuration.php', 
'<?php
##################################################################
defined( \'_JOMRES_INITCHECK\' ) or die( \'\' );
##################################################################

$jrConfig = ' . var_export($jrConfig, true) . ';
');

		return true;
		}

	}
