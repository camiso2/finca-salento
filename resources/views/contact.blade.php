@extends('layouts.app')

@section('content')

<!-- banner -->
<div class="logo_" style="border-radius:0px !important;margin:0 !important">
    <h1><i class="glyphicon glyphicon-leaf" aria-hidden="true"></i>ECOHOTEL El Rosario</h1>
    <a href="/">
        PARA LOS AMANTES DE LA <span>NATURALEZA</span>
    </a>
</div>
@include('sections.header-nav')

<div class="map">

    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15907.285858250832!2d-75.5982678!3d4.6259207!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x3d3d7a34649f3ffc!2zNMKwMzcnNDAuNCJOIDc1wrAzNSc1NS42Ilc!5e0!3m2!1sen!2sco!4v1638545139609!5m2!1sen!2sco"
        frameborder="0" style="border:0" allowfullscreen loading="lazy"></iframe>




    <div class="container">
        <div class="map-grids">
            <div class="col-md-3 contact-left">
                <h3>Contáctenos</h3>
                <div class="line minus">
                </div>
                <p>ECOHOTEL EL ROSARIO
                    , Frente a la Haciena la Esperanza
                    Desvío Vía Nacional.</span></p>
                <ul>
                    <li>Los Contáctaremos a la Brevedad</li>
                    <li>Teléfono :+57 {{ env('PHONE') }}</li>
                    <li><a href="mailto:info@elrosario-salento.com">info@elrosario-salento.com</a></li>
                </ul>
            </div>
            <div class="col-md-9 contact-left">
                <h3>Escríbanos</h3>
                <div class="line minus1">
                </div>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <form action="contacto" method="post">
                    {{csrf_field()}}
                    <input type="text" name="nombre" value="Nombre" onfocus="this.value = '';"
                        onblur="if (this.value == '') {this.value = 'Nombre';}" required="">
                    <input type="email" name="email" value="Email" onfocus="this.value = '';"
                        onblur="if (this.value == '') {this.value = 'Email';}" required="">
                    <input type="text" name="telefono" value="Teléfono" onfocus="this.value = '';"
                        onblur="if (this.value == '') {this.value = 'Teléfono';}" required="">
                    <textarea type="text" name="mensaje" onfocus="this.value = '';"
                        onblur="if (this.value == '') {this.value = 'Mensaje...';}" required="">Mensaje...</textarea>


                        <div class="re-cap">
                            {!! htmlFormSnippet() !!}
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 ">
                    <input type="submit" value="Enviar">
                </div>
            </div>

                </form>

            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<!-- //map -->
<!-- footer -->
@include('sections.footer')
<!-- //footer -->
<!-- for bootstrap working -->
<script src="js/bootstrap.js"> </script>
<!-- //for bootstrap working -->
@endsection
