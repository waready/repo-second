<?php

namespace App\Http\Controllers\Intranet\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PDF;
use App\Models\Compra;
use App\Models\ComprasItem;
use App\VueTables\EloquentVueTables;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Spatie\Permission\Models\Permission;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;
use Symfony\Component\CssSelector\Parser\Shortcut\ElementParser;

class CompraServicioController extends Controller
{
    public function index()
    {
        $permissions = [];
        if (auth()->user()->hasRole('Super Admin')) {
            foreach (Permission::get() as $key => $value) {
                array_push($permissions, $value->name);
            }
        } else {
            foreach (Auth::user()->getAllPermissions() as $key => $value) {
                array_push($permissions, $value->name);
            }
        }

        $response['permisos'] = json_encode($permissions);
        return view('intranet.contabilidad.compra', $response);
    }

    public function lista(Request $request){
        $table = new EloquentVueTables;
        $data = $table->get(new Compra,[
            'id',
            'dni',
            "ruc",
            "cci",
            'num_os',
            'apellidos_nombres',
            'referencia',
            'domicilio',
            'departamento',
            'provincia',
            'distrito',
            'celular',
            'cuadro_adq',
            'tipo_proceso',
            'num_contrato',
            'moneda',
            'valor_total'
        ]);
   
        $response = $table->finish($data);
        return response()->json($response);
    }


    public function edit($id)
    {
        $response = Compra::with('items')->find($id);
        return $response;
    }

    public function delete($id)
    {
        $response = Compra::find($id);
        return $response->delete();
    }

