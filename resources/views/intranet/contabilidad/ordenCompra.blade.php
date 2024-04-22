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

            </td>
        </tr>
        <tr>
            <td style="font-size:10px; font-weight: bold;">

            </td>
        </tr>
    </table>
    <h2 style="text-align:center; color:white;">.</h2>
    <!-- <h5 style="text-align:center">N° Exp. SIAP: 0000002377</h5> -->
    <table style="font-size:8px">
        <tr>
            <td colspan="3" style="font-weight: bold;">
            </td>
            <td colspan="10">
                <!-- 001 UNIVERSIDAD NACIONAL DEL ALTIPLANO -->

            </td>
            <td colspan="3" rowspan="2">
                <table border="0" style="text-align:center">
                    <tr style="font-weight: bold;">
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <!-- <td>20</td>
                        <td>03</td>
                        <td>2024</td> -->
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <!-- <td colspan="3">NRO. IDENTIFICACION</td> -->
            <td colspan="10"><span style="font-weight: bold;"></span></td>
        </tr>
    </table><br><br>
    <table>
        <tr>
            <td colspan="14"></td>
            <td colspan="3" style="border: 1px solid black; font-size:8px; font-weight:bold;">REG SIAF N°</td>
        </tr>
    </table><br><br>
    <table style="font-size:8px;" border="0">
        <tr>
            <th colspan="9" style="font-weight: bold;"></th>
            <th colspan="7" style="font-weight: bold;"></th>
        </tr>
        <tr>
            <td colspan="9">
                <table>
                    <tr>
                        <td colspan="2" style="font-weight: bold;"></td>
                        <td colspan="8"> </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-weight: bold;"></td>
                        <td colspan="8"> </td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td colspan="4"><span style="font-weight: bold;"></span></td>
                    </tr>
                    <tr>
                        <td colspan="3"><span style="font-weight: bold;"></span> </td>
                        <td colspan="3"><span style="font-weight: bold;"></span> </td>
                        <td colspan="4"><span style="font-weight: bold;"></span> </td>
                    </tr>
                </table>
            </td>
            <td colspan="7">
                <table>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;"></span> </td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;"></span> </td>
                    </tr>
                    <tr>
                        <td colspan="7"><span style="font-weight: bold;"></span> </td>
                    </tr>
                    <tr>
                        <td colspan="5"><span style="font-weight: bold;"></span> </td>
                        <td colspan="2"><span style="font-weight: bold;"></span> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="16">
                <!-- Concepto: OFICIO N° 0375-2023-P-CEPREUNA-PUNO/INVERSIONES EDUCATIVAS IESCOOP SAC/ARREND. DE AULAS PEDAGOGICAS  -->
                <span style="font-weight: bold;"></span><br><br>
                <br>
            </td>
        </tr>
    </table>
    <br><br>
    <table style="font-size:8px;" border="0">
        <tr style="text-align:center">
            <th colspan="4" style="font-weight: bold;"></th>
            <th colspan="4" style="font-weight: bold;"></th>
            <th colspan="22" style="font-weight: bold;"></th>
            <th colspan="5" style="font-weight: bold;"></th>
        </tr>
        <?php foreach ($elements as $item) { ?>
            <tr style="text-align:center">
                <td colspan="4" style="font-weight:bold;">{{$item["codigo"]}}</td>
                <td colspan="4" style="font-weight:bold;">{{$item["medida"]}}</td>
                <td colspan="22" style="text-align:left;"> <span style="font-weight: bold;">{{$item["descripcion_general"]}}</span>
                    <?php foreach ($item["descripciones"] as $desc) { ?>
                        <br> • {{$desc}}
                    <?php } ?>
                </td>
                <td colspan="5" style="text-align:right; font-weight:bold;"> {{ number_format($item["monto"], ($item["monto"] == intval($item["monto"]) ? 2 : 2), '.', ',') }}</td>
            </tr>
        <?php } ?>
    </table>
    <br><br>

</body>

</html>