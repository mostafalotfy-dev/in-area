<?php

namespace Location\PathFinding;
use Illuminate\Support\Collection;
use Location\Geometry\Point;
use Location\Traits\Encapsulate;
/**
 * Class Graph
 * @package Location\PathFinding
 */
class BreadthFirst
{
    use Encapsulate;
    /**
     * @var Collection
     */
    private Collection $adjacencyList;

    /**
     * @return void
     */
    public function __construct()
    {
        $this->adjacencyList = collect();
    }
    /**
     * @param string $key
     * @param Point $value
     * @return array
     */
    private function addEdge(string $key, Point $value): array
    {
        $this->adjacencyList[$key] = collect();
        $this->adjacencyList[$key][] = $value;
        return $this->adjacencyList->toArray();

    }


    /**
     * @param Point $start
     * @return array
     */
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



}
