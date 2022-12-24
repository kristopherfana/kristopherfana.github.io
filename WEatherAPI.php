<?php
$jsonfile = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=Harare,ZW&units=metric&appid=ca8c6ec76045f8382dcf193fd7b48718");

$jsondata = json_decode($jsonfile);
$temp = $jsondata->main->temp;
$pressure = $jsondata->main->pressure;
$mintemp = $jsondata->main->temp_min;
$maxtemp = $jsondata->main->temp_max;
$wind = $jsondata->wind->speed;
$humidity = $jsondata->main->humidity;
$desc = $jsondata->weather[0]->description;
$maind = $jsondata->weather[0]->main;

print_r($temp);
echo $desc; 
?>