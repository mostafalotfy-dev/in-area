<?php


namespace Leaflet\Location\Geo\Crs;

use App\Location\LatLng;

class Simple extends CRS
{
    private LatLng $projection;
    public function __construct($projection)
    {
        $this->projection = $projection;
    }
}