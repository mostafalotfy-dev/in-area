<?php


namespace Location\Geo\Projection;

use Leaflet\LatLng;
use Leaflet\Geometry\Point;
class SphericalMercator
{
    public const R = 6378137;
    public const MAX_LATITUDE =  85.0511287798;
    public function project(LatLang $latlng)
    {
        $d = pi() /180;
        $max = $this->MAX_LATITUDE;
        $lat = max(min($max ,$latlng.lat),-$max);
        $sin = sin($lat * $d);
        return new Point(
            $this->R  * $latlng->lng * $d,
            $this->R * log((1+ $sin)/ (1 - $sin))/2
        );
    }
    public function unproject()
    {
       $d = 180 / PI;

		return new LatLng(
			(2 * atan(exp($point->y / $this.R)) - (pi() / 2)) *$d,
			$point->x * d / $this.R);
    }
    
    public function bounds()
    {
        $d = $this->R * pi();
        return new Bounds([-$d,$d],[$d,-$d]);

    }
}