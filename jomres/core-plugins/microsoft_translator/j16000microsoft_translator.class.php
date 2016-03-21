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

class j16000microsoft_translator
	{
	function __construct()
		{
		$MiniComponents =jomres_singleton_abstract::getInstance('mcHandler');
		if ($MiniComponents->template_touch)
			{
			$this->template_touchable=false; return;
			}
		$ePointFilepath=get_showtime('ePointFilepath');
		$pageoutput=array();
		$output=array();
		
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_SOURCELANG'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SOURCELANG",_JOMRES_MISCROSOFT_TRANSLATOR_SOURCELANG,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_DESTLANG'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_DESTLANG",_JOMRES_MISCROSOFT_TRANSLATOR_DESTLANG,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_GETTRANSLATION'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_GETTRANSLATION",_JOMRES_MISCROSOFT_TRANSLATOR_GETTRANSLATION,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_ERRORSAME'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_ERRORSAME",_JOMRES_MISCROSOFT_TRANSLATOR_ERRORSAME,false);
		$output['_JOMRES_MISCROSOFT_TRANSLATOR_INSTRUCTIONS'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_INSTRUCTIONS",_JOMRES_MISCROSOFT_TRANSLATOR_INSTRUCTIONS,false);
		
		
		//jr_define('',"New language");

		//if (!translation_user_check()) return;
		//echo '<h2>'.jr_gettext("_JOMRES_TOUCHTEMPLATES",_JOMRES_TOUCHTEMPLATES,false).'</h2>';
		//echo "<br/><h3>".get_showtime('lang')."</h3><br/>";



		$langs=array();
		$langs['bg']='bg-BG';
		$langs['en']='en-GB';
		$langs['cs']='cs-CZ';
		$langs['da']='da-DK';
		$langs['de']='de-DE';
		$langs['el']='el-GR';
		$langs['es']='es-ES';
		$langs['fr']='fr-FR';
		$langs['he']='he-IL';
		// $langs['hr']='hr-HR'; // Can't be translated, according to http://msdn.microsoft.com/en-us/library/hh456380.aspx
		$langs['hu']='hu-HU';
		$langs['it']='it-IT';
		$langs['lv']='lv-LV';
		$langs['nl']='nl-NL';
		$langs['pl']='pl-PL';
		//$langs['br']='pt-BR'; // Can't be translated, according to http://msdn.microsoft.com/en-us/library/hh456380.aspx
		$langs['pt']='pt-PT';
		$langs['ro']='ro-RO';
		$langs['ru']='ru-RU';
		$langs['sk']='sk-SK';
		$langs['sl']='sl-SI';
		//$langs['sr']='sr-YU'; // Can't be translated, according to http://msdn.microsoft.com/en-us/library/hh456380.aspx
		$langs['zh-CHT']='zh-CN';
		$langs['no']='nb-NO';
		$langs['th']='th-TH';
		
		$jomreslang =jomres_singleton_abstract::getInstance('jomres_language');
		$language_names = $jomreslang->define_langfile_to_languages_array();
		ksort($langs);
		$lrows=array();
		foreach ($langs as $key=>$val)
			{
			$lr=array();
			$lr['SHORTCODE']=$key;
			$lr['LANGNAME']=$language_names[$val];
			$lrows[]=$lr;
			}
		$lrows2=$lrows;
		
		$current_lang = get_showtime("lang");
		
		
		foreach ($langs as $key=>$val)
			{
			$lx=array();
			$lx['SHORTCODE']=$key;
			$lx['LONGCODE']=$val;
			$language_xref[]=$lx;
			}
		
		$siteConfig = jomres_singleton_abstract::getInstance('jomres_config_site_singleton');
		$jrConfig=$siteConfig->get();
		
		if ($jrConfig['language_context'] != '')
			$language_context = $jrConfig['language_context'];
		else
			$language_context = 0;
		
		$jomres_language_definitions =jomres_singleton_abstract::getInstance('jomres_language_definitions');
		
		$rows=array();
		
		foreach($jomres_language_definitions->definitions[$language_context] as $const=>$def)
			{
			$r = array();
			$r["ORIGINAL_TEXT"]		=filter_var(jr_gettext( $const,$def,false ),FILTER_SANITIZE_SPECIAL_CHARS);
			$r["CONSTANT"]		=$const;
			$r['_JOMRES_MISCROSOFT_TRANSLATOR_SAVETRANSLATION'] = jr_gettext("_JOMRES_MISCROSOFT_TRANSLATOR_SAVETRANSLATION",_JOMRES_MISCROSOFT_TRANSLATOR_SAVETRANSLATION,false);
			$rows[]=$r;
			}
		
		$pageoutput[]=$output;
		$tmpl = new patTemplate();
		
		$tmpl->setRoot( $ePointFilepath.'templates'.JRDS.find_plugin_template_directory() );
		$tmpl->readTemplatesFromInput( 'languages.html');
		$tmpl->addRows( 'pageoutput',$pageoutput);
		$tmpl->addRows( 'rows',$rows);
		$tmpl->addRows( 'lrows',$lrows);
		$tmpl->addRows( 'lrows2',$lrows2);
		$tmpl->addRows( 'language_xref',$language_xref);
		$tmpl->displayParsedTemplate();
		}



	// This must be included in every Event/Mini-component
	function getRetVals()
		{
		return null;
		}
	}