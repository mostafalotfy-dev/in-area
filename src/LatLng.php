<?php


namespace App\Location;


use App\Location\Geo\Crs\Earth;

class LatLng
{
    /**
     * @var float
     */
    public $lat;
    /**
     * @var float
     *
     */
    public $lng;

    public $alt;

    public function __construct($lat, $lng, $alt = null)
    {
        $this->lat = $lat;
        $this->lng = $lng;
        if ($alt != null) {
            $this->alt = $alt;
        }
    }

    /**
     * @param LatLng $latLng
     * @param int|null $maxMargin
     * @return bool
     */
    public function equals(LatLng $latLng, int $maxMargin = null)
    {
        $margin = max([abs($this->lat - $latLng->lat), abs($this->lng - $latLng->lng)]);
        return $margin <= ($maxMargin === null ? 1.0E-9 : $maxMargin);
    }

    /**
     * @param LatLng $other
     * @return float|int
     */
    public function distanceTo(LatLng $other)
    {
        $earth = new Earth();
        return $earth->distance($this, $other);
    }
}