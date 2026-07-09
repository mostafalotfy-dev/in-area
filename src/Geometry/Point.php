<?php
namespace Location\Geometry;

use Location\LatLng;
use Location\Traits\Encapsulate;
use Stringable;

/**
 * Class Point
 * @package Location\Geometry
 */
class Point  implements Stringable
{
    use Encapsulate;
    /**
     * @var false|float
     */
    private $x;
    /**
     * @var false|float
     */
    private $y;

    
    /**
     * @param float $x
     * @param float $y
     * @param bool $round
     */
    public function __construct($x, $y, $round = false)
    {
        $this->x = $round ? round($x) : $x;
        $this->y = $round ? round($y) : $y;
    }
  
    /**
     * @return float
     */
    public function getX(): float
    {
        return $this->x;
    }

    /**
     * @return float
     */
    public function getY(): float
    {
        return $this->y;
    }

    /**
     * return new Object of Point
     * @return Point
     */
    private function copy(): Point
    {
        return new Point($this->x, $this->y);
    }

    /**
     * check the distance to new Point
     * @param Point $point
     * @return float
     */
    private function distanceTo(Point $point): float
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
    private function equals(Point $point): bool
    {
        return $point->getX() === $this->x && $point->getY() === $this->y;
    }

    /**
     * is point exists inside this point bounds
     * @param Point $point
     * @return bool
     */
    private function contains(Point $point): bool
    {
        return abs($point->getX()) <= abs($this->x) && abs($point->getY()) <= abs($this->y);
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function subtract(Point $point): Point
    {
        return new Point($this->x - $point->getX(), $this->y - $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function dividedBy(Point $point): Point
    {
        return new Point($this->x / $point->getX(), $this->y / $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function multiplyBy(Point $point): Point
    {
        return new Point($this->x * $point->getX(), $this->y * $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function scaleBy(Point $point): Point
    {
        return new Point($this->x * $point->getX(), $this->y * $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function unscaleBy(Point $point): Point
    {
        return new Point($this->x / $point->getX(), $this->y / $point->getY());
    }

    /**
     * @return Point
     */
    private function round(): Point
    {
        return new Point(round($this->x), round($this->y));
    }

    /**
     * @return $this
     */
    private function floor(): Point
    {
        return new Point(floor($this->x), floor($this->y));
    }

    /**
     * @return Point
     */
    private function ceil(): Point
    {
        return new Point(ceil($this->x), ceil($this->y));

    }

    /**
     * convert point to lat long object
     * @return LatLng
     */
    private function toLatLong(): LatLng
    {
        return new LatLng($this->x, $this->y);
    }
    /**
     * @return Point
     */
    private function negate(): Point
    {
        return new Point(-$this->x, -$this->y);
    }

    /**
     * @param Point $point
     * @return Point
     */
    private function add(Point $point): Point
    {
        return new Point($this->x + $point->getX(), $this->y + $point->getY());
    }

    /**
     * Determines if the sum of the point's coordinates is even.
     * Useful for checkerboard or grid-based logic.
     */
    private function isEven(): bool
    {
        return (((int)$this->x + (int)$this->y) & 1) === 0;
    }
    /**
     * @return bool
     */
    private function isOdd():bool
    {
        return !$this->isEven();
    }
    /**
     * @return string
     */
    public function __toString(): string
    {
        return "$this->x,$this->y";
    }
}
