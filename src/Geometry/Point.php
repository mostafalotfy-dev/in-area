<?php


namespace Leaflet\Location\Geometry;


use App\Location\LatLng;

/**
 * Class Point
 * @package App\Geometry
 */
class Point 
{
    /**
     * @var false|float
     */
    public $x;
    /**
     * @var false|float
     */
    public $y;

    
    public function __construct($x, $y, $round = false)
    {
        $this->x = $round ? round($x) : $x;
        $this->y = $round ? round($y) : $y;
    }

    /**
     * return new Object of Point
     * @return Point
     */
    public function copy()
    {
        return new Point($this->x, $this->y);
    }

    /**
     * check the distance to new Point
     * @param Point $point
     * @return float
     */
    public function distanceTo(Point $point)
    {
        $x = $point->x - $this->x;
        $y = $point->y - $this->y;
        return sqrt($x * $x + $y * $y);
    }

    /**
     *
     * @param Point $point
     * @return bool
     */
    public function equals(Point $point)
    {
        return $point->x === $this->x && $point->y === $this->y;
    }

    /**
     * is point exists inside this point bounds
     * @param Point $point
     * @return bool
     */
    public function contains(Point $point)
    {
        return abs($point->x) <= abs($this->x) && abs($point->y) <= abs($this->y);
    }

    /**
     * @param Point $point
     * @return $this
     */
    public function subtract(Point $point)
    {
        $this->x -= $point->x;
        $this->y -= $point->y;
        return $this;
    }

    /**
     * @param Point $point
     * @return $this
     */
    public function dividedBy(Point $point)
    {
        $this->x /= $point->x;
        $this->y /= $point->y;
        return $this;

    }

    /**
     * @param Point $point
     * @return $this
     */
    public function multiplyBy(Point $point)
    {
        $this->x *= $point->x;
        $this->y *= $point->y;
        return $this;
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function scaleBy(Point $point)
    {
        return new Point($this->x * $point->x, $this->y * $point->y);
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function unscaleBy(Point $point)
    {
        return new Point($this->x / $point->x, $this->y / $point->y);
    }

    /**
     * @return $this
     */
    public function round()
    {
        $this->x = round($this->x);
        $this->y = round($this->y);
        return $this;
    }

    /**
     * @return $this
     */
    public function floor()
    {
        $this->x = floor($this->x);
        $this->y = floor($this->y);
        return $this;
    }

    /**
     * @return $this
     */
    public function ceil()
    {
        $this->x = ceil($this->x);
        $this->y = ceil($this->y);
        return $this;

    }

    /**
     * convert point to lat long object
     * @return LatLng
     */
    public function toLatLong()
    {
        return new LatLng($this->x, $this->y);
    }
}