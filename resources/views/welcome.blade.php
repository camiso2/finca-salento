@extends('layouts.app')

@section('content')


<!-- banner -->
<div class="banner">
    <div class="back-title"></div>
    <div class="container">
        <div class="logo_" style="">
            <h1><i class="glyphicon glyphicon-leaf" aria-hidden="true"></i>ECOHOTEL El Rosario</h1>
            <a href="/">
                PARA LOS AMANTES DE LA <span>NATURALEZA</span>

                <div id="google_translate_element"></div>
            </a>
        </div>
        <div class="appointment">
            <h1>haz tu reservación</h1>
            <form action="reserva" method="post">
                {{csrf_field()}}
                <input type="text" placeholder="Su Nombre..." required="">
                <input type="email" placeholder="Su E-Mail..." required="">
                <input type="number" placeholder="Teléfono..."  required="">
                <div class="book_date">
                    <input type="date" value="Select date" required=""  >
                </div>
                <input type="submit" value="Reservar">
            </form>
        </div>
    </div>
</div>
<!-- //banner -->
@include('sections.header-nav')


<!-- banner-bottom -->
<!-- //banner-bottom -->
<!-- welcome -->
<div class="welcome">
    <div class="container">
        <h3 style="font-size: 45px !important">ECOHOTEL <span>EL ROSARIO</span></h3>
        <p class="velit">Se Encuentra Ubicado En La Zona de Boquía - Vereda el Agrado, a Tan solo 20 Minutos De Salento,
            Podrán Disfrutar en Nuestras Instalaciones de Senderos
                    Ecológicos, Avistamiento de Aves, Zona de Hamacas, Piscina Natural, Zona de Fogatas, Mirador Natural.</p>

        <div class="welcome-grids">
            <div class="col-md-4 welcome-grid">
                <img src="images/img/c4.jpg" alt=" " class="img-responsive" />
            </div>
            <div class="col-md-5 welcome-grid">
                <h2>La Cabaña Natural Consta de habitación para 4 personas, Baño, Jacuzzi, Catamarán, Mirador de Aves
                </h2>
                <p>IDEAL PARA LOS AMANTES DE LA NATURALEZA !</p>
            </div>
            <div class="col-md-3 welcome-grid">
                <div class="more">

                    {{--<a href="#" class="hvr-bounce-to-bottom m1">Más información...</a>--}}
                    <a href="tel:{{ env('PHONE') }}" class="hvr-bounce-to-bottom m1" title="{{ env('PHONE') }}">
                        <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;Hablar con Asesor !
                   </a>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //welcome -->
<div class="banner-bottom" style="margin-top: 15px;">
    <div class="container">
        <div class="welcome">
            <h3 style="font-size: 45px !important"><span>AQUÍ</span> PUEDES ENCONTRAR !</h3>
        </div>
        <div class="col-md-4 banner-bottom-grid">
            <img src="images/img/c1.jpg" alt=" " class="img-responsive" />
            <div class="banner-bottom-grd">
                <h3>TOUR A CABALLO POR ZONAS ALEDAÑAS</h3>
                <p>Montar a caballo: un ejercicio muy recomendable para tu cuerpo y para tu mente.</p>
            </div>
        </div>
        <div class="col-md-4 banner-bottom-grid">
            <img src="images/img/c2.jpg" alt=" " class="img-responsive" />
            <div class="banner-bottom-grd">
                <h3>AVISTAMIENTO DE AVES</h3>
                <p>En Colombia hay más de 1.900 especies identificadas y 550 de ellas solo las puedes apreciar en el
                    Quindío.</p>
            </div>
        </div>
        <div class="col-md-4 banner-bottom-grid">
            <img src="images/img/c3.jpg" alt=" " class="img-responsive" />
            <div class="banner-bottom-grd">
                <h3>TOUR EN BICICLETA ZONAS ALEDAÑAS</h3>
                <p>Descubre en bicicleta la magia y el encanto de las rutas del café.</p>
            </div>
        </div>

        <div class="clearfix"> </div>
        <div class="more">
            <br><br>
            <a href="services" class="hvr-bounce-to-bottom m1">Mucho Más...</a>
        </div>
        <hr class="hr-sep">
    </div>

</div>

