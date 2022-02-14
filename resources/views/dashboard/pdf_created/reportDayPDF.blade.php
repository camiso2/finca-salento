<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte : {{date('Y-m-d H:m:s')}}</title>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;

        }


        #customers th {
            border: 1px solid #ddd;
            padding-left: 8px;
            font-size: 12px;



        }

        #customers td {
            border: 1px solid #ddd;
            padding-left: 8px;
            font-size: 12px;
            height: 20px !important;

        }


        /*#customers tr:nth-child(even){background-color: #f2f2f2;}*/
        #customers tr:hover {
            background-color: #ddd;

        }

        #customers th {
            padding-top: 3px;
            padding-bottom: 3px;
            text-align: left;
            background-color: #799F61;
            color: white;

        }

        .th-w-title-left {
            width: auto;
            background-color: white !important;
            color: black !important;

            border: 0 !important;
            font-weight: 400 !important;
            vertical-align: baseline;


        }

        .th-w-title-rigth {
            width: auto;
            background-color: white !important;
            color: black !important;

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
            color: black;
            margin-right: 15px;
            text-align: right;

        }

        p {
            font-size: 12px;
            font-family: Arial, Helvetica, sans-serif;
        }

        .fetch-order {
            font-size: 10px;
            color: rgb(187, 192, 194);
        }
    </style>
</head>

<body>

    <div class="title"><img src="images/title.png" alt=""> </div>
    <p><b>Fecha Reporte </b>{{date('Y-m-d H:m:s')}}</p>
    <hr class="hr">
    <p>REPORTE DE VENTAS ::: <b>Generado por </b>{{Auth::user()->name}}</p>
    <table id="customers">
        <tr>
            <th class="th-w-title-left" style="width:25% !important">

                <p><b>Check-In en Habitaciones</b> </p>
                <p><b>Productos Vendidos </b> </p>
                <p><b>Habitaciones Disponibles </b> </p>
                <p><b>Facturas Generadas </b> </p>
            </th>
            <th class="th-w-title-left" style="width:40% !important">


                <p>{{count($checkins)}} </p>
                <p>{{count($orders)}} </p>
                <p>{{$availableRooms}} </p>
                <p>{{$invoices->count()}} </p>
            </th>

            <th class="th-w-title-rigth" style="width:22% !important">
                <p><b>Total Ventas Productos </b> </p>
                <p><b>Total Descuentos Clientes </b> </p>
                <p><b>Sub-Total VENTAS </b> </p>
                <p><b>Total IVA </b> </p>
                <p><b>TOTAL VENTAS</b> </p>
            </th>
            <th class="th-w-title-left">
                <p> $ {{number_format($totalSales,0,"",".")}}</p>
                <p> $ {{number_format($totalDisscounts,0,"",".")}}</p>
                <p> $ {{number_format($totalStaySales,0,"",".")}}</p>
                <p> $ {{number_format($totalIva,0,"",".")}}</p>
                <p> <b>$ {{number_format($totalIva+$totalStaySales,0,"",".")}}</b></p>
            </th>
        </tr>
    </table>
    <hr class="hr">
    @if(count($invoices)>0)
    @foreach ($invoices as $invoice)

    <table id="customers">
        <tr>
            <th class="th-w">
                @foreach ($debrooms as $debroom)
                @if($debroom->id == $invoice->debroom_id)
                <?php $dayRoomCost = $debroom->dayRoomCost?>
                <p> Descripción ::: Habitación {{$debroom->codeRoom}} ::: Costo por día $
                    {{number_format($debroom->dayRoomCost,0,"",".")}} </p>
                @endif
                @endforeach
            </th>
            <th>Valor</th>

        </tr>

        <tr>
            <td>
                <p>
                    <span class="fetch-order">FECHA : {{$invoice->created_at}}</span> <br>
                    Estadía : {{ $invoice->dayStay == 1 ? $invoice->dayStay." día, ": $invoice->dayStay." días, "
                    }}{{$invoice->hourStay==1 ? $invoice->hourStay." hora":$invoice->hourStay.".horas"}}
                </p>
            </td>
            <td> $ {{number_format($dayRoomCost,0,"",".")}}</td>
        </tr>
        @foreach ($orders as $order)
        @if($order->numberInvoice == $invoice->numberInvoice)
        <tr>
            <td>
                <p> <span class="fetch-order">FECHA : {{$order->created_at}}</span> <br> {{$order->order}} </p>
            </td>
            <td> $ {{number_format($order->valueOrder,0,"",".")}} </td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td style="text-align: right !important">
                <p> <b>SUB-TOTAL </b> </p>
            </td>
            <td>
                $ {{number_format($invoice->subTotal,0,"",".")}}
            </td>
        </tr>

        <tr>
            <td style="text-align: right !important">
                <p> <b>IVA </b> </p>
            </td>
            <td>
                $ {{number_format($invoice->iva,0,"",".")}}
            </td>
        </tr>
        @foreach ($checkins as $checkin)
        @if($checkin->numberInvoice == $invoice->numberInvoice)
        <tr>
            <td style="text-align: right !important">
                <p> <b>ANTICIPO </b> </p>
            </td>
            <td>
                $ {{number_format($checkin->advance,0,"",".")}}
            </td>
        </tr>
        @endif
        @endforeach
        <tr>
            <td style="text-align: right !important">
                <p> <b>DESCUENTO </b> </p>
            </td>
            <td>
                $ {{number_format($invoice->disscountClient,0,"",".")}}
            </td>
        </tr>
        <tr>
            <td style="text-align: right !important">
                <p> <b>TOTAL </b> </p>
            </td>
            <td>
                $ {{number_format(($invoice->total)-($invoice->disscountClient),0,"",".")}}
            </td>
        </tr>
    </table>
    @endforeach
    @else
    <p>NO hay report de ventas</p>
    @endif
    <br>
    <div align="center">
        <font size="1">Reporte Generado Finca @include('sections.app_name')</font>
        <br>
        <font size="1">© 2022 AppTlax (innova). todos los derechos Reservados</font>
    </div>



</body>

</html>
