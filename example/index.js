


var mymap = L.map('mapid').setView([30.7930351, 30.964337], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        maxZoom: 18,
        id: 'mapbox/streets-v11',
        tileSize: 512,
        zoomOffset: -1,
        accessToken: '{put your token here}'
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
                    document.getElementById("content").innerText = `is inside : ${data.is_inside}, distance: ${data.distance}`
                }
            })

        }
        if (latLang.length > 4 && flag === 0) {
            polygon = L.polygon(latLang.map(function (x) {
                console.log(x)
                return {lat: x[0], lng: x[1]}

            })).addTo(mymap)

            flag = 1
        
        }

        
    })
