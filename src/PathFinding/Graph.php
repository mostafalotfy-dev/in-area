<?php

namespace Location\PathFinding;
use Illuminate\Support\Collection;
use Location\Geometry\Point;
use Location\Traits\Encapsulate;
class Graph
{
    use Encapsulate;
    private Collection $adjacencyList;
    public function __construct()
    {
        $this->adjacencyList = collect();
    }
    private function addEdge(string $key, Point $value): array
    {
        $this->adjacencyList[$key] = collect();
        $this->adjacencyList[$key][] = $value;
        return $this->adjacencyList->toArray();

    }


    private function bfs(Point $start)
    {
        $visited = [];
        $queue = new \SplQueue();
        $queue->enqueue($start);
        $visited[$start->__toString()] = true;
        $order = collect();
        $i = 0;
        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            $order->push($node);
            $currentNode = $this->addEdge((string) $i, $node);

            foreach ($currentNode as $neighbor) {
                $neighbor = $neighbor[0];
                if (!isset($visited[$neighbor->__toString()])) {
                    $visited[$neighbor->__toString()] = true;
                    $order->push($neighbor);
                    $queue->enqueue($neighbor);
                }
            }
            $i++;
        }

        return $order->toArray();
    }
    private function dijkstra($start)
    {
        $min = (float) INF;
        $min_index = 0;
        


    }

}
