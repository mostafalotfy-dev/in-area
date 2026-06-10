<?php


namespace Location\Geo\Crs;

use Location\LatLng;

class Simple extends CRS
{
    private LatLng $projection;
    public function __construct($projection)
    {
        $this->projection = $projection;
    }
}