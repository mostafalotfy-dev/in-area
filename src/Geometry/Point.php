<?php
namespace Location\Geometry;
use Location\LatLng;
use Stringable;

/**
 * Class Point
 * @package App\Geometry
 */
class Point  implements Stringable
{
    /**
     * @var false|float
     */
    private $x;
    /**
     * @var false|float
     */
    private $y;

    
    public function __construct($x, $y, $round = false)
    {
        $this->x = $round ? round($x) : $x;
        $this->y = $round ? round($y) : $y;
    }

    public function getX(): float
    {
        return $this->x;
    }

    public function getY(): float
    {
        return $this->y;
    }

    /**
     * return new Object of Point
     * @return Point
     */
    public function copy(): Point
    {
        return new Point($this->x, $this->y);
    }

    /**
     * check the distance to new Point
     * @param Point $point
     * @return float
     */
    public function distanceTo(Point $point): float
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
    public function equals(Point $point): bool
    {
        return $point->getX() === $this->x && $point->getY() === $this->y;
    }

    /**
     * is point exists inside this point bounds
     * @param Point $point
     * @return bool
     */
    public function contains(Point $point): bool
    {
        return abs($point->getX()) <= abs($this->x) && abs($point->getY()) <= abs($this->y);
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function subtract(Point $point): Point
    {
        return new Point($this->x - $point->getX(), $this->y - $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function dividedBy(Point $point): Point
    {
        return new Point($this->x / $point->getX(), $this->y / $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function multiplyBy(Point $point): Point
    {
        return new Point($this->x * $point->getX(), $this->y * $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function scaleBy(Point $point): Point
    {
        return new Point($this->x * $point->getX(), $this->y * $point->getY());
    }

    /**
     * @param Point $point
     * @return Point
     */
    public function unscaleBy(Point $point): Point
    {
        return new Point($this->x / $point->getX(), $this->y / $point->getY());
    }

    /**
     * @return Point
     */
    public function round(): Point
    {
        return new Point(round($this->x), round($this->y));
    }

    /**
     * @return $this
     */
    public function floor(): Point
    {
        return new Point(floor($this->x), floor($this->y));
    }

    /**
     * @return Point
     */
    public function ceil(): Point
    {
        return new Point(ceil($this->x), ceil($this->y));

    }

    /**
     * convert point to lat long object
     * @return LatLng
     */
    public function toLatLong(): LatLng
    {
        return new LatLng($this->x, $this->y);
    }
    public function negate(): Point
    {
        return new Point(-$this->x, -$this->y);
    }
    public function add(Point $point): Point
    {
        return new Point($this->x + $point->getX(), $this->y + $point->getY());
    }

    /**
     * Determines if the sum of the point's coordinates is even.
     * Useful for checkerboard or grid-based logic.
     */
    public function isEven(): bool
    {
        return (((int)$this->x + (int)$this->y) % 2) === 0;
    }
    public function isOdd():bool
    {
        return !$this->isEven();
    }
    public function __toString(): string
    {
        return "$this->x,$this->y";
    }
}