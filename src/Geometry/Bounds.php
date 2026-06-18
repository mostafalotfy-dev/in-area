<?php


namespace Location\Geometry;

use InvalidArgumentException;
use Iterator;
use Traversable;

class Bounds implements Iterator, \ArrayAccess, \Countable
{
    /**
     * @var Point[]
     */
    private $points = [];
    private $index = 0;
    /**
     * min point in the bound
     * @var Point
     */
    private $min;
    /**
     * max point in the bounds
     * @var Point
     */
    private $max;

    public function __construct(array $a, ?array $b = null)
    {

        $points = $b ? [$a, $b] : $a;

        foreach ($points as $point) {

            $this->points[] = $point;

        }

        /*
         * loop over points and find min and max points in area
         */
        foreach ($this->points as $point) {

            if (!$this->min && !$this->max) {
                $this->min = $point->copy();
                $this->max = $point->copy();
            } else {
                $this->min = new Point(min($point->getX(), $this->min->getX()), min($point->getY(), $this->min->getY()));
                $this->max = new Point(max($point->getX(), $this->max->getX()), max($point->getY(), $this->max->getY()));
            }
        }

    }
    public function __call(string $name, array $args)
    {
        if (property_exists($this, $name)) {
            return $this->$name(...$args);
        }

    }
    /**
     * add new Point
     * @param Point $point
     * @return $this
     */
    private function add(Point $point)
    {
        // Expand the bounds to include the new point
        $this->min = new Point(min($point->getX(), $this->min->getX()), min($point->getY(), $this->min->getY()));
        $this->max = new Point(max($point->getX(), $this->max->getX()), max($point->getY(), $this->max->getY()));

        return $this;
    }

    private function getMin(): Point
    {
        return $this->min;
    }

    private function getMax(): Point
    {
        return $this->max;
    }

    /**
     * get the center point of the area
     * @param bool $round
     * @return Point
     */
    private function getCenter(bool $round = false)
    {
        return new Point(($this->min->getX() + $this->max->getX()) / 2, ($this->min->getY() + $this->max->getY()) / 2, $round);
    }

    /**
     * @return Point
     */
    public function getBottomLeft()
    {
        return new Point($this->min->getX(), $this->max->getY());
    }
    /**
     * @return Point
     */
    public function getTopRight()
    {
        return new Point($this->max->getX(), $this->min->getY());
    }
    /**
     * @return Point
     */
    public function getTopLeft()
    {
        return $this->min;
    }
    /**
     * @return Point
     */
    public function getBottomRight()
    {
        return $this->max;
    }
    /**
     * 
     * @return Point
     */
    public function getSize()
    {
        return $this->max->subtract($this->min);
    }
    public function overlaps(Bounds $bounds)
    {
        $min = $this->min;
        $max = $this->max;
        $min2 = $bounds->getMin();
        $max2 = $bounds->getMax();
        $xOverlaps = ($max2->getX() > $min->getX()) && ($min2->getX() < $max->getX());
        $yOverlaps = ($max2->getY() > $min->getY()) && ($min2->getY() < $max->getY());
        return $xOverlaps && $yOverlaps;
    }
    /**
     * Check if point exists inside rectangle or not
     * the point can (Bounds) or (Point)
     * @param Point|Bounds $point
     * @return bool
     */
    public function contains($point)
    {
        $min = null;
        $max = null;
        if ($point instanceof Point) {
            $min = $max = $point;
        } else if ($point instanceof Bounds) {
            $min = $point->getMin();
            $max = $point->getMax();
        }
        return ($min->getX() >= $this->min->getX()) &&
            ($max->getX() <= $this->max->getX()) &&
            ($max->getY() >= $this->max->getY()) &&
            ($min->getY() <= $this->max->getY());
    }

    /**
     * return true if the two bounds intersect
     * @param Bounds $bounds
     * @return bool
     */
    private function intersect(Bounds $bounds)
    {
        $min = $this->min;
        $max = $this->max;
        $min2 = $bounds->getMin();
        $max2 = $bounds->getMax();
        $xIntersect = ($max2->getX() >= $min->getX())
            && ($min2->getX() <= $max->getX());
        $yIntersect = ($max2->getY() >= $min->getY()) && ($min2->getY() <= $max->getY());
        return $xIntersect && $yIntersect;
    }
    /**
     * Check if valid point
     * @return bool
     */
    private function isValid()
    {
        return !!($this->min && $this->max);
    }

    /**
     * @return Bounds 
     * @throws \InvalidArgumentException 
     */
    public static function fromArray(array $points)
    {
        if (\count($points) === 0) {
            throw new \InvalidArgumentException("Array is Empty");
        }
        $_points = [];
        foreach ($points as $point) {
            $_points[] = new Point($point[0], $point[1]);
        }

        return new Bounds($_points);
    }
    /**
     * @inheritDoc
     */
    public function current(): Point
    {
        return $this->points[$this->index];
    }

    public function valid(): bool
    {
        return isset($this->points[$this->index]);
    }
    public function next(): void
    {
        ++$this->index;
    }
    public function rewind(): void
    {
        $this->index = 0;
    }
    /**
     * @inheritDoc
     */
    public function key(): int
    {
        return $this->index;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset): bool
    {
        return isset($this->points[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset): mixed
    {
        return $this->points[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value): void
    {
        $this->points[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset): void
    {
        unset($this->points[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function count(): int
    {
        return \count($this->points);
    }

    public function isEven(): bool
    {
        return (((int) $this->min->getX() + (int) $this->max->getY()) % 2) === 0;
    }
    private function isEmpty()
    {
        return \count($this->points) === 0;
    }
    


}