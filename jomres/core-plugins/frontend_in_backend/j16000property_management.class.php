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

class j16000property_management
	{
	function __construct()
		{
		// Must be in all minicomponents. Minicomponents with templates that can contain editable text should run $this->template_touch() else just return 
		$MiniComponents =jomres_getSingleton('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}

		$thisJRUser=jomres_getSingleton('jr_user');
		if (!$thisJRUser->superPropertyManager)
			{
			echo "Sorry, the user you are logged in as must be a Super Property Manager in the frontend for you to be able to administer properties in the administrator area";
			return;
			}
			
		$curl_handle=curl_init();
		curl_setopt($curl_handle,CURLOPT_URL,JOMRES_SITEPAGE_URL_NOSEF."&tmpl=".get_showtime("tmplcomponent")."&is_wrapped=1");
		curl_setopt($curl_handle,CURLOPT_TIMEOUT, 8);
		curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
		curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
		$homepage = curl_exec($curl_handle);
		curl_close($curl_handle);

		echo '
		<style type="text/css">
		#jomres_bootstrap_wrapper .modal.fade.in {top:5%;}
		#jomres_bootstrap_wrapper .modal {left:5%;margin-left:0;width:90%}
		#jomres_bootstrap_wrapper .modal-body {max-height:700px;}
		</style>
		<div class="modal modal-lg hide fade" id="frontend_in_backend">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h3>Jomres Frontend Manager Control Panel</h3>
			</div>
			<div class="modal-body">
				<iframe name="jomres_home" src="'.JOMRES_SITEPAGE_URL_NOSEF.'&tmpl='.get_showtime("tmplcomponent").'&is_wrapped=1" TITLE="" width="100%" height="650" scrolling="yes" frameborder="0"></iframe>
			</div>
		</div>
		';

		echo '<script>jomresJquery(document).ready(function () {jomresJquery( "#frontend_in_backend" ).modal()});</script>
';
		}

	
	
	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return $this->cpanelButton;
		}	
	}
?>