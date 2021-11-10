<?php


namespace App\Location\Geo\Crs;


use App\Location\LatLng;

abstract class CRS
{
    protected $wrapLng;
    protected $wrapLat;
    // @method wrapLatLng(latlng: LatLng): LatLng
    // Returns a `LatLng` where lat and lng has been wrapped according to the
    // CRS's `wrapLat` and `wrapLng` properties, if they are outside the CRS's bounds.
    public function wrapLatLng(LatLng $latLng)
    {
        $lng = $this->wrapLng ? wrapNum($latLng->lng, $this->wrapLng, true) : $latLng->lng;
        $lat = $this->wrapLat ? wrapNum($latLng->lat, $this->wrapLat, true) : $latLng->lat;
        $alt = $latLng->alt;
        return new LatLng($lng, $lat, $alt);
    }
}