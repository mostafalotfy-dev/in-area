<?php 

namespace Location\PathFinding;

use Location\Geometry\Point;


class WieghtPoint  extends Point{
    private $weight;
    public function __construct(int $x, int $y, $round = false)
    {
        parent::__construct($x,$y,$round);
        $this->weight = 0;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight(int $weight)
    {
        $this->weight = $weight;

    }

}