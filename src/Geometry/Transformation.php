<?php



namespace Location\Geometry;
use Location\Geometry\Point;
class Transformation { 
    private $vectorA;
    private $vectorB;
    private $vectorC;
    private $vectorD;
    public function __construct( $a,$b,$c,$d)
    {
        if(is_array($a))
        {
            $this->vectorA = $a[0];
            $this->vectorB = $a[1];
            $this->vectorC = $a[2];
            $this->vectorD = $a[3];
        }else{
            $this->vectorA = $a;
            $this->vectorB = $b;
            $this->vectorC = $c;
            $this->vectorD = $d; 
        }
        
    }
    public function transform(Point $point,$scale = 1)
    {
        $newX = ($scale * ($this->vectorA * $point->getX() + $this->vectorB));
        $newY = ($scale * ($this->vectorC * $point->getY() + $this->vectorD));
        return new Point($newX, $newY);
    }
    public function untransform(Point $point ,$scale = 1)
    {
        return new Point(($point->getX() / $scale - $this->vectorB)/$this->vectorA,
        ($point->getY() / $scale- $this->vectorD) /$this->vectorC );
    }
}