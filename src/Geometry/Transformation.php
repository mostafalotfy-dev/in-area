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
            $this->vectorB = $b[1];
            $this->vectorC = $c[2];
            $this->vectorD = $d[3];
        }else{
            $this->vectorA = $a;
            $this->vectorB = $b;
            $this->vectorC = $c;
            $this->vectorD = $d; 
        }
        
    }
    public function transform(Point $point,$scale = 1)
    {
        $point->x = ($scale * ($this->vectorA * $point->x + $this->vectorB));
        $point->y = ($scale * ($this->vectorC * $point->y + $this->vectorD));
        return $point;
    }
    public function untransform(Point $point ,$scale = 1)
    {
        return new Point(($point->x / $scale - $this->vectorB)/$this->a,
        ($point->y/ $scale- $this->vectorD) /$this->vectorC );
    }
}