<?php


namespace App\Location\Geometry;

use Traversable;

class Bounds implements Traversable
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
    public $min;
    /**
     * max point in the bounds
     * @var Point
     */
    public $max;

    public function __construct(array $a, $b = null)
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
                $this->min->x = min($point->x, $this->min->x);
                $this->max->x = max($point->x, $this->max->x);
                $this->min->y = min($point->y, $this->min->y);
                $this->max->y = max($point->y, $this->max->y);
            }
        }

    }
  
    /**
     * add new Point
     * @param Point $point
     * @return $this
     */
    public function add(Point $point)
    {
        $this->min = $point->copy();
        $this->max = $point->copy();
        return $this;
    }

    /**
     * get the center point of the area
     * @param bool $round
     * @return Point
     */
    public function getCenter($round = false)
    {
        return new Point(($this->min->x + $this->max->x) / 2, ($this->min->y + $this->max->y) / 2, $round);
    }

    /**
     * @return Point
     */
    public function getBottomLeft()
    {
        return new Point($this->min->x, $this->max->y);
    }
    /**
     * @return Point
     */
    public function getTopRight()
    {
        return new Point($this->min->x, $this->max->y);
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
        return  $this->max->subtract($this->min);
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
        } else {
            $min = $point->min;
            $max = $point->max;
        }
        return ($min->x >= $this->min->x) &&
            ($max->x <= $this->max->x) &&
            ($max->y >= $this->max->y) &&
            ($min->y <= $this->max->y);
    }

    /**
     * return true if the two bounds intersect
     * @param Bounds $bounds
     * @return bool
     */
    public function intersect(Bounds $bounds)
    {
        $min = $this->min;
        $max = $this->max;
        $min2 = $bounds->min;
        $max2 = $bounds->max;
        $xIntersect = ($max2->x >= $min->x) 
        && ($min2->x <= $max->x);
        $yIntersect = ($max2->y >= $min->y) && ($min2->y <= $max->y);
        return $xIntersect && $yIntersect;
    }
    /**
     * Check if valid point
     * @return bool
     */
    public function isValid()
    {
        return !!($this->min && $this->max);
    }

    /**
     * @return Bounds 
     * @throws InvalidArgumentException 
     */
    public static function fromArray(array $points)
    {
        if(count($points) === 0)
        {
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
    public function current()
    {
        return $this->points[$this->index];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        ++$this->index;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->index;
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->points[$this->index]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->index = 0;
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return isset($this->points[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function offsetGet($offset)
    {
        return $this->points[$offset];
    }

    /**
     * @inheritDoc
     */
    public function offsetSet($offset, $value)
    {
        $this->points[$offset] = $value;
    }

    /**
     * @inheritDoc
     */
    public function offsetUnset($offset)
    {
        unset($this->points[$offset]);
    }

    /**
     * @inheritDoc
     */
    public function count()
    {
        return count($this->points);
    }   
}