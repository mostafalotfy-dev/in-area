<?php


namespace App\Location\Geo\Crs;


use App\Location\LatLng;

class Earth extends CRS
{
    // Mean Earth Radius, as recommended for use by
    // the International Union of Geodesy and Geophysics,
    // see http://rosettacode.org/wiki/Haversine_formula
    public $wrapLang = [-180, 180];
    public $R = 6371000;

    public function distance(LatLng $latlng1, LatLng $latLng2)
    {
        $rad = pi() / 180;
        $lat1 = $latlng1->lat * $rad;
        $lat2 = $latLng2->lat * $rad;
        $sinDLat = sin(($latLng2->lat - $latlng1->lat) * $rad / 2);
        $sinDLon = sin(($latLng2->lng - $latlng1->lng) * $rad / 2);
        $a = $sinDLat * $sinDLat + cos($lat1) * cos($lat2) * $sinDLon * $sinDLon;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $this->R * $c;
    }
}