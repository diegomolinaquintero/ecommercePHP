<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// import PedidoVentaModel
use App\Models\PedidoVentaModel;

class PedidoModel extends Model
{
    use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'pedidos';
    protected $primaryKey = 'id';
    protected $fillable = [
        
        'email',
    ];

    public function PedidoVenta() {
        return $this->belongsToMany(PedidoVentaModel::class);
    }

}
