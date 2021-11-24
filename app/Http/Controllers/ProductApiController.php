<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;
// import validator
use Illuminate\Support\Facades\Validator;

// import pedidoModel
use App\Models\PedidoModel;
use App\Models\PedidoVentaModel;
use PhpParser\Node\Stmt\TryCatch;

class ProductApiController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api')->only(['getById']);
        //$this->middleware(['client.credentials'])->only(['index']);
    }

    public function index() {
        $products = Product::with(['Category', 'Brand', 'Seller'])->get();
        return response()->json($products, 200);
    }

    public function getById($id) {
        $product = Product::with(['Category', 'Brand', 'Seller'])
                            ->where('id', $id)    
                            ->first();

        if (empty($product)) {
            return response()->json(['message' => 'Not Found'], 404);
        }      

        return response()->json($product, 200);
    }

    public function pedido(Request $request)
    {
        $input = (object) $request->all();
        
        $array_files_validacion = [
            'email' => ['required', 'email'],
            'producto' => ['array'],
            'producto.*.product_id' => ['required', 'numeric'],
            'producto.*.cantidad' => ['required', 'numeric'],
            
        ];

        
        $validator = Validator::make((array) $input, $array_files_validacion);
        // dd($validator);

        if ($validator->fails()) {
            return response()->json('Revisar'.' - '.$validator->errors(), 200);

        }

        try {
            $pedido = new PedidoModel();
            $pedido->email = $request->email;
            if($pedido->save()) {
                if(isset($input->producto)){
                    // dd($input->producto);
                    if(count($input->producto) > 0){
                        foreach ($input->producto as $pedido_producto){
                            // $pedido_id = $pedido->id; 
                            // dd($pedido->id);
                            $productofind = Product::where('id', $pedido_producto['product_id'])->first();
    
                            if($productofind->inventory < $pedido_producto['cantidad']){
                                return response()->json('No hay suficiente inventario de '.$productofind->name , 200);
                            }else {
                                $productofind->inventory = $productofind->inventory - $pedido_producto['cantidad'];
                                $productofind->save();
                            }
    
                            $pedido_product = (new PedidoVentaModel())->forceFill([
                                'pedido_id' => $pedido->id,
                                'product_id' => $pedido_producto['product_id'],
                                'cantidad' => $pedido_producto['cantidad'],
                            ]);
                            $pedido_product->save();
                            // $user = User::create($request->all());
                        }
                        return response()->json('Se guardo correctamente', 200);
                    }
                }else {
                    return response()->json('No ingreso producto', 200);
                }    
            } else {
                return response()->json('No se guardo verifica el correo', 200);
            }
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json('No se guardo ningun cambio al sistema'.$th, 200);
        }
        

    }
}
