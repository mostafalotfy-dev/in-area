<?php
use Location\Geometry\Bounds;
use Location\Geometry\Point;

require(__DIR__."/../vendor/autoload.php");

if (isset($_POST["lat"]) && isset($_POST["long"]) && isset($_POST["points"])){

    $bounds = Bounds::fromArray($_POST["points"]);

    $point = new Point($_POST["lat"], $_POST["long"]);
    $is_inside = $bounds->intersect(new Bounds([$point]));
    
    echo json_encode([
        "distance" => $bounds->getCenter()->toLatLong()->distanceTo($point->toLatLong()),
        "is_inside" => $is_inside
    ]);
    exit;

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./leaflet.css">
    <style>
        #mapid {
            height: 300px;
        }

    </style>
</head>

<body>
<div id="mapid"></div>
<div id="content">

</div>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
         <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>
<script src="index.js" ></script>

</body>
</html>
