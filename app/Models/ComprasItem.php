<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComprasItem extends Model
{
    protected $table = "compras_items";
    protected $fillable = [
        'codigo',
        'pedido',
        'unidad_medida',
        'descripcion_general',
        'descripcion',
        'compras_id',
    ];
    
     // Relación con el modelo Compras
     public function compra()
     {
        return $this->belongsTo(Compras::class, 'compras_id');
     }
}
