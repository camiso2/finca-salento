{{-- <a href="https://maps.google.com/?q=4.62788,-75.59876&z=15" target="_blank">
    <img src="images/pv1.png" class="img-thumbnail img-responsive">
    <br><br>
    <button type="button" class="btn btn-primary  btn-block">
        <h3><i class="	fa fa-map-marker"></i>&nbsp;&nbsp;Como llegar ?</h3>
    </button>
</a>--}}


<form id="formulario_rutas" method="get" action="https://www.openstreetmap.org/directions?engine=fossgis_osrm_car"
    target="_blank">
    <input id="coordenadas" type="hidden" name="route" value="" />

    <button id="calcular_ruta" type="button" class="btn btn-primary btn-block">
        <h3><i class="	fa fa-map-marker"></i>&nbsp;&nbsp;Como llegar ?</h3>

        <br><p>Sigue la Ruta del Mapa, CLICK AQUÍ</p>
        <img src="images/pv1.png" class="img-thumbnail img-responsive" alt="">
    </button>
</form>

<script>
    "use strict";
    $(document).ready(function(){
        $("#calcular_ruta").click(function(){
            if(navigator.geolocation){
                navigator.geolocation.getCurrentPosition(function(position){
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    //var cadenaRuta ='4.61295'+","+'-75.63011'+";4.62788,-75.59876";
                    var cadenaRuta =latitude+","+longitude+";4.62788,-75.59876";
                    $("#coordenadas").val(cadenaRuta);
                    $("#formulario_rutas").submit();
                });
            }
        });

        });


    /*if(navigator.geolocation){
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
                    //L.latLng(4.62788,-75.59876)
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
    }*/


</script>
