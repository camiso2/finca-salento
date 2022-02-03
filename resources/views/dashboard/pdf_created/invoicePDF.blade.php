<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>recibo de Pago</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding-left: 8px;
            font-size: 12px;

        }


        /*#customers tr:nth-child(even){background-color: #f2f2f2;}*/
        #customers tr:hover {
            background-color: #ddd;

        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #799F61;
            color: white;
        }

        .th-w-title-left {
            width: auto;
            background-color: white !important;
            color: black !important;
            height: 25px !important;
            border: 0 !important;
            font-weight: 400 !important;
            vertical-align: baseline;


        }

        .th-w-title-rigth {
            width: auto;
            background-color: white !important;
            color: black !important;
            height: 25px !important;
            text-align: right !important;
            border: 0 !important;
            font-weight: 400 !important;
            vertical-align: baseline;
        }

        .th-w {
            width: 80%;
        }

        .title {

            text-align: center;
        }

        .title img {
            width: 95%;
        }

        .hr {
            border-top: 3px solid #799F61 !important;
        }

        .receipt {
            color: red !important;
            margin-right: 15px;
            text-align: right;

        }
    </style>
</head>

<body>

    <h4> <?php (int) $disscount  = is_null($disscount)?0:$disscount?> </h4>

    <div class="title"><img src="images/title.png" alt=""> </div>
    <div class="receipt">
        <p><b>No : {{$numberInvoice}}</b></p>
    </div>
    <hr class="hr">
    <table id="customers">
        <tr>
            <th class="th-w-title-left" style="width:15% !important">
                <p><b>Fecha </b></p>
                <p><b>Generado por </b></p>
                <p><b>Teléfono </b></p>
                <p><b>E-mail </b></p>
                <p><b>Ubicación </b></p>
            </th>
            <th class="th-w-title-left" style="width:45% !important">
                <p>{{date('Y-m-d H:i')}}</p>
                <p>{{Auth::user()->name}}</p>
                <p>{{ENV('PHONE')}}</p>
                <p>info@elrosario-salento.com</p>
                <p>Zona de Boquía - Vereda el Agrado</p>
            </th>
            <th class="th-w-title-left" style="width:15% !important">
                <p><b>Ingreso </b> </p>
                <p><b>Cliente </b> </p>
                <p><b>Email </b> </p>
                <p><b>Identificación </b> </p>
                <p><b>Teléfono </b> </p>
            </th>
            <th class="th-w-title-left">
                <p>{{$checkin->timeEnter}}</p>
                <p>{{$checkin->name}}</p>
                <p>{{$checkin->email}}</p>
                <p>{{$checkin->identClient}}</p>
                <p>{{$checkin->phone}}</p>

            </th>
        </tr>
    </table>

    <table id="customers">
        <tr>
            <th class="th-w">Descripción</th>
            <th>Valor</th>
        </tr>
        <tr>
            <td>
                <p>Estadía de {{ $dayStay == 1 ? $dayStay." día, ": $dayStay." días, " }}{{$hourStay==1 ? $hourStay." hora":$hourStay.".horas"}}</p>
            </td>
            <td style="color: #0275d8; font-weigth: 600">
                <p>$ {{ number_format($valueStay,0,"",".") }}</p>
            </td>
          </tr>
        @foreach ($orders as $order )
        <tr>
            <td>
                <p> {{$order->order}}</p>
            </td>
            <td> $ {{number_format($order->valueOrder,0,"",".")}}</td>
        </tr>
        @endforeach
        <tr>
            <td style="text-align: right !important">
                <p> <b>SUB-TOTAL </b> </p>
            </td>
            <td>
                $ {{number_format($subTotal,0,"",".")}}
            </td>
        </tr>
        <tr>
            <td style="text-align: right !important">
                <p> <b>IVA </b> </p>
            </td>
            <td>
                $ {{number_format($iva,0,"",".")}}
            </td>
        </tr>
        <tr>
            <td style="text-align: right !important">
                <p> <b>ANTICIPO </b> </p>
            </td>
            <td>
                $ {{number_format($checkin->advance,0,"",".")}}
            </td>
        </tr>

        <tr>
            <td style="text-align: right !important">
                <p> <b>DESCUENTO </b> </p>
            </td>
            <td>
                $ {{number_format($disscount,0,"",".")}}
            </td>
        </tr>

        <tr>
            <td style="text-align: right !important">
                <p> {{(int) $total-$disscount< 0 ? "( Balance a favor del cliente $ ".number_format(($total-$disscount)*(-1),0,"",".")." )" : ""}} <b>TOTAL </b> </p>
            </td>
            <td>
                $ {{ $disscount >= $total ? 0:number_format($total-$disscount,0,"",".")}}
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <font size="1">Recibo de Pago Generado Finca @include('sections.app_name')</font>
        <br>
        <font size="1">© 2022 AppTlax (innova). todos los derechos Reservados</font>
    </div>


</body>

</html>
