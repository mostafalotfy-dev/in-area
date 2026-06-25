<?php
namespace Location;
use Location\Geo\Crs\Earth;

/**
 * Class LatLng
 * @package Location
 */
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

    /**
     * @var float|null
     */
    public $alt;

    /**
     * @param float $lat
     * @param float $lng
     * @param float|null $alt
     */
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
    public function equals(LatLng $latLng, ?int $maxMargin = null): bool
    {
        if ($maxMargin == null) {
            $maxMargin = 0;
        }
        return abs($this->lat - $latLng->lat) <= $maxMargin && abs($this->lng - $latLng->lng) <= $maxMargin;
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