<?php

// ################################################################
defined( '_JOMRES_INITCHECK' ) or die( '' );
// ################################################################


function jintour_build_available_tours_list($bkg)
	{
	$list = "";
	$mrConfig=getPropertySpecificSettings();
	$valid_tours = jintour_get_tours_for_arrdep_dates($bkg);
	$jrportal_taxrate = jomres_singleton_abstract::getInstance( 'jrportal_taxrate' );
	$temp_adult_price_for_header=0;
	$temp_kids_price_for_header=0;
	if (count($valid_tours)>0)
		{
		foreach ($valid_tours as $tour)
			{
			
			$currfmt = jomres_getSingleton('jomres_currency_format');
			// need a check here to figure out how many adults and kids have already been selected and adjust the dropdowns accordingly
			if ((int)$tour['spaces_available_adults']>0 || (int)$tour['spaces_available_kids']>0)
				{
				$tour_id = $tour['id'];
				if (isset($bkg->third_party_extras_private_data['jintour']['chosen_options'][$tour_id]))
					{
					$current_choices = $bkg->third_party_extras_private_data['jintour']['chosen_options'][$tour_id];
					$already_chosen_adults = (int)$current_choices['adults'];
					$already_chosen_kids = (int)$current_choices['kids'];
					$already_chosen_total = $already_chosen_adults + $already_chosen_kids;
					}
				else
					{
					$already_chosen_adults = 0;
					$already_chosen_kids = 0;
					$already_chosen_total = 0;
					}

				$tax_rate=$tour['tax_rate'];
				$rate=(float)$jrportal_taxrate->taxrates[$tax_rate]['rate'];
				$tax_output = "";
				if ($tax_rate > 0)
					$tax_output = " (".$rate."%)";
				
				$adult_price_output=$tour['price_adults'];
				$kid_price_output=$tour['price_kids'];
				
				if ( (float) $tour['price_adults'] > 0 )
					$temp_adult_price_for_header = (float) $tour['price_adults'];
				if ( (float) $tour['price_kids'] > 0 )
					$temp_kids_price_for_header = (float) $tour['price_kids'];

				if ($mrConfig['prices_inclusive'] == 0 && $rate>0)
					{
					$divisor	= ($rate/100)+1;
					$adult_price_output=$adult_price_output*$divisor;
					$kid_price_output=$kid_price_output*$divisor;
					}

				$spaces_available_adults = (int)$tour['spaces_available_adults'];
				$spaces_available_kids = (int)$tour['spaces_available_kids'];
				
				if (!function_exists('output_price'))
					{
					$adult_price=$mrConfig['currency'].$currfmt->get_formatted($adult_price_output).$tax_output;
					$kid_price=$mrConfig['currency'].$currfmt->get_formatted($kid_price_output).$tax_output;
					}
				else
					{
					$adult_price=output_price($adult_price_output).$tax_output;
					$kid_price=output_price($kid_price_output).$tax_output;
					}

				//$popup=jomres_makeTooltip('_JOMRES_CUSTOMTEXT_EXTRADESC'.$tour['id'],$tour['title'],$tour['description'],$tour['description'],$class="",$type="infoimage",array("width"=>20,"height"=>20) );

				$adult_dropdown="";
				if ((float)$tour['price_adults']>0.00)
					$adult_dropdown="&nbsp;&nbsp;".jomresHTML::integerSelectList( 00, $spaces_available_adults, 1, "jintour_adults_".$tour['id'], 'size="1" class="inputbox"  AUTOCOMPLETE="OFF" onchange="getResponse(\'jintour\',this.value+\'^adults^'.$tour['id'].'\');"', $already_chosen_adults, "%02d" ,false );

				$kids_dropdown="";
				if ((float)$tour['price_kids']>0.00)
					$kids_dropdown="&nbsp;&nbsp;".jomresHTML::integerSelectList( 00, $spaces_available_kids, 1, "jintour_kids_".$tour['id'], 'size="1" class="inputbox"  AUTOCOMPLETE="OFF"    onchange="getResponse(\'jintour\',this.value+\'^kids^'.$tour['id'].'\');"', $already_chosen_kids, "%02d" ,false );

				$list.='<tr><td>'.$tour['title'].'</td>';
				if ($adult_dropdown!="")
					$list.='<td>'.$adult_price.' '.$adult_dropdown.' </td>';
				else
					$list.='<td>&nbsp;</td>';
					
				if ($kids_dropdown!="")
					$list.='<td>'.$kid_price.' '.$kids_dropdown.'</td>';
				else
					$list.='<td>&nbsp;</td>';
				
				$list.=
				
				'<td>'.outputDate(str_replace("-","/",$tour['tourdate'])).'</td>'.
				'<td>'.$tour['description'].'</td>'.
				'</tr>'
				;
				
				}
			}
		$adult_str = "&nbsp;";
		$kid_str = "&nbsp;";
		
		if ($temp_adult_price_for_header > 0)
			$adult_str = jr_gettext('_JINTOUR_TOUR_ADULTS',_JINTOUR_TOUR_ADULTS,false);
			
		if ($temp_kids_price_for_header > 0)
			$kid_str = jr_gettext('_JINTOUR_TOUR_KIDS',_JINTOUR_TOUR_KIDS,false);

		$headers='<table width="100%" class="table table-condensed table-striped table-bordered"><tr><th>'.jr_gettext('_JINTOUR_TOUR_TITLE',_JINTOUR_TOUR_TITLE,false).' </th><th>'.$adult_str.'</th><th>'.$kid_str.' </th><th>'.jr_gettext('_JINTOUR_TOUR_DATE',_JINTOUR_TOUR_DATE,false).'</th><th>'.jr_gettext('_JINTOUR_TOUR_ITINERY',_JINTOUR_TOUR_ITINERY,false).'</th></tr>';
		return $headers.$list.'</table>';
		}
	else return false;
	
	}

