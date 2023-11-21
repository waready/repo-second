<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOLA HOLA</title>
</head>
<body>
    <!-- <h1 style="color:red; margin-left: 20%; font-weight:bold;">{{$title}}</h1> -->
    <h1 style="text-align:center">PEDIDO DE SERVICIO N° <span style="font-size:15px;">00249</span> </h1>
    <br>
    <table >
        <tr><td>Dirección Solicitante</td><td colspan="3">: CPBS CENTRO PREUNIVERSITARIO</td></tr>
        <tr><td>Entregar a Sr(a)</td><td colspan="3">: FLORES CHIPANA GAVINO JOSE</td></tr>
        <tr><td>Fecha</td><td colspan="3">: 20/03/2023</td></tr>
        <tr><td>Actividad Operativa</td><td colspan="3">: C0149 ADMINISTRACION Y GESTION -RDR</td></tr>
        <tr><td>Motivo</td><td colspan="3" style="font-size:7px">: OFICIO N° 0375-2023-P-CEPREUNA-PUNO, ARRENDAMIENTO DE AULAS PEDAGOGICAS PARA EL DESARROLLO DE SERVICIOS EDUCATIVOS PRESENCIALES EN LA CIUDAD DE JULIACA, CICLO ACADEMICO ABRIL-JULIO 2023</td></tr>
    </table>
    <br>
    <br>
    <table style="font-size:10px; text-align:center;" border="0.1">
        <tr><th colspan="2">FF/Rb</th><th colspan="4">META/MNEMONICO</th><th colspan="2">Función</th><th colspan="3">División Func.</th><th colspan="3">Grupo Func.</th><th colspan="2">Programa</th><th colspan="2">Prod/Pry</th><th colspan="3">Act/Ai/Obr</th></tr>
        <tr><td colspan="2">2-09</td><td colspan="4">0041</td><td colspan="2">22</td><td colspan="3">048</td><td colspan="3">0109</td><td colspan="2">9002</td><td colspan="2">3999999</td><td colspan="3">5001888</td></tr>
    </table>
    <br><br>
    <table style="border:solid 0.1px black; font-size:10px; text-align:center;">
        <tr><th colspan="2">Código</th><th colspan="6">Descripción / Terminos de Referencia</th><th colspan="2">Clasificador</th><th colspan="2">Valor S/.</th><th colspan="2">Unidad Medida</th></tr>
    </table>
    <table style="font-size:8px;">
        <tr><td colspan="2">940500040027</td><td colspan="6">ALQUILER DE LOCAL</td><td colspan="2">2.3. 2 5. 1 1</td><td colspan="2">21,200.00</td><td colspan="2">SERVICIO</td></tr>
        <br>
        <tr><td colspan="2"></td><td colspan="3">1. DENOMINACION DE LA CONTRATACION</td><td colspan="6">SERVICIO DE ARRENDAMIENTO DE AULAS PEDAGOGICAS PARA EL DESARROLLO DE SERVICIOS EDUCATIVOS PRESENCIALES PARA EL AREA DE BIOMEDICAS Y SOCIALES</td><td colspan="3"></td></tr>
        <br>
        <tr><td colspan="2"></td><td colspan="3">2. FINALIDAD PUBLICA</td><td colspan="6">DESARROLLO DE CLASES PRESENCIALES A LOS PARTICIPANTES EN PREPARACION PRE UNIVERSITARIA</td><td colspan="3"></td></tr>
        <br>
        {{-- <tr><td colspan="2"></td><td colspan="9">
            <table border="1">
                <tr><td colspan="5" rowspan="2">3. OBJETIVOS DE LA CONTRATACION</td><td colspan="10">-PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES.</td></tr>
                <tr><td colspan="5"></td><td colspan="10">-PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES.</td></tr>
            </table></td><td colspan="3"></td>
        </tr> --}}
        <tr><td colspan="2"></td><td colspan="3">3. OBJETIVOS DE LA CONTRATACION</td><td colspan="6">
        <ul>
            <li>-PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES.</li>
            <li>-PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES.</li>
            <li>-PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES.</li>
        </ul></td><td colspan="3"></td></tr>
        <br>
        <tr><td colspan="2"></td><td colspan="3">1. DENOMINACION DE LA CONTRATACION</td><td colspan="6">SERVICIO DE ARRENDAMIENTO DE AULAS PEDAGOGICAS PARA EL DESARROLLO DE SERVICIOS EDUCATIVOS PRESENCIALES PARA EL AREA DE BIOMEDICAS Y SOCIALES</td><td colspan="3"></td></tr>
        <br>
        
    </table> 
    <!-- ------------------------------------------Solicitud de cotizacion--------------------------------------------------------- -->
    {{-- <h1 style="text-align:center">SOLICITUD DE COTIZACION N° <span style="font-size:15px; font-style:italic;">00249</span> </h1>
    <table style="font-size:10px">
        <tr>
            <td >UNIDAD EJECUTORA</td>
            <td colspan="3">: 001 UNIVERSIDAD NACIONAL DEL ALTIPLANO</td>
        </tr>
        <tr>
            <td >NRO. IDENTIFICACION</td>
            <td colspan="3">: 000098</td>
        </tr>
        <tr>
            <td >NRO. E/M</td>
            <td colspan="3">: 00187</td>
        </tr>
    </table>
    <table style="border:solid 0.1px black; font-size:10px;">
        <tr>
            <td colspan="2">Señores</td>
            <td colspan="7">:</td>
            <td colspan="3">RUC     :</td>
        </tr>
        <tr>
            <td colspan="2">Dirección:</td>
            <td colspan="7">:</td>
            
        </tr>
        <tr>
            <td colspan="12"></td>
        </tr>
        <tr>
            <td colspan="2">Teléfono</td>
            <td colspan="10">:</td>
        </tr>
        <tr>
            <td colspan="2">Email</td>
            <td colspan="4">:</td>
            <td colspan="3">Fecha   :</td>
            <td colspan="3">Moneda     : S/.</td>
        </tr>
        <tr>
            <td colspan="2">Concepto</td>
            <td colspan="10" style="font-size:7px">: OFICIO N° 0375-2023-P-CEPREUNA-PUNO, ARRENDAMIENTO DE AULAS PEDAGOGICAS PARA EL DESARROLLO DE S</td>
        </tr>
    </table>
    <br>
    <br>
    <table style="font-size:10px;" border="0.1px">
        <tr style="text-align:center; font-weight:bold;">
            <th colspan="2">UNIDAD MEDIDA</th>
            <th colspan="2">ITEM</th>
            <th colspan="10">DESCRIPCION</th>
            <th colspan="2">VALOR TOTAL</th>
        </tr>
        <tr style="font-size:8.5px">
            <td colspan="2">SERVICIO</td>
            <td colspan="2">940500040027</td>
            <td colspan="10">ALQUILER DE LOCAL<br>ESPECIFICACIONES TECNICAS: 
                <ol>
                    <li>DENOMINACION DE LA CONTRATACION: SERVICIO DE ARRENDAMIENTO DE AULAS PEDAGOGICAS PARA EL DESARROLLO DE SERVICIOS EDUCATIVOS PRESENCIALES PARA EL AREA DE BIOMEDICAS Y SOCIALES</li>
                    <li>FINALIDAD PUBLICA: DESARROLLO DE CLASES PRESENCIALES A LOS PARTICIPANTES EN PREPARACION PRE UNIVERSITARIA</li>
                    <li>OBJETIVOS DE LA CONTRATACION: PROPORCIONAR SERVICIOS EDUCATIVOS PRESENCIALES PARA PARTICIPANTES DEL AREA DE BIOMEDICAS Y SOCIALES. -DOTAR DE INFRAESTRUCTURA ADECUADA PARA LAS CLASES PRESENCIALES A LOS PARTICIPANTES DEL CEPREUNA</li>
                    <li>ALCANCES Y DESCRIPCION DEL SERVICIO: CARACTERISTICAS TECNICAS: -CANTIDAD DE AULAS: 13 -CAPACIDAD DE ESTUDIANTES POR AULA: DE 40 A 45 ESTUDIANTES. CON MOBILIARIO PEDAGOGICO DEBIDAMENTE EQUIPADO NOTA: LA CANTIDAD DE AULAS A CONTRATAR PUEDE VARIAR DE ACUERDO A LA NECESIDAD DEL CEPREUNA</li>
                    <li>SERVICIOS ADICIONALES: LOS LOCALES DEBERAN CONTAR CON SERVICIOS BASICOS COMO LUZ, AGUA</li>
                    <li>LUGAR: JULIACA PLAZO DE EJECUCION: 3 MESES PUDIENDO VARIAR EL PLAZO DE EJECUCION.</li>
                </ol>
            </td>
            <td colspan="2"></td>
        </tr>
        <tr>
            <td colspan="14" style="text-align:right; font-weight:bold;">TOTAL</td>
            <td colspan="2"></td>
        </tr>
    </table>
    <table style="font-size:9px;">
        <tr><td>Las cotizaciones a valores referenciales deben estar dirigidos a UNIVERSIDAD NACIONAL DEL ALTIPLANO</td></tr>
    </table>
    <table style="font-size:8px;">
        <tr>
            <td style="font-weight:bold;">
                Condiciones de Compra <br>
                -Forma de Pago: <br>
                -Garantia: <br>
                -Plazo de Entrega en N° Días/Ejecución del Servicio: <br>
                -Tipo de Moneda: <br>
                -Validez de la cotizacion: <br>
                -Indicar Marca de Procedencia <br>
                -Tipo de Cambio: <br>
            </td>
            <td>
                Requerimientos Técnicos: <br>
                Descripción del Servicio <br>
            </td>
        </tr>
    </table>
    <br>
    <br>
    <span style="font-size:9px;">Atentamente;</span> --}}
    

</body>
</html>