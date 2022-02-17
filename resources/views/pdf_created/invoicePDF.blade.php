<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
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
            background-color: #2A3F54;
            color: white;
        }

        .th-w-title-left {
            width: auto;
            background-color: white !important;
            color: black !important;
            height: 15px !important;
            border: 0 !important;
            font-weight: 400 !important;
            vertical-align: baseline;


        }

        .th-w-title-rigth {
            width: auto;
            background-color: white !important;
            color: black !important;
            height: 15px !important;
            text-align: right !important;
            border: 0 !important;
            font-weight: 400 !important;
            vertical-align: baseline;
        }

        .th-w {
            width: 80%;
        }

        .title {
            font-family: Arial, Helvetica, sans-serif;
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
            text-align: center;
            font-family: Arial, Helvetica, sans-serif;

        }
    </style>
</head>

<body>

    <div class="title">
        <h1><b>FACTURA DE VENTA</b> </h1>
    </div>

    <div class="receipt">
        <b>No : {{$numberInvoice}}</b>
    </div>

    <hr>
    <table id="customers">
        <tr>
            <th class="th-w-title-left" style="width:15% !important">
                <p><b>Fecha </b></p>
                <p><b>Generado por </b></p>
                <p><b>E-mail </b></p>
                <p><b>Tipo Factura </b></p>
            </th>
            <th class="th-w-title-left" style="width:45% !important">
                <p>{{date('Y-m-d H:i')}}</p>
                <p>{{$user->name}}</p>
                <p>{{$user->email}}</p>
                <p>Factura de Prueba</p>
            </th>
            <th class="th-w-title-left" style="width:15% !important">
                <p><b>Cliente </b> </p>
                <p><b>Email </b> </p>
                <p><b>Teléfono </b> </p>
            </th>
            <th class="th-w-title-left">
                <p>{{$cliente}}</p>
                <p>{{$email}}</p>
                <p>{{$telefono}}</p>
            </th>
        </tr>
    </table>



    <table id="customers">
        <tr>
            <th class="th-w" style="width:250px;text-align:center">Producto</th>
            <th class="th-w" style="width:45px;">Cantidad</th>
            <th class="th-w"style="width:100px;" >valor Unitario </th>
            <th class="th-w" style="width:100px;">IVA</th>
            <th class="th-w" style="width:100px;">Valor Total</th>
        </tr>
        <tr>
            <td>
                @foreach($products as $key => $val )
                <p> {{$val}} </p>
                @endforeach
            </td>
            <td style="text-align: center">
                @foreach($cantidad as $key => $val )
                <p> {{$val}} </p>
                @endforeach
            </td>
            <td>
                @foreach($valorUnitario as $key => $val )
                <p>$ {{number_format($val,0,"",".")}} </p>
                @endforeach
            </td>
            <td>
                @foreach($iva as $key => $val )
                <p>$ {{number_format($val,0,"",".")}} </p>
                @endforeach
            </td>
            <td>
                @foreach($valorTotal as $key => $val )
                <p>$ {{number_format($val,0,"",".")}} </p>
                @endforeach
            </td>
        </tr>
        <tr>
            <td colspan=4 style="text-align: right !important">
                <p> <b>SUB-TOTAL </b> </p>
            </td>
            <td>
                $ {{number_format($granSubtotal,0,"",".")}}
            </td>
        </tr>
        <tr>
            <td colspan=4 style="text-align: right !important">
                <p> <b>IVA </b> </p>
            </td>
            <td>
                $ {{number_format($granIva,0,"",".")}}
            </td>
        </tr>
        <tr>
            <td colspan=4 style="text-align: right !important">
                <p> <b>GRAN TOTAL </b> </p>
            </td>
            <td>
                $ {{number_format($granTotal,0,"",".")}}
            </td>
        </tr>
    </table>
    <br>
    <div align="center">
        <font size="1">Recibo de Pago Generado {{ config('app.name', 'Laravel') }}</font>
        <br>
        <font size="1">© 2022 Jaiver Ocampo. todos los derechos Reservados</font>
    </div>


</body>

</html>
