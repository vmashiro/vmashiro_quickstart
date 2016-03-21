<?php
/**
 * Plugin
 * @author Vince Wooll <sales@jomres.net>
 * @version Jomres 4 
* @package Jomres
* @copyright	2005-2010 Vince Wooll
* Jomres (tm) PHP files are released under both MIT and GPL2 licenses. This means that you can choose the license that best suits your project, and use it accordingly, however all images, css and javascript which are copyright Vince Wooll are not GPL licensed and are not freely distributable. 
**/

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################

jr_define('PAYPAL_API_KEY_TITLE',"Paypal API Key");
jr_define('PAYPAL_API_KEY_TITLE_DESC',"Configure your Paypal Client ID and Secret for both your live and Sandbox accounts. Once configured you will be able to take both booking and invoice payments through Paypal.");

jr_define('PAYPAL_API_CLIENTID',"Client ID");
jr_define('PAYPAL_API_SECRET',"Secret");
jr_define('PAYPAL_API_CLIENTID_SANDBOX',"Sandbox Client ID");
jr_define('PAYPAL_API_SECRET_SANDBOX',"Sandbox Secret");

jr_define('PAYPAL_API_CLIENTID_FINDING',"How do you find your Client ID and Secret?");

jr_define('PAYPAL_API_CLIENTID_STEP1','Go to https://developer.paypal.com/ and Log In.');
jr_define('PAYPAL_API_CLIENTID_STEP2',"Go to Applications in the main menu.");
jr_define('PAYPAL_API_CLIENTID_STEP3',"click Create App to create a new App");
jr_define('PAYPAL_API_CLIENTID_STEP4',"Give your App a name, then click Create App.");
jr_define('PAYPAL_API_CLIENTID_STEP5',"Once saved, in the REST API list click on the new App's name.");
jr_define('PAYPAL_API_CLIENTID_STEP6',"On this page you can see your Client ID and Secret. Copy and Paste those keys into the respective fields above.");
