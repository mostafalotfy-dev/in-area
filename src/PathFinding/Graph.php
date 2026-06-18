<?php

namespace Location\PathFinding;
use Location\Geometry\Point;


class Graph {
    private array $adjacencyList = [];
    public function addEdge(string $u, string $v): void {
        $this->adjacencyList[$u][] = $v;
    }

    // BFS traversal
    public function bfs(Point $start) {
        $visited = [];
        $queue = new \SplQueue();
        $queue->enqueue($start);
        $visited[$start->__toString()] = true;

        while (!$queue->isEmpty()) {
            $node = $queue->dequeue();
            if(!\is_string($node))
                $currentNode = $this->adjacencyList[$node->__toString()] ?? [];
            else
                $currentNode = $this->adjacencyList[$node] ?? [];
            
            foreach ($currentNode as $neighbor) {
                if (!isset($visited[$neighbor])) {
                    $visited[$neighbor] = true;
                    $order[] = $neighbor;
                    $queue->enqueue($neighbor);
                }
            }
        }

        return $order;
    }

}
