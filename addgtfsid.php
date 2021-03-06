<?php
require_once dirname(__FILE__) . '/gtfs-stop-reader/getstopname.php';

$all = json_decode(file_get_contents('coord-wgs84.json'));

foreach($all as $key => $station)
	{
		if(isset($all[$key]->gtfs) == FALSE OR $all[$key]->gtfs->id == NULL){
			print "\n".$all[$key]->Namn;
			$stop = getClosestStation(floatval($all[$key]->position->wgs84->lat),floatval($all[$key]->position->wgs84->long),1.0,7402000,'J');
			if($stop->stop_name == "not found")
				{
				$stop = getClosestStation(floatval($all[$key]->position->wgs84->lat),floatval($all[$key]->position->wgs84->long),100,9999999,'J');
				}
			$all[$key]->gtfs = new stdClass;
			$all[$key]->gtfs->id = $stop->stop_id;
			$all[$key]->gtfs->name = $stop->stop_name;
			$all[$key]->gtfs->lat = $stop->stop_lat;
			$all[$key]->gtfs->long = $stop->stop_lon;
			$all[$key]->gtfs->offsett = $stop->distance;
			print $station->Namn .';'.$stop->stop_name.';'.$stop->stop_id.';'.$stop->distance;
		}
	}
file_put_contents('coord-gtfs.json',json_encode($all));
?>
