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
    private function addEdge(string $key, Point $value): void
    {
        $this->adjacencyList[$key][] = $value;
    }


    private function bfs(Point $start)
    {
        $visited = [];
        $queue = new \SplQueue();
        $queue->enqueue($start);
        $visited[$start->__toString()] = true;
        $order = collect();
        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            if (!\is_string($node)) {
                $currentNode = $this->adjacencyList[$node->__toString()] ?? [];
            }

            if (\is_string($node)) {
                $currentNode = $this->adjacencyList[$node] ?? [];
            }


            foreach ($currentNode as $neighbor) {
                $neighbor = $neighbor->__toString();
                if (!isset($visited[$neighbor])) {
                    $visited[$neighbor] = true;
                    $order->push($neighbor);
                    $queue->enqueue($neighbor);
                }
            }
        }

        return $order->toArray();
    }
    private function dfs($start)
    {
        
    }

}
