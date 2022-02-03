<!-- footer -->
<div class="footer">
    <div class="container">
        <h3>SUSCRIBASE EN NUESTRO PORTAL</h3>
        <p class="para">Recibe En Tu Correo Electrónico Completamente Gratis Videos Y Fotografías.</p>
        <div class="footer-contact">
            <form action="suscribirse" method="post">
                {{csrf_field()}}
                <input type="email" name="email" placeholder="Ingrese Su E-mail " required=" ">
                <input type="submit" value="Suscribirse">
            </form>
        </div>
        <div class="col-md-6 ir-g">
            @include('sections.route-site')
        </div>
        <div class="footer-grids">
            <div class="col-md-6 footer-grid">
                <br>
                <p>ECOHOTEL EL ROSARIO
                    , Frente a la Haciena la Esperanza
                    Desvío Vía Nacional.
                    <a href="mailto:info@elrosario-salento.com.com">info@elrosario-salento.com</a>
                <p>
                <div class="more" style="text-align:left !important">
                    <a href="tel:{{ env('PHONE') }}" class="hvr-bounce-to-bottom m1" title="{{ env('PHONE') }}">
                        <i class="fa fa-phone" aria-hidden="true"></i>&nbsp;&nbsp;Comunícate !
                    </a>
                </div>
                </p>
                <p> <b>Teléfono :</b> +57  {{ env('PHONE') }}</p>
                <hr class="hr-sep">
            </div>

            <div class="col-md-3 footer-grid" style="margin-left: 22px;">
                <ul>
                    <li><a href="/">Inicio</a></li>
                    <li><a href="services">servicios</a></li>
                    <li><a href="contact">Contáctenos</a></li>
                </ul>
            </div>

            <div class="clearfix"> </div>
        </div>
        <div class="footer-copy">
            <p>© 2021 Hecohotel El Rosario. Todos Los Derechos Reservados | Desarrollo <a href="http://apptlax.com/"
                    style="color:rgb(0, 123, 255);">Apptlax (innova)</a> | Diseño <a
                    href="http://w3layouts.com">W3layouts</a> </p>
        </div>
    </div>
</div>
<!-- //footer -->