function jintour_get_tours_for_arrdep_dates($bkg)
	{
	$unixArrivalDate=strtotime($bkg->arrivalDate);
	$unixDepartureDate=strtotime($bkg->departureDate);
	$valid_tours = array();
	$all_tours = jintour_get_all_tours($bkg->property_uid);
	
	foreach ($all_tours as $tour)
		{
		$unixTourDate=strtotime($tour['tourdate']);
		if (!get_showtime('include_room_booking_functionality'))
			{
			if ( ($unixTourDate >= $unixArrivalDate && $unixTourDate < $unixDepartureDate) && $tour['published'] == 1)
				{
				$tour_id=$tour['id'];
				$valid_tours[$tour_id]=$tour;
				}
			}
		else
			{
			if ( ($unixTourDate >= $unixArrivalDate && $unixTourDate <= $unixDepartureDate) && $tour['published'] == 1)
				{
				$tour_id=$tour['id'];
				$valid_tours[$tour_id]=$tour;
				}

			}
		}
	$bkg->third_party_extras_private_data['jintour']['validtours']=$valid_tours;
	return $valid_tours;
	}
	
function jintour_get_all_tours($property_uid)
	{
	$result = array();
	$query = "SELECT * FROM #__jomres_jintour_tours WHERE property_uid =".$property_uid." OR property_uid = 0";
	$tours = doSelectSql($query);
	if (count($tours)>0)
		{
		foreach ($tours as $p)
			{
			$result[$p->id]['id'] = $p->id;
			$result[$p->id]['title'] = $p->title;
			$result[$p->id]['description'] = $p->description;
			$result[$p->id]['price_adults'] = $p->price_adults;
			$result[$p->id]['price_kids'] = $p->price_kids;
			$result[$p->id]['spaces_available_adults'] = $p->spaces_available_adults;
			$result[$p->id]['spaces_available_kids'] = $p->spaces_available_kids;
			$result[$p->id]['tourdate'] = $p->tourdate;
			$result[$p->id]['tax_rate'] = $p->tax_rate;
			$result[$p->id]['published'] = $p->published;
			$result[$p->id]['property_uid'] = $p->property_uid;
			}
		}
	return $result;
	}

