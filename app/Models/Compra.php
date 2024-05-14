<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = "compras";
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
        'cccn',
        'valor_total'
    ];
    //public $timestamps = false;

    public function items()
    {
        return $this->hasMany(ComprasItem::class, 'compras_id');
    }
}
