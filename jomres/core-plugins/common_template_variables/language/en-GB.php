<?php
// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( 'Direct Access to '.__FILE__.' is not allowed.' );
// ################################################################

global $jomresConfig_live_site,$jrConfig;

define('_COMMON_STRINGS_TITLE',"Common template variables");

define('_COMMON_STRINGS_INFO',"Developer tool. Designed to show developers common strings that are available to all templates without needing to add them to the template's calling script.<br/> For example, in this list is the definition COMMON_NEXT. A developer can add this to a Jomres template without having to define it in the calling script. You would add the common string to the template just like any other string, by putting  	&#123;COMMON_NEXT&#125; in the template.<br/> In the list below you will see the constant as defined in the language file, and next to it the output that it will show (subject to there being any property specific language customisations). Note, in the case of the 'COMMON_LAST_VIEWED_PROPERTY_UID' constant, the property uid varies and is not shown in this list.");
define('_COMMON_STRINGS_CONSTANT',"Constant");
define('_COMMON_STRINGS_VALUE',"Output");

