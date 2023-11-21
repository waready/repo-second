<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orden de Servicio</title>
</head>

<body>



    <!-- ------------------------------------------------------------ORDEN DE SERVICIO----------------------------------------------- -->
    <table style="text-align:center">
        <tr>
            <td>
                UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO
            </td>
        </tr>
        <tr>
            <td style="font-size:10px; font-weight: bold;">
                CENTRO DE PRODUCCION DE BIENES Y SERVICIOS - CEPREUNA
            </td>
        </tr>
    </table>
    
    <h1 style="text-align:center;">ORDEN DE SERVICIO N° &nbsp; {{ $data->num_os }}</h1>
    <!-- <h5 style="text-align:center">N° Exp. SIAP: 0000002377</h5> -->
    <table style="font-size:8px">
        <tr>
            <td colspan="3" style="font-weight: bold;">UNIDAD EJECUTORA
            </td>
            <td colspan="10">:
                UNIVERSIDAD NACIONAL DEL ALTIPLANO
                {{-- {{$ejecutor}} --}}
            </td>
            <td colspan="3" rowspan="2">
                <table border="1" style="text-align:center">
                    <tr style="font-weight: bold;">
                        <td>Día</td>
                        <td>Mes</td>
                        <td>Año</td>
                    </tr>
                    <tr>
                        <td>{{ date('d') }}</td>
                        <td>{{ date('m') }}</td>
                        <td>{{ date('Y') }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <!-- <td colspan="3">NRO. IDENTIFICACION</td> -->
            <td colspan="10"><span style="font-weight: bold;">RUC : </span>20145496170</td>
        </tr>
    </table><br><br>
    <table>
        <tr>
            <td colspan="10"></td>
            <td colspan="4"></td>
            <td colspan="3" style="border: 1px solid black; font-size:7px; font-weight:bold;">REG SIAF N°</td>
        </tr>
    </table><br><br>
    <table style="font-size:8px" border="1">
        <tr>
            <th colspan="9" style="font-weight: bold;">1.DATOS DEL PROVEEDOR</th>
            <th colspan="7" style="font-weight: bold;">2.CONDICIONES GENERALES</th>
        </tr>
        <tr>
            <td colspan="9">
                <table>
                    <tr>
                        <td colspan="2" style="font-weight: bold;">Señor(es)</td>
                        <td colspan="8">: {{$data->apellidos_nombres}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold;">Direccion</td>
                        <td colspan="8">: {{$data->domicilio}}</td>
                    </tr>
                    <tr>
                        <td colspan="6">/ /</td>
                        <td colspan="4"><span style="font-weight: bold;">CCI:</span>{{$data->cci}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><span style="font-weight: bold;">RUC:</span>{{$data->ruc}}</td>
                        <td colspan="3"><span style="font-weight: bold;">Telefono:</span> {{$data->celular}}</td>
                        <td colspan="4"><span style="font-weight: bold;">Fax:</span> </td>
                    </tr>
                </table>
            </td>
            <td colspan="7">
                <table>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">N° Cuadro Adquisic:</span> {{$data->cuadro_adq}}</td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">Tipo de Proceso:</span> {{$data->tipo_proceso}}</td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">N° Contrato:</span> {{$data->num_contrato}}</td>
                    </tr>
                    <tr>
                        <td colspan="5"><span style="font-weight: bold;">Moneda:</span> {{$data->moneda}}</td>
                        <td colspan="2"><span style="font-weight: bold;">T/C:</span> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="16">
                <!-- Concepto: OFICIO N° 0375-2023-P-CEPREUNA-PUNO/INVERSIONES EDUCATIVAS IESCOOP SAC/ARREND. DE AULAS PEDAGOGICAS  -->
                <span style="font-weight: bold;">Referencia: </span>{{$data->referencia}}
                <br>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:8px;" border="1">
        <tr style="text-align:center">
            <th colspan="4" style="font-weight: bold;">Codigo</th>
            <th colspan="4" style="font-weight: bold;">Unid. Med</th>
            <th colspan="22" style="font-weight: bold;">Descripción</th>
            <th colspan="5" style="font-weight: bold;">Valor Total S/</th>
        </tr>
        
            <tr style="text-align:center">
                <td colspan="4" style="height:310px; font-weight:bold;">{{$data->codigo}}</td>
                <td colspan="4" style="font-weight:bold;">{{$data->unidad_medida}}</td>
                <td colspan="22" style="text-align:left;"><span style="font-weight: bold;"> {{$data->descripcion_general}}</span>
                    <ul>
                        <li>{{$data->descripcion }}</li>
                    </ul>
                </td>
                <td colspan="5" style="text-align:right; font-weight:bold;">{{   number_format($data->valor_total, ($data->valor_total == intval($data->valor_total) ? 2 : 2), '.', ',') }}</td>
            </tr>
        
    </table>
    <br><br>

    <table style="font-size:8px">
        <tr>
            <td colspan="24">
                @php $sumaTotal = 0; @endphp 
    
                @php
                    $monto = $data->valor_total;
                    $sumaTotal += $monto;
                @endphp

                @php

                    // Convertir el número a una cadena con dos decimales
                    $numeroCadena = number_format($sumaTotal, 2, '.', '');

                    // Tomar solo los dos últimos dígitos decimales
                    $decimales = substr(strrchr($numeroCadena, '.'), 1);
                    // Crear un formateador para representación escrita en español
                    $formateador = new NumberFormatter('es', NumberFormatter::SPELLOUT);

                    // Obtener la representación escrita del número
                    $representacionEscrita = $formateador->format(intval($sumaTotal));
                    $representacionEscrita = strtoupper($representacionEscrita);

                @endphp

                <table style="font-size:7px; text-align:center" border="0">
                    <tr>
                        <td colspan="26" border="1" style="text-align: left; font-weight:bold;">{{$representacionEscrita}} CON {{$decimales}}/100 SOLES</td>
                    </tr>
                    <tr>
                        <td colspan="26"></td>
                    </tr>
                    <tr>
                        <td colspan="26" border="1">AFECTACIÓN PRESUPUESTAL</td>
                    </tr>
                    <tr>
                        <th colspan="3" rowspan="2" style="font-size: 6.5px;" border="1">Meta/ Mnemónico</th>
                        <th colspan="10" rowspan="2" border="1">Cadena Funcional</th>
                        <th colspan="2" rowspan="2" border="1">FF/Rb</th>
                        <th colspan="5" rowspan="2" border="1">Clasif. Gasto</th>
                        <th colspan="6" border="1">Monto</th>
                    </tr>
                    <tr>
                        <th colspan="3" border="1"></th>
                        <th colspan="3" border="1">S/</th>
                    </tr>
                    <tr>
                        <td colspan="3" border="1"><!--0041--></td>
                        <td colspan="10" border="1"><!--22.048.0109.9002.3999999.5001888 --></td>
                        <td colspan="2" border="1"><!--2 -09--></td>
                        <td colspan="5" border="1"><!--2.3. 2 5. 1 1 --></td>
                        <td colspan="3" border="1"></td>
                        <td colspan="3" border="1"><!--31,200.00--></td>
                        <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
                        <!-- </td> -->
                    </tr>
                </table>
            </td>
            <td colspan="1"></td>
            <td colspan="8">
                <table style="border: 1px solid black">
                    <tr>
                        <td>TOTAL S/</td>
                        <td style="text-align:right; font-weight:bold;">
                            {{ number_format($sumaTotal, ($sumaTotal == intval($sumaTotal) ? 2 : 2), '.', ',') }}
                        </td>
                    </tr>
                </table>
                <br><br>

                <!-- <table style="border: 1px solid black">
                    <tr>
                        <td>Exonerado :</td>
                        <td style="text-align:right">0.00</td>
                    </tr>
                    <tr>
                        <td>V. Venta :</td>
                        <td style="text-align:right">28,440.68</td>
                    </tr>
                    <tr>
                        <td>Exonerado :</td>
                        <td style="text-align:right">4,759.32 <br></td>
                    </tr>
                </table>
                <table style="border: 1px solid black">
                    <tr>
                        <td>Total :</td>
                        <td style="text-align:right">31,200.00
                            <hr>
                        </td>
                    </tr>
                </table> -->
            </td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:8px; border: 1px solid black">
        <tr>
            <td colspan="3"><span style="font-weight: bold;">Facturar a nombre de:</span> UNIVERSIDAD NACIONAL DEL ALTIPLANO</td>
            <td colspan="1"></td>
        </tr>
        <tr>
            <td colspan="3"><span style="font-weight: bold;">Dirección:</span> AV. EL SOL NRO 329 / PUNO - PUNO - PUNO</td>
            <td colspan="1"><span style="font-weight: bold;">RUC:</span> 20145496170</td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:6px; border: 1px solid black;" border="1">
        <tr style="background-color: #ddd; text-align:center">
            <th colspan="3">ELABORADO POR</th>
            <th colspan="6">ORDENACION DEL SERVICIO</th>
            <th colspan="3">CONFORMIDAD DEL SERVICIO</th>
        </tr>
        <tr>
            <td colspan="3" rowspan="2" style="padding-top: 1px;"> {{ strtoupper(Auth::user()->paterno) }} {{ strtoupper (Auth::user()->materno) }} {{ strtoupper(Auth::user()->name) }}</td>
            <td colspan="3"><br><br><br><br><br><br><br><br><br></td>
            <td colspan="3"></td>
            <td colspan="3" rowspan="2"></td>
        </tr>
        <tr style="text-align: center;">
            <td colspan="3">RESPONSABLE DE ADQUISICIONES</td>
            <td colspan="3">RESPONSABLE DE ABASTECIMIENTO</td>
            <td colspan="3"></td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:6px; border: 1px solid black;">
        <tr>
            <td style="font-weight: bold;">NOTA IMPORTANTE:</td>
        </tr>
        <tr>
            <td>-El proveedor debe adjuntar su comprobante de pago segun corresponda.</td>
        </tr>
        <tr>
            <td>-Esta orden es nula sin las firmas y sellos reglamentarios o autorizados.</td>
        </tr>
        <tr>
            <td>-El contratista (Proveedor) se obliga a cumplir las obligaciones que le corresponden, bajo sancion de quedar inhabilitado para contratar con el Estado en caso de incuplimiento.</td>
        </tr>
    </table>
</body>

</html>