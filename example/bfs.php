<?php
require __DIR__."/../vendor/autoload.php";

use Location\Geometry\Point;
use Location\Pathfinding\Graph;
$start = new Point(30.8125921,30.9998323);
$A = new Point(30.8125921, 30.9998323); // Start
$B = new Point(30.7901745, 31.0006183);
$C = new Point(30.8158075, 30.9844708);
$D = new Point(30.7933769, 30.9960697);

$bounds = new Graph();
$bounds->addEdge($A, $B);
$bounds->addEdge($A, $C);
$bounds->addEdge($A, $D);
$bounds->addEdge($B, $C);
$bounds->addEdge($B, $D);
print_r($bounds->bfs($start));



