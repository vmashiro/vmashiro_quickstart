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
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to '.__FILE__.' is not allowed.' );
// ################################################################

jr_define('_JOMRES_MISCROSOFT_TRANSLATOR',"Microsoft translator");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS',"Microsoft translator settings");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_APIKEY',"Client secret");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_CLIENTID',"Client ID");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SETTINGS_INFO',"This plugin allows you to use the Microsoft Translator service to help you to import automatic translations into your system. You can see information about the service at https://datamarket.azure.com/dataset/bing/microsofttranslator It allows you up to 2,000,000 characters per month for free. Each Jomres language file is approximately 200,000 characters so in theory you could translate up to 10 language files a month. Once you've signed up for the service you need to go to your account at https://datamarket.azure.com/account and view your applications (https://datamarket.azure.com/developer/applications/). Create a new application, using settings similar to those in the image below. The Request URI isn't actually needed by the translation feature but nevertheless you need to enter a URI in that field (don't forget the https://). Click Save and finally, enter the Client ID and Client Secret in the inputs below and save.");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_INSTRUCTIONS',"Choose the languages you're going to translate from and to. Next choose the string you want a translation for and click 'Get translation'. The software will query Microsoft's translation service for a translation and then populate a field so that you can edit the translation if you want, before saving the translation.");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SOURCELANG',"Original language");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_DESTLANG',"New language");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_GETTRANSLATION',"Get translation");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_SAVETRANSLATION',"Save translation");
jr_define('_JOMRES_MISCROSOFT_TRANSLATOR_ERRORSAME',"Error, your source and destination languages are the same.");