function jintour_get_tour($tour_id =0,$property_uid = 0)
	{
	
	if ($tour_id ==0)
		return false;
	
	$result = array();
	$query = "SELECT * FROM #__jomres_jintour_tours WHERE ( property_uid =".$property_uid." OR property_uid = 0) AND id =".$tour_id." LIMIT 1";
	$tours = doSelectSql($query);
	if (count($tours)>0)
		{
		foreach ($tours as $p)
			{
			$result[$p->id]['id'] = $p->id;
			$result[$p->id]['title'] = $p->title;
			$result[$p->id]['description'] = $p->description;
			$result[$p->id]['price_adults'] = $p->price_adults;
			$result[$p->id]['price_kids'] = $p->price_kids;
			$result[$p->id]['spaces_available_adults'] = $p->spaces_available_adults;
			$result[$p->id]['spaces_available_kids'] = $p->spaces_available_kids;
			$result[$p->id]['tourdate'] = $p->tourdate;
			$result[$p->id]['tax_rate'] = $p->tax_rate;
			$result[$p->id]['published'] = $p->published;
			}
		}
	return $result;
	}
function jintour_get_all_tour_profiles($property_uid)
	{
	$result = array();
	$query = "SELECT * FROM #__jomres_jintour_profiles WHERE property_uid =".$property_uid;
	$profiles = doSelectSql($query);
	if (count($profiles)>0)
		{
		foreach ($profiles as $p)
			{
			$result[$p->id]['id'] = $p->id;
			$result[$p->id]['title'] = $p->title;
			$result[$p->id]['description'] = $p->description;
			$result[$p->id]['days_of_week'] = $p->days_of_week;
			$result[$p->id]['price_adults'] = $p->price_adults;
			$result[$p->id]['price_kids'] = $p->price_kids;
			$result[$p->id]['spaces_adults'] = $p->spaces_adults;
			$result[$p->id]['spaces_kids'] = $p->spaces_kids;
			$result[$p->id]['start_date'] = $p->start_date;
			$result[$p->id]['end_date'] = $p->end_date;
			$result[$p->id]['repeating'] = $p->repeating;
			$result[$p->id]['property_uid'] = $p->property_uid;
			$result[$p->id]['tax_rate'] = $p->tax_rate;
			}
		}
	return $result;
	}

function jintour_get_tour_profile($profile_id =0,$property_uid = 0)
	{
	
	if ($profile_id ==0)
		return false;
	
	$result = array();
	$query = "SELECT * FROM #__jomres_jintour_profiles WHERE property_uid =".$property_uid." AND id =".$profile_id." LIMIT 1";
	$profiles = doSelectSql($query);
	if (count($profiles)>0)
		{
		foreach ($profiles as $p)
			{
			$result[$p->id]['id'] = $p->id;
			$result[$p->id]['title'] = $p->title;
			$result[$p->id]['description'] = $p->description;
			$result[$p->id]['days_of_week'] = $p->days_of_week;
			$result[$p->id]['price_adults'] = $p->price_adults;
			$result[$p->id]['price_kids'] = $p->price_kids;
			$result[$p->id]['spaces_adults'] = $p->spaces_adults;
			$result[$p->id]['spaces_kids'] = $p->spaces_kids;
			$result[$p->id]['start_date'] = $p->start_date;
			$result[$p->id]['end_date'] = $p->end_date;
			$result[$p->id]['repeating'] = $p->repeating;
			$result[$p->id]['property_uid'] = $p->property_uid;
			$result[$p->id]['tax_rate'] = $p->tax_rate;
			}
		}
	return $result;
	}
	

?>