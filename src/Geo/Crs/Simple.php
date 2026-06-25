<?php


namespace Location\Geo\Crs;

use Location\LatLng;

/**
 * Class Simple
 * @package Location\Geo\Crs
 */
class Simple extends CRS
{
    /**
     * @var LatLng
     */
    private LatLng $projection;
    /**
     * @param LatLng $projection
     */
    public function __construct($projection)
    {
        $this->projection = $projection;
    }
}