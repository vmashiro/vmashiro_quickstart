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

class j16000ajax_microsoft_translator
	{
	function __construct()
		{
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$original_string = jomresGetParam($_REQUEST,"original_string",'');
		$original_language = jomresGetParam($_REQUEST,"original_lang",'');
		$destination_language = jomresGetParam($_REQUEST,"destination_language",'');
		
		jr_import('microsoft_translator_settings');
		$microsoft_translator_settings = new microsoft_translator_settings();
		$microsoft_translator_settings->get_settings();

		try {
			//Client ID of the application.
			$clientID       = $microsoft_translator_settings->settings['client_id'];
			//Client Secret key of the application.
			$clientSecret = $microsoft_translator_settings->settings['account_key'];
			//OAuth Url.
			$authUrl      = "https://datamarket.accesscontrol.windows.net/v2/OAuth2-13/";
			//Application Scope Url
			$scopeUrl     = "http://api.microsofttranslator.com";
			//Application grant type
			$grantType    = "client_credentials";

			//Create the AccessTokenAuthentication object.
			$authObj      = new AccessTokenAuthentication();
			//Get the Access token.
			$accessToken  = $authObj->getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl);
			//Create the authorization Header string.
			$authHeader = "Authorization: Bearer ". $accessToken;


			//Set the Params.

			$user            = 'TestUser';
			$category       = "general";
			$uri             = null;
			$contentType    = "text/plain";
			$maxTranslation = 5;

			//Create the string for passing the values through GET method.
			$params = "from=$original_language".
						"&to=$destination_language".
						"&maxTranslations=1".
						"&text=".urlencode($original_string).
						"&user=$user".
						"&uri=$uri".
						"&contentType=$contentType";

			//HTTP getTranslationsMethod URL.
			$getTranslationUrl = "http://api.microsofttranslator.com/V2/Http.svc/GetTranslations?$params";

			//Create the Translator Object.
			$translatorObj = new HTTPTranslator();

			//Call the curlRequest.
			$curlResponse = $translatorObj->curlRequest($getTranslationUrl, $authHeader);
			//Interprets a string of XML into an object.
			$xmlObj = simplexml_load_string($curlResponse);
			$translationObj = $xmlObj->Translations;
			$translationMatchArr = $translationObj->TranslationMatch;
			// echo "Get Translation For <b>$inputStr</b>";
			// echo "<table border ='2px'>";
			// echo "<tr><td><b>Count</b></td><td><b>MatchDegree</b></td>
				// <td><b>Rating</b></td><td><b>TranslatedText</b></td></tr>";
			// foreach($translationMatchArr as $translationMatch) {
				// echo "<tr><td>$translationMatch->Count</td><td>$translationMatch->MatchDegree</td><td>$translationMatch->Rating</td>
					// <td>$translationMatch->TranslatedText</td></tr>";
			// }
			// echo "</table></br>";
			$obj = json_decode(json_encode($xmlObj));
			echo $obj->Translations->TranslationMatch->TranslatedText;
		} catch (Exception $e) {
			echo "Exception: " . $e->getMessage() . PHP_EOL;
		}

		}



	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}
	
class AccessTokenAuthentication {
    /*
     * Get the access token.
     *
     * @param string $grantType    Grant type.
     * @param string $scopeUrl     Application Scope URL.
     * @param string $clientID     Application client ID.
     * @param string $clientSecret Application client ID.
     * @param string $authUrl      Oauth Url.
     *
     * @return string.
     */
    function getTokens($grantType, $scopeUrl, $clientID, $clientSecret, $authUrl){
        try {
            //Initialize the Curl Session.
            $ch = curl_init();
            //Create the request Array.
            $paramArr = array (
                 'grant_type'    => $grantType,
                 'scope'         => $scopeUrl,
                 'client_id'     => $clientID,
                 'client_secret' => $clientSecret
            );
            //Create an Http Query.//
            $paramArr = http_build_query($paramArr);
            //Set the Curl URL.
            curl_setopt($ch, CURLOPT_URL, $authUrl);
            //Set HTTP POST Request.
            curl_setopt($ch, CURLOPT_POST, TRUE);
            //Set data to POST in HTTP "POST" Operation.
            curl_setopt($ch, CURLOPT_POSTFIELDS, $paramArr);
            //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
            curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            //Execute the  cURL session.
            $strResponse = curl_exec($ch);
            //Get the Error Code returned by Curl.
            $curlErrno = curl_errno($ch);
            if($curlErrno){
                $curlError = curl_error($ch);
                throw new Exception($curlError);
            }
            //Close the Curl Session.
            curl_close($ch);
            //Decode the returned JSON string.
            $objResponse = json_decode($strResponse);
            if ($objResponse->error){
                throw new Exception($objResponse->error_description);
            }
            return $objResponse->access_token;
        } catch (Exception $e) {
            echo "Exception-".$e->getMessage();
        }
    }
}

/*
 * Class:HTTPTranslator
 *
 * Processing the translator request.
 */
Class HTTPTranslator {
    /*
     * Create and execute the HTTP CURL request.
     *
     * @param string $url        HTTP Url.
     * @param string $authHeader Authorization Header string.
     *
     * @return string.
     *
     */
    function curlRequest($url, $authHeader) {
        //Initialize the Curl Session.
        $ch = curl_init();
        //Set the Curl url.
        curl_setopt ($ch, CURLOPT_URL, $url);
        //Set the HTTP HEADER Fields.
        curl_setopt ($ch, CURLOPT_HTTPHEADER, array($authHeader,"Content-Type: text/xml", 'Content-Length: 0'));
        //CURLOPT_RETURNTRANSFER- TRUE to return the transfer as a string of the return value of curl_exec().
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, TRUE);
        //CURLOPT_SSL_VERIFYPEER- Set FALSE to stop cURL from verifying the peer's certificate.
        curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, False);
        //Set HTTP POST Request.
        curl_setopt($ch, CURLOPT_POST, TRUE);
        //Execute the  cURL session.
        $curlResponse = curl_exec($ch);
        //Get the Error Code returned by Curl.
        $curlErrno = curl_errno($ch);
        if ($curlErrno) {
            $curlError = curl_error($ch);
            throw new Exception($curlError);
        }
        //Close a cURL session.
        curl_close($ch);
        return $curlResponse;
    }
}

