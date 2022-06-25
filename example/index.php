<?php


use Leaflet\Location\Geometry\Bounds;
use Leaflet\Location\Geometry\Point;

require(__DIR__."/../vendor/autoload.php");

if (isset($_POST["lat"])) {

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
    <link rel="stylesheet" href="leaflet.css">
    <style>
        #mapid {
            height: 300px;
        }

    </style>
</head>

<body>
<div id="mapid"></div>
<script
        src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
        crossorigin="anonymous"></script>
<script src="leaflet.js">

</script>
<script>
    var mymap = L.map('mapid').setView([30.7930351, 30.964337], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: 'pk.eyJ1IjoibW9zdGFmYWgxMjMiLCJhIjoiY2tqaW5qNWNhOWtjZTJ5bGJ4eXFnNDVoNiJ9.UVgThRYF74kIJr6ovYZ6iw'
    }).addTo(mymap);
    var latLang = [];
    var polygon;
    var flag = 0;
    var point;
    mymap.on("click", function (e) {

        if (flag === 0) {
            latLang.push([e.latlng.lat, e.latlng.lng])

        } else {

            $.ajax({
                "url": "index.php",
                method:"post",
                data: {
                    lat: e.latlng.lat,
                    long: e.latlng.lng,
                    points: latLang
                },
                success: function (data) {
                    data = JSON.parse(data);
                    // your code goes here
                }
            })

        }
        if (latLang.length > 4 && flag === 0) {
            polygon = L.polygon(latLang.map(function (x) {
                console.log(x)
                return {lat: x[0], lng: x[1]}

            })).addTo(mymap)

            flag = 1
            // console.log(flag)
        }

        // console.log(latLang)
    })


</script>
</body>
</html>