<!-- welcome-bottom -->
<div class="welcome-bottom">
    <div class="container">
        <div class="welcome-bottom-banner">
            <h3>SERVICIOS ESPECIALES</h3>
            <p class="velit">Ofrecemos Cómodas Habitaciones Llenas de Vida y Excelentes Vistas.</p>
            <div class="welcome-bottom-grids">
                <div class="welcome-bottom-grid-left">
                    <div class="welcome-bottom-grid-left-g">
                        <img src="images/img/c5.jpg" alt=" " class="img-responsive" />
                        <div class="welcome-bottom-grid-left-gpos">
                            <h4 style="font-size: 20px;"><b>Ofrece Comidas Por Separado</b></h4>
                            <p>Una Combinación De Sabores Que No Necesita Ningún Tipo De Presentación.</p>
                            <div class="more">
                                <a href="#" class="hvr-bounce-to-bottom m1">Más Información...</a>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-bottom-grid-left-g">
                        <img src="images/8.jpg" alt=" " class="img-responsive" />
                        <div class="welcome-bottom-grid-left-gpos1">
                            <h4><b>Planes Románticos en las Cabañas</b></h4>
                            <p>Sabemos Lo Importante Que Es Mantener Una Relación Fuerte Con Tú Pareja.</p>
                            <div class="more">
                                <a href="#" class="hvr-bounce-to-bottom m1">Más Información...</a>
                            </div>
                        </div>
                    </div>
                    <div class="dummy">
                        <p>Entregar a nuestros clientes una experiencia de relajación, ofreciendo altos estándares de
                            comodidad, tranquilidad, satisfacción. El servicio que ofrecemos es diferencial a cualquier
                            otro en el eje cafetero.<br><br>
                            <b style="font-size: 35px;">¡ TE ESPERAMOS !</b></h5>
                    </div>
                </div>
                <div class="welcome-bottom-grid-right">
                    <h5>NUESTRAS REDES SOCIALES !</h5>
                    <div id='social'>
                        <a class='facebook' title='Facebook' href='https://www.facebook.com/Finca-El-Rosario-Salento-104002952117579' target="_blank">
                            <i class="fa fa-facebook"></i>
                        </a>
                        <a class='twitter' title='Twitter' href='https://twitter.com/fincaelrosarioS' target="_blank">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <a class='gplus' title='Instagram' href='https://www.instagram.com/fincaelrosariosalento/' target="_blank">
                            <i class="fa fa-instagram"></i>
                        </a>
                    </div>
                    <script>
                        $(document).ready(function() {
                            $( "#social a" ).each(function() {
                              var tipt = $(this).attr('title');
                              $(this).attr('title','');
                              $(this).append('<span>');
                              $(this).children('span').text(tipt);
                              var spanWidth = $(this).children('span').width() + 20;
                              var spanMarg = 0 - spanWidth/2;
                              $(this).children('span').css('width',spanWidth);
                              $(this).children('span').css('margin-left',spanMarg);
                              $(this).hover (
                                function() {
                                  $(this).children('span').fadeIn();
                                  $('#social a').css('opacity','.1');
                                  $(this).css('opacity','1');
                                }, function() {
                                  $(this).children('span').fadeOut();
                                  $('#social a').css('opacity','1');
                                }
                              );
                            });
                          });
                    </script>
                    {{-- <ul>
                        <li><a href="#" class="facebook"> </a></li>
                        <li><a href="#" class="instagram"> </a></li>
                        <li><a href="#" class="twitter"> </a></li>
                    </ul>--}}
                    <div class="welcome-bottom-grid-left-g">
                        <img src="images/img/c7.jpg" alt=" " class="img-responsive" />
                        <div class="welcome-bottom-grid-left-gpos">
                            <h4>Eventos Sociales</h4>
                            <p>Los eventos sociales están más enfocados al ámbito privado, familiar o de relaciones sociales que inducen a una mejora en los vínculos afectivos entre los invitados.</p>
                            <div class="more">
                                <a href="#" class="hvr-bounce-to-bottom m1">Más Información...</a>
                            </div>
                        </div>
                    </div>
                    <div class="welcome-bottom-grid-left-g">
                        <img src="images/img/c6.jpg" alt=" " class="img-responsive" />
                        <div class="welcome-bottom-grid-left-gpos1">
                            <h4>Caminatas Turísticas</h4>
                            <p>Caminata a Finca el Ocaso, Caminata a la Bocatoma, Caminata por la Vía Nacional.</p>
                            <div class="more">
                                <a href="#" class="hvr-bounce-to-bottom m1">Más Información...</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="clearfix"> </div>
            </div>
        </div>
    </div>
</div>


<!-- //welcome-bottom -->
@include('sections.footer')
<!-- for bootstrap working -->
<script src="/js/bootstrap.js"> </script>
<!-- //for bootstrap working -->

@endsection
