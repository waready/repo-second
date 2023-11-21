<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = "contratos";
    protected $fillable = [
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
        'descripcion',
    ];
    //public $timestamps = false;
}
