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

global $jomresConfig_live_site,$jrConfig;

define('_JINTOUR_TITLE',"Tour/Activity management");

define('_JINTOUR_PROFILES_TITLE',"Tour/Activity profiles");
define('_JINTOUR_PROFILES_NEW',"New tour/activity profile");
define('_JINTOUR_PROFILES_DELETE',"Delete tour/activity profile");

define('_JINTOUR_PROFILE_TITLE',"Profile title");
define('_JINTOUR_PROFILE_DESCRIPTION',"Description");
define('_JINTOUR_PROFILE_DESCRIPTION_INFO',"Enter a description of your tour/activity, including it's itinerary.");
define('_JINTOUR_PROFILE_DAYS_OF_WEEK',"Days of week");
define('_JINTOUR_PROFILE_DAYS_OF_WEEK_INFO',"");
define('_JINTOUR_PROFILE_PRICE_ADULTS',"Adult price");
define('_JINTOUR_PROFILE_PRICE_KIDS',"Child price");
define('_JINTOUR_PROFILE_PRICE_KIDS_INFO',"To exclude an option from appearing in the booking form, leave the price as 0 (zero)");
define('_JINTOUR_PROFILE_SPACES_ADULTS',"Adult spaces");
define('_JINTOUR_PROFILE_SPACES_KIDS',"Child spaces");
define('_JINTOUR_PROFILE_SPACES_INFO',"The number of spaces available on the tour/activity");
define('_JINTOUR_PROFILE_START_DATE',"Season start");
define('_JINTOUR_PROFILE_END_DATE',"Season ends");

define('_JINTOUR_PROFILE_GENERATE_INFO',"Once you have created a tour/activity profile you will then need to generate tours/actvities based on that profile's settings. Create the tour/activity, then click the Green arrow icon next to that profile to create the tours/actvities themselves. Once the tours/actvities have been created you will be able to delete individual tours/activities if you wish.");
define('_JINTOUR_PROFILE_GENERATE',"Generate tours/activities");

define('_JINTOUR_TOUR_TITLE',"Activity title");
define('_JINTOUR_TOUR_DATE',"Date");
define('_JINTOUR_TOUR_ADULTS',"Adults");
define('_JINTOUR_TOUR_KIDS',"Children");
define('_JINTOUR_TOUR_ITINERY',"Itinerary");

define('_JINTOUR_TOUR_SAVE_AUDIT',"Generated new tours");
define('_JINTOUR_TOUR_CANCEL_AUDIT',"Tour booking cancelled");
define('_JINTOUR_TOUR_SAVE_MESSAGE',"New tours generated");
define('_JINTOUR_TOUR_SPACES_CURRENTLY_AVAILABLE',"Spaces currently available");

define('_JINTOUR_TOUR_EMAIL_ADMIN_SUBJECT',"New Booking for tour/resource id ");
define('_JINTOUR_TOUR_EMAIL_ADMIN_MESSAGE',"A new booking for an administrator tour/resource has been made. Please view the following link to view that tour's administrator area page ");

define('_JINTOUR_TITLE_CONFIG',"Jomres Integrated Tours Configuration");
define('_JINTOUR_TITLE_WHOLESITE',"Is the entire installation a Jintour installation?");
define('_JINTOUR_TITLE_WHOLESITE_DESC',"If you set this to Yes, then all properties will be tour properties. If you set it to No, then when new properties are created you will be able to have both Tour and Hotel/Apartment type properties.");

define('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS',"Tours");
define('_JINTOUR_REGPROP_MANAGEMENTPROCESS_TOURS_DESC',"Choose the tours option if you are offering bookings for items that are available on certain dates (eg. tours, tickets to a concert.)");
define('_JINTOUR_SHOWDEPARTURE',"Show the departure input field?");
define('_JINTOUR_SHOWDEPARTURE_DESC',"Set this to Yes if you want to show both an arrival and a departure date. This would be useful if you're offering bus trips, airplane tickets etc where you need to know both incoming and outgoing dates, showing the departure date allows you to offer resources over multiple dates, whereas with the setting set to No, only bookings for one date can be accepted.");

define('_JINTOUR_PROFILES_TITLE_LIST',"Tours List");
?>