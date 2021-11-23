<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// import pedidoModel
use App\Models\PedidoModel;
// import product
use App\Models\Product;

class PedidoVentaModel extends Model
{
    use HasFactory;

    protected $table = 'pedidos_productos';
    protected $fillable = [
        'product_id',
        'pedido_id',
        'cantidad',
    ];


    public function pedidot() {
        return $this->belongsToMany(PedidoModel::class);
    }
    public function producto() {
        return $this->belongsToMany(Product::class);
    }
}