    public function generar_pdf(Request $request)
    {
        $filename = 'demo.pdf';

        $data = $request->all();
        
        // dd($data);

        //$html = view()->make('intranet.contabilidad.ordenCompra', $data)->render();

        $pdf = new PDF;
        $pdf::SetTitle('ORDEN DE SERVICIO');
        $pdf::SetHeaderCallback(function ($pdf) use ($data) {
            $pdf->SetXY(0, 10);
            $pdf->Image('images/UNAPUNO.png', 20, 5, 20, 22, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            $pdf->Image('images/logo.png', 172, 8, 20, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            $html = view()->make('intranet.contabilidad.plantilla', $data)->render();
            $pdf->WriteHTML($html, true, false, true, false, '');

            $pageNumber = $pdf->getAliasNumPage();
            $totalPages = $pdf->getAliasNbPages();

            // Establecer la posición del número de página en la esquina del encabezado
            $pdf->SetFont('helvetica', '', 8);
            $pdf->SetXY(0, 0);
            $pdf->Cell(0, 10, " $pageNumber de $totalPages", 0, false, 'R', 0, '', 0, false, 'T', 'M');
            // $pdf->SetFont('helvetica', 'B', 12);
            // $pdf->Cell(10, 10, 'Mi Encabezado', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        // $pdf::SetMargins(10, 10, 10, 10);

        // $pdf::AddPage();
        // -------------------------------------------
        // $pdf::SetXY(0, 5);
        // $pdf::WriteHTML($html, true, false, true, false, '');
        $elements = new Collection($data['elements']);
        /** Ajuste de nombre de columnas, corregir para mejorar entendimiento para mantenimiento */
        $elements = $elements->map(function(&$row) {
            $row['precio_unitario'] = $row['medida'];
            $row['unidades'] = $row['codigo'];
            $row['monto'] = floatval($row['monto']);
            $row['precio_subtotal'] = floatval($row['unidades']) * floatval($row['precio_unitario']);
            return $row;
        });
        $totalMonto = $elements->sum('precio_subtotal');
        $cantidad = 6;
        $result = [];
        function generarPaginacion($superElements, $cantidad)
        {
            // return $suma;
            $totalPaginas =  ceil($superElements->count() / $cantidad);
            $result = [];
            $prev_total = 0;
            for ($i = 1; $i <= $totalPaginas; $i++) {
                $listaTemp1 = $superElements->forPage($i, $cantidad);
                array_push($result, [
                    'prev_total' => $prev_total,
                    'items' => $listaTemp1,
                    'total' => $listaTemp1->sum('precio_subtotal') + $prev_total,
                ]);
                $prev_total =  $prev_total + $listaTemp1->sum('precio_subtotal');
            }

            return $result;
        }

        $result = generarPaginacion($elements, $cantidad);


        // $itemsPerPage = 1; // Esto dependerá del tamaño de tus elementos.
        // $currentItemCount = 0;

        foreach ($result as $i => $lista) {
            // $totalMonto = 0;
            // foreach ($result[$i] as $elemento) {
            //     $monto = isset($elemento['monto']) ? (float) $elemento['monto'] : 0;
            //     $totalMonto += $monto;
            //     // dd($totalMonto);
            // }
            $pdf::SetXY(0, 5);
            $pdf::AddPage();

            // Renderizar elementos en la vista.
            $viewData = [
                'composeElement' => $lista,
                'total' => $totalMonto,
                //'sumaTotal' => $totalMonto,
                // Pasar otros datos necesarios a la vista...
            ];
            //dd($viewData);
            $html = view()->make('intranet.contabilidad.compraOrden', $viewData)->render();
            // $pdf::Cell(0, 40, array_sum($elements), 0, 1, 'C'); // Agregar un texto centrado
            $pdf::WriteHTML($html, true, false, true, false, '');
        }

        // -------------------------------------------
        $pdf::Output(public_path($filename), 'I');
    }

    public function importarCompras()
    {
        $permissions = [];
        if (auth()->user()->hasRole('Super Admin')) {
            foreach (Permission::get() as $key => $value) {
                array_push($permissions, $value->name);
            }
        } else {
            foreach (Auth::user()->getAllPermissions() as $key => $value) {
                array_push($permissions, $value->name);
            }
        }
        $response['permisos'] = json_encode($permissions);
        return view("intranet.contabilidad.importarCompras", $response);
    }

    public function importarCompra(Request $request)
    {
        
        $request->validate([
            'archivo_excel' => 'required|mimes:xls,xlsx',
        ]);

        $archivoExcel = $request->file('archivo_excel');

        $spreadsheet = IOFactory::load($archivoExcel);

        $hoja = $spreadsheet->getActiveSheet();

        // Obtener los datos de las filas de la hoja (omitir la primera fila de encabezados)
        // $filas = $hoja->toArray(null, true, true, true);
        // unset($filas[1]); // Omitir la primera fila (encabezados)
       // $filas = $hoja->rangeToArray('A10:Q' . $hoja->getHighestRow(), null, true, true, true);

        $filas = $hoja->toArray(null, true, true, true);
    
        // Omitir las primeras 10 filas (encabezados)
        $filas = array_slice($filas, 11);
        // Iniciar la transacción
        DB::beginTransaction();
        //return $filas;
        try {
            // Iterar sobre las filas para guardar los datos en la tabla "ingresantes"
            foreach ($filas as $fila) {
                Compra::create([
                    'dni' => $fila['B'],
                    'num_os' => $fila['C'],
                    'ruc' => $fila['D'],
                    'cci'=> $fila['E'],
                    'apellidos_nombres' => $fila['F'],
                    'referencia' => $fila['G'],
                    'domicilio' => $fila['H'],
                    'departamento' => $fila['I'],
                    'provincia' => $fila['J'],
                    'distrito' => $fila['K'],
                    'celular' => $fila['L'],
                    'cuadro_adq' => $fila['M'],
                    'tipo_proceso' => $fila['N'],
                    'num_contrato' => $fila['O'],
                    'moneda' => $fila['P'],
                    'valor_total' => $fila['Q'],
                    // 'codigo' => $fila['R'],
                    // 'pedido' => $fila['S'],
                    // 'unidad_medida' => $fila['T'],
                    // 'descripcion_general' => $fila['U'],
                    // 'descripcion' => $fila['V'],
                    'created_at' => now(),
                    'updated_at' => now() // Cambiar 'E' por la letra de la columna del campo fecha_examen en el archivo de Excel
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Redireccionar a la vista de importación con un mensaje de éxito
            return redirect()->back()->with('success', 'Datos importados correctamente.');
        } catch (\Exception $e) {
            DB::rollback();

            return redirect()->back()->with('error', 'Error al importar los datos: ' . $e->getMessage());
        }
    }

    public function importarItems(Request $request, $id)
    {
        // Validar el archivo de Excel cargado
        $request->validate([
            'archivo_excel' => 'required|mimes:xls,xlsx',
        ]);
    
        try {
            // Obtener el archivo cargado
            $archivoExcel = $request->file('archivo_excel');
    
            // Cargar el archivo de Excel con PhpSpreadsheet
            $spreadsheet = IOFactory::load($archivoExcel);
    
            // Obtener la hoja activa del archivo (suponiendo que solo hay una hoja)
            $hoja = $spreadsheet->getActiveSheet();
    
            // Obtener todas las filas del archivo Excel
            $filas = $hoja->toArray(null, true, true, true);
    
            // Omitir las primeras 10 filas (encabezados)
            $filas = array_slice($filas, 11);
    
            // Iniciar la transacción
            DB::beginTransaction();
    
            // Iterar sobre las filas para guardar los datos en la tabla "compras_items"
            foreach ($filas as $fila) {
                ComprasItem::create([
                    'codigo' => $fila['A'],
                    'pedido' => $fila['B'],
                    'unidad_medida' => $fila['C'],
                    'descripcion_general' => $fila['D'],
                    'descripcion' => $fila['E'],
                    'compras_id' => $id, // Asignar el id de la compra actual
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
    
            // Confirmar la transacción
            DB::commit();
    
            // Devolver una respuesta JSON con un mensaje de éxito
            return response()->json(['status' => true, 'message' => 'Datos importados correctamente.']);
        } catch (\Exception $e) {
            // Si ocurre algún error, revertir la transacción
            DB::rollback();
    
            // Devolver una respuesta JSON con un mensaje de error
            return response()->json(['status' => false, 'message' => 'Error al importar los datos: ' . $e->getMessage()]);
        }
    }
}
