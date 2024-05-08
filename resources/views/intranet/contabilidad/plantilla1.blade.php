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
            <td style="font-size:8px;">
                UNIVERSIDAD NACIONAL DEL ALTIPLANO - PUNO
            </td>
        </tr>
        <tr>
            <td style="font-size:10px; font-weight: bold;">
                CENTRO DE PRODUCCION DE BIENES Y SERVICIOS - CEPREUNA
            </td>
        </tr>
    </table>
    <h2 style="text-align:center;">ORDEN DE COMPRA N° </h2>
    <!-- <h5 style="text-align:center">N° Exp. SIAP: 0000002377</h5> -->
    <table style="font-size:8px">
        <tr>
            <td colspan="3" style="font-weight: bold;">UNIDAD EJECUTORA
            </td>
            <td colspan="10">:
                <!-- 001 UNIVERSIDAD NACIONAL DEL ALTIPLANO -->
                {{$ejecutor}}
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
                        <!-- <td>20</td>
                        <td>03</td>
                        <td>2024</td> -->
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
            <td colspan="14"></td>
            <td colspan="3" style="border: 1px solid black; font-size:8px; font-weight:bold;">REG SIAF N°</td>
        </tr>
    </table><br><br>
    <table style="font-size:8px;" border="1">
        <tr>
            <th colspan="9" style="font-weight: bold;">1.DATOS DEL PROVEEDOR</th>
            <th colspan="7" style="font-weight: bold;">2.CONDICIONES GENERALES</th>
        </tr>
        <tr>
            <td colspan="9">
                <table>
                    <tr>
                        <td colspan="2" style="font-weight: bold;">Señor(es)</td>
                        <td colspan="8">: {{$proveedor["senor_es"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold;">Direccion</td>
                        <td colspan="8">: {{$proveedor["direccion"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="6">/ /</td>
                        <td colspan="4"><span style="font-weight: bold;">CCI:</span> {{$proveedor["cci"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="3"><span style="font-weight: bold;">RUC:</span> {{$proveedor["ruc"]}}</td>
                        <td colspan="3"><span style="font-weight: bold;">Telefono:</span> {{$proveedor["telefono"]}}</td>
                        <td colspan="4"><span style="font-weight: bold;">Fax:</span> {{$proveedor["fax"]}}</td>
                    </tr>
                </table>
            </td>
            <td colspan="7">
                <table>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">N° Cuadro Adquisic:</span> {{$condiciones["cuadro_adquisicion"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">Tipo de Proceso:</span> {{$condiciones["tipo_proceso"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;">N° Contrato:</span> {{$condiciones["num_contrato"]}}</td>
                    </tr>
                    <tr>
                        <td colspan="5"><span style="font-weight: bold;">Moneda:</span> {{$condiciones["moneda"]}}</td>
                        <td colspan="2"><span style="font-weight: bold;">T/C:</span> {{$condiciones["tipo_cambio"]}}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="16">
                <!-- Concepto: OFICIO N° 0375-2023-P-CEPREUNA-PUNO/INVERSIONES EDUCATIVAS IESCOOP SAC/ARREND. DE AULAS PEDAGOGICAS  -->
                <span style="font-weight: bold;">Referencia: </span>{{$condiciones["concepto"]}}
                <br>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:8px; " border="1">
        <tr style="text-align:center">
            <th colspan="4" style="font-weight: bold;">Codigo</th>
            <th colspan="4" style="font-weight: bold;">Unid. Med</th>
            <th colspan="22" style="font-weight: bold;">Descripción</th>
            <th colspan="5" style="font-weight: bold;">Valor Total S/</th>
        </tr>

        <?php
        $iterado = false; // Variable de control para verificar si ya se ha iterado

        foreach ($elements as $item) {
            if (!$iterado) { // Verificar si aún no se ha iterado
                $iterado = true; // Cambiar la variable de control a verdadero para indicar que se ha iterado una vez

                // Aquí colocas el contenido del bucle que deseas ejecutar una sola vez
        ?>
                <tr style="text-align:center; color:white;">
                    <td colspan="4" style="height:300px; font-weight:bold;">{{$item["codigo"]}}</td>
                    <td colspan="4" style="font-weight:bold;">{{$item["medida"]}}</td>
                    <td colspan="22" style="text-align:left;"> <span style="font-weight: bold;">{{$item["descripcion_general"]}}</span>
                        <ul>
                            <?php foreach ($item["descripciones"] as $desc) { ?>
                                <li>{{$desc}}</li>
                            <?php } ?>
                        </ul>
                    </td>
                    <td colspan="5" style="text-align:right; font-weight:bold;"> {{ number_format($item["monto"], ($item["monto"] == intval($item["monto"]) ? 2 : 2), '.', ',') }}</td>
                </tr>
        <?php
            }
        }
        ?>
    </table>
    <br><br>

    <table style="font-size:8px">
        <tr>
            <td colspan="24">
                @php $sumaTotal = 0; @endphp @foreach ($elements as $item) @php
                $monto = floatval($item["monto"]);
                $sumaTotal += $monto;
                @endphp
                @endforeach
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
                <table>
                    <tr>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td colspan="1"></td>
            <td colspan="8">
                <table style="border: 1px solid black; color:black; font-weight:bold;">
                    <tr>
                        <td> V. Venta:</td>
                        <td style="text-align: right;"> {{ (number_format($sumaTotal, ($sumaTotal == intval($sumaTotal) ? 2 : 2), '.', ','))-(number_format($sumaTotal, ($sumaTotal == intval($sumaTotal) ? 2 : 2), '.', ',')*0.18) }}</td>
                    </tr>
                    <tr>
                        <td> I.G.V.</td>
                        <td style="text-align: right;">{{ (number_format($sumaTotal, ($sumaTotal == intval($sumaTotal) ? 2 : 2), '.', ',')*0.18) }}</td>
                    </tr>
                </table><br>
            </td>
        </tr>
        <tr>
            <td colspan="24">


                <table style="font-size:7px; text-align:center; color:black;" border="0">
                    <tr>
                        <td colspan="26" border="1" style="text-align: left; font-weight:bold;">{{$representacionEscrita}} CON {{$decimales}}/100 SOLES</td>
                    </tr>
                    <tr>
                        <td colspan="26"></td>
                    </tr>
                    <tr>
                        <!--
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
                        -->
                        <td> <!-- colspan="3" border="1">0041--></td>
                        <td> <!--colspan="10" border="1">22.048.0109.9002.3999999.5001888 --></td>
                        <td> <!--colspan="2" border="1">2 -09--></td>
                        <td> <!--colspan="5" border="1">2.3. 2 5. 1 1 --></td>
                        <td> <!--colspan="3" border="1"></td>
                        </td> colspan="3" border="1">31,200.00--></td>
                        <!-- <br><br><br><br><br><br><br><br><br><br><br><br><br><br> -->
                        <!-- </td> -->
                    </tr>
                </table>
            </td>
            <td colspan="1"></td>
            <td colspan="8">
                <table style="border: 1px solid black; color:black">
                    <tr>
                        <td>TOTAL S/</td>
                        <td style="text-align:right; font-weight:bold;">
                            {{ number_format($sumaTotal, ($sumaTotal == intval($sumaTotal) ? 2 : 2), '.', ',') }}
                        </td>
                    </tr>
                </table>

                <br>

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
    <br>
    <table style="font-size:8px; border: 1px solid black; color:black">
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
    <table style="font-size:6px; border: 1px solid black; text-align:center; color:black" border="1">
        <tr style="background-color: #ddd; text-align:center">
            <th colspan="6">ELABORADO POR</th>
            <th colspan="18">ORDENACION DE COMPRA</th>
            <th colspan="15">CONFORMIDAD</th>
        </tr>
        <tr>
            <td colspan="6" rowspan="4"><br><br>{{ strtoupper(Auth::user()->paterno) }} {{ strtoupper (Auth::user()->materno) }} {{ strtoupper(Auth::user()->name) }}</td>
            <td colspan="9" rowspan="2"></td>
            <td colspan="9" rowspan="2"></td>
            <td colspan="9" rowspan="2"></td>
            <td colspan="6" rowspan="1"><br><br><br><br><br><br><br><br><br><br></td>
        </tr>
        <tr style="text-align: center;">

            <td colspan="6">FECHA</td>
        </tr>
        <tr>
            <td colspan="9" rowspan="2">RESPONSABLE DE ADQUISICIONES</td>
            <td colspan="9" rowspan="2">RESPONSABLE DE ABASTECIMIENTO</td>
            <td colspan="9" rowspan="2">RESPONSABLE DE ALMACEN</td>
            <td colspan="2">DIA</td>
            <td colspan="2">MES</td>
            <td colspan="2">AÑO</td>
        </tr>
        <tr>
            <td colspan="2"></td>
            <td colspan="2"></td>
            <td colspan="2"></td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:6px; border: 1px solid black; color:black;">
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