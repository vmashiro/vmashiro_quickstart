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

//This is a month view chart the occupancy - number of rooms booked by day in the selected month
class j06002chart_guests_countries
	{
	function __construct($componentArgs)
		{
		$MiniComponents = jomres_singleton_abstract::getInstance( 'mcHandler' );
		if ( $MiniComponents->template_touch )
			{
			$this->template_touchable = false;
			return;
			}
		
		$property_uid = getDefaultProperty();
		
		if (isset($componentArgs[ 'output_now' ]))
			$output_now = $componentArgs[ 'output_now' ];
		else
			$output_now = true;
		
		$chart_type = jomresGetParam( $_POST, 'jr_chart_type', 'bar' );
		
		//import jomres charts class and create a new instance
		jr_import('jomres_charts');
		$chart = new jomres_charts();
		
		//set new chart data
		$chart->type 		= $chart_type;
		$chart->title 		= jr_gettext("_JOMRES_HLIST_GUESTS",_JOMRES_HLIST_GUESTS,false,false);
		$chart->url 		= jomresUrl(JOMRES_SITEPAGE_URL_NOSEF . '&task=charts&jr_chart=chart_occupancy');
		$chart->title_class = 'panel-default';
		$chart->description = jr_gettext("_JOMRES_COM_MR_VRCT_PROPERTY_HEADER_COUNTRY",_JOMRES_COM_MR_VRCT_PROPERTY_HEADER_COUNTRY,false,false);
		
		//query db for relevant rows for this chart
		$query = "SELECT
					`country`, 
					COUNT(`country`) AS how_many     
				FROM #__jomres_guests   
				WHERE `property_uid` = " . (int)$property_uid . "   
				GROUP BY `country`  
				ORDER BY how_many DESC 
				";
		$result = doSelectSql( $query );

		if (count($result) == 0 )
			return;
		else
			{
			$labels		= array();
			$data 		= array();

			//now we create an array of amounts for each year/month
			foreach ( $result as $r)
				{
				$labels[] = getSimpleCountry($r->country);
				$data[] = $r->how_many;
				}
			
			//chart x axis labels
			$chart->labels = $labels;

			//generate the dataset color
			$a = mt_rand(0, 255);
			$b = mt_rand(0, 255);
			$c = mt_rand(0, 255);
			
			//set dataset details
			$chart->datasets[0] = array(
										 'label' => date("F").' '.date("Y"), 
										 'data' => $data,
										 'fillColor' => "rgba(".$a.",".$b.",".$c.",0.2)",
										 'strokeColor' => "rgba(".$a.",".$b.",".$c.",1)",
										 'pointColor' => "rgba(".$a.",".$b.",".$c.",1)",
										 'pointStrokeColor' => "#fff",
										 'pointHighlightFill' => "#fff",
										 'pointHighlightStroke' => "rgba(".$a.",".$b.",".$c.",1)"
										 );
			}
		
		//display the chart or return it
		if (!$output_now)
			$this->retVals = $chart->get_chart();
		else
			echo $chart->get_chart();
		}

	function getRetVals()
		{
		return $this->retVals;
		}
	}
