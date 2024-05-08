<?php

namespace App\Http\Controllers\Intranet\Contabilidad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use PDF;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Spatie\Permission\Models\Permission;
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
}
