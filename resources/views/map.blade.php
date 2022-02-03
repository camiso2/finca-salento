<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>


    <title>Calcular rutas</title>
    <style>
        /*body {
            margin: 0;
            padding: 0;
        }*/

        #mapa {
            position: absolute;
            top: 0;
            bottom: 0;
            width: 100%;
        }

        .leaflet-top {
            display: none;
        }

        .cll {
            position: absolute !important;
            text-align: center;
            z-index: 99999;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
        }
    </style>
</head>

<body>
    <div id="mapa"></div>
    <div class="cll">
        <h2><b>Cómo llegar</b></h2>
        <form id="formulario_rutas" method="get"
            action="https://www.openstreetmap.org/directions?engine=fossgis_osrm_car" target="_blank">
            <input id="coordenadas" type="hidden" name="route" value="" />
            <button id="calcular_ruta" type="button"  class="btn btn-primary" style=" background-color:#51733C;border:0;"><i class="glyphicon glyphicon-leaf" aria-hidden="true"></i>  ECOHOTEL EL ROSARIO <i class="fa fa-map-signs"></i></button>
        </form>
    </div>


    <script>
        "use strict";
        $(document).ready(function(){
            $("#calcular_ruta").click(function(){
                if(navigator.geolocation){
                    navigator.geolocation.getCurrentPosition(function(position){
                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;
                        var cadenaRuta =latitude+","+longitude+";4.62788,-75.59876";
                        $("#coordenadas").val(cadenaRuta);
                        $("#formulario_rutas").submit();
                    });
                }
            });
        });
        if(navigator.geolocation){
            navigator.geolocation.getCurrentPosition(function(position){
                var latitude = position.coords.latitude;
                var longitude = position.coords.longitude;
                var mymap = L.map('mapa', {
                    center: [latitude, longitude],
                    zoom: 12,
                });
                L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    maxZoom: 25,
                    attribution: 'Datos del mapa de &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imágenes © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11'
                }).addTo(mymap);

                L.Routing.control({
                    waypoints: [
                        L.latLng(latitude, longitude),
                        L.latLng(4.62788,-75.59876)
                    ],
                    language: 'es'
                }).addTo(mymap);

            });

        }
        else{
            var mymap = L.map('mapa', {
                center: [4.62788,-75.59876],
                zoom: 17
            });
            L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 25,
                attribution: 'Datos del mapa de &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a>, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imágenes © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox/streets-v11'
            }).addTo(mymap);
        }
        mymap.scrollWheelZoom.enable();

    </script>
</body>

</html>


