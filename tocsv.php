<?php

file_put_contents('trv-gtfs.csv',"name;lat;lon;id;gtfsid;gtfsname;gtfslat;gtfslon\n");
$data = json_decode(file_get_contents('coord-gtfs.json'));
foreach($data as $row){

file_put_contents('trv-gtfs.csv',
$row->Namn.";".
$row->position->wgs84->lat.";".
$row->position->wgs84->long.";".
$row->Signatur.";".
$row->gtfs->id.";".
$row->gtfs->name.";".
$row->gtfs->lat.";".
$row->gtfs->long."\n",FILE_APPEND);
}
?>