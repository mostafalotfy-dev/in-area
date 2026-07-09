<?php


namespace Location\PathFinding;
use Illuminate\Support\Traits\Macroable;
use Location\Geometry\Point;


class Dijkstra
{
    use Macroable;
    private array $node = [];
    private array $edge = [];

    private function addNode(Point $point)
    {
        $name = $point->__toString();
        $this->node[$name] = $name;
        $this->edge[$name] = [];
    }
    private function addEdge(Point $a, Point $b)
    {
        $this->edge[$a->__toString()][$b->__toString()] = $a->distanceTo($b);
        return $this;
    }
    private function findLowestCost()
    {
        $lowestCost = INF;
        $lowest_cost_node = null;
        foreach ($this->edge as  $edge) {
            
            if (  $edge < $lowestCost) {
                $lowestCost = $edge;
                $lowest_cost_node = $edge;
            }
        }
        return $lowest_cost_node;

    }
    private function findShortestPath()
    {
        return [
            'distance'=> $this->findLowestCost()
        ];
        
    }

}
