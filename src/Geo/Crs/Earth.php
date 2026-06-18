<?php


namespace Location\Geo\Crs;


use Location\LatLng;

class Earth extends CRS
{
    // Mean Earth Radius, as recommended for use by
    // the International Union of Geodesy and Geophysics,
    // see http://rosettacode.org/wiki/Haversine_formula
    public $wrapLng = [-180, 180];
    public $R = 6371;

    public function distance(LatLng $latlng1, LatLng $latLng2)
    {
        // Convert latitudes and longitudes from degrees to radians
        $lat1Rad = deg2rad($latlng1->lat);
        $lon1Rad = deg2rad($latlng1->lng);
        $lat2Rad = deg2rad($latLng2->lat);
        $lon2Rad = deg2rad($latLng2->lng);

        $diffLatitude = $lat2Rad - $lat1Rad;
        $diffLongitude = $lon2Rad - $lon1Rad;

        $a = sin($diffLatitude / 2) ** 2 +
             cos($lat1Rad) *
             cos($lat2Rad) *
             sin($diffLongitude / 2) ** 2;

        $c = 2 * asin(sqrt($a));
        return $this->R * $c;
    }
}