<?php

namespace App\Http\Controllers\Intranet\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Spatie\Permission\Models\Permission;
use App\VueTables\EloquentVueTables;
use App\Models\Contrato;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Support\Facades\DB;

class OrdenSolicitudController extends Controller
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
        return view('intranet.contabilidad.servicio', $response);
    }

    public function lista(Request $request){
        $table = new EloquentVueTables;
        $data = $table->get(new Contrato,[
            'id',
            'dni',
            "ruc",
            "cci",
            "descripcion_general",
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
            'valor_total',
            'codigo',
            'pedido',
            'unidad_medida',
            'descripcion'
        ]);
   
        $response = $table->finish($data);
        return response()->json($response);
    }

    public function generar_pdfAll(Request $request)
    {

        //$filename = 'demo.pdf';

        //$data = $request->all();
        //return $data;

        $datos = Contrato::all();
        $length = 10; // longitud de la cadena
        $filename = 'pedido_' . bin2hex(random_bytes($length)) . '.pdf';
        
        foreach ($datos as $data) {
            // return $data;
            $data = [
                'data' => $data  // Puedes ajustar esto según cómo se llame la variable en tu vista
            ];

            $html = view()->make('intranet.contabilidad.pdfOrdenAllSolicitud', $data)->render();

            $pdf = new PDF;

            $pdf::SetTitle('ORDEN DE SERVICIO');
            $pdf::SetHeaderCallback(function ($pdf) {
                $pdf->SetXY(100, 100);
                $pdf->Image('images/UNAPUNO.png', 20, 5, 20, 22, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
                $pdf->Image('images/logo.png', 172, 8, 20, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
                // $pdf->SetFont('helvetica', 'B', 12);
                // $pdf->Cell(10, 10, 'Mi Encabezado', 0, false, 'C', 0, '', 0, false, 'T', 'M');
            });
            $pdf::SetMargins(10, 10, 10, 10);
            $pdf::AddPage();
            $pdf::SetFont('helvetica', '', 8);
            $pdf::SetLineWidth(0.5);
            $pdf::Rect(125, 22, 20, 6, 'D');  // Dibujar un rectángulo con bordes
            // $pdf::Text(20, 20, 'Texto con borde');

            // $pdf::SetXY(100, 100);
            // $pdf::Cell(100, 3, 'Texto con bordes', 1, 1, 'L');
            $pdf::WriteHTML($html, true, false, true, false, '');
        }
        $pdf::Output(public_path($filename), 'I');
    }

    public function generar_pdf(Request $request)
    {

        //$filename = 'demo.pdf';

        $data = $request->all();
        //return $data;

        //$datos = Contrato::all();
        $length = 10; // longitud de la cadena
        $filename = 'pedido_' . bin2hex(random_bytes($length)) . '.pdf';
        
        $html = view()->make('intranet.contabilidad.pdfOrdenSolicitud', $data)->render();

        $pdf = new PDF;

        $pdf::SetTitle('ORDEN DE SERVICIO');
        $pdf::SetHeaderCallback(function ($pdf) {
            $pdf->SetXY(100, 100);
            $pdf->Image('images/UNAPUNO.png', 20, 5, 20, 22, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            $pdf->Image('images/logo.png', 172, 8, 20, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
            // $pdf->SetFont('helvetica', 'B', 12);
            // $pdf->Cell(10, 10, 'Mi Encabezado', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        });
        $pdf::SetMargins(10, 10, 10, 10);
        $pdf::AddPage();
        $pdf::SetFont('helvetica', '', 8);
        $pdf::SetLineWidth(0.5);
        $pdf::Rect(125, 22, 20, 6, 'D');  // Dibujar un rectángulo con bordes
        // $pdf::Text(20, 20, 'Texto con borde');

        // $pdf::SetXY(100, 100);
        // $pdf::Cell(100, 3, 'Texto con bordes', 1, 1, 'L');
        $pdf::WriteHTML($html, true, false, true, false, '');

        $pdf::Output(public_path($filename), 'I');
    }

    public function importarContratos()
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
        return view("intranet.contabilidad.importarContratos", $response);
    }
    
    public function importar(Request $request)
    {
        
        // Validar el archivo de Excel cargado
        $request->validate([
            'archivo_excel' => 'required|mimes:xls,xlsx',
        ]);

        // Obtener el archivo cargado
        $archivoExcel = $request->file('archivo_excel');

        // Cargar el archivo de Excel con PhpSpreadsheet
        $spreadsheet = IOFactory::load($archivoExcel);

        // Obtener la hoja activa del archivo (suponiendo que solo hay una hoja)
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
                contrato::create([
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
                    'codigo' => $fila['R'],
                    'pedido' => $fila['S'],
                    'unidad_medida' => $fila['T'],
                    'descripcion_general' => $fila['U'],
                    'descripcion' => $fila['V'],
                    'created_at' => now(),
                    'updated_at' => now() // Cambiar 'E' por la letra de la columna del campo fecha_examen en el archivo de Excel
                ]);
            }

            // Confirmar la transacción
            DB::commit();

            // Redireccionar a la vista de importación con un mensaje de éxito
            return redirect()->back()->with('success', 'Datos importados correctamente.');
        } catch (\Exception $e) {
            // Si ocurre algún error, revertir la transacción
            DB::rollback();

            // Redireccionar a la vista de importación con un mensaje de error
            // return redirect()->back()->with('error', 'Error al importar los datos: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al importar los datos: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        $response = Contrato::find($id);
        return $response;
    }

    public function delete($id)
    {
        $response = Contrato::find($id);
        return $response->delete();
    }
}
