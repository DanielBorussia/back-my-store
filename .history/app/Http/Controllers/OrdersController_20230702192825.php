<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\Orders;
use App\Models\ProductsOrders;
use Illuminate\Support\Str;

class OrdersController extends Controller
{
    public $responseDTO;

    public function __construct(){
        $this->responseDTO = new ResponseDTO();   
    }

    /**
     * Show the orders by id User.
     */
    public function show($idUser)
    {
        $orders = Orders::where("idUser", $idUser)->first();
        if(!$orders){
            return $this->responseDTO->response(array('status' => 200, 'message' => 'No hay pedidos'), null);
        }
        for ($i=0; $i < count($orders) ; $i++) { 
            $order = $orders[$i];
            $products = ProductsOrders::where("idOrder", $order->id)->get();
            $order->products = $products;
        }
        return $this->responseDTO->response(array('status' => 200, 'message' => 'OK'), $orders);
    }

     /**
     * Create the order.
     */
    public function store(Request $request)
    {
        $products = $request->products;
        $order = new Orders;
        $order->idUser = $request->idUser;
        $order->total = $request->total;
        $order->code = Str::random(10);
        $order->save();

        for ($i=0; $i <count($products) ; $i++) { 
            $product = $products[i];
            $productDB = new ProductsOrders;
            $productDB->idOrder = $order->id;
            $productDB->idProduct = $product->id;
            $productDB->name = $product->name;
            $productDB->image = $product->image;
            $productDB->price = $product->price;
            $productDB->save();
        }

        return $this->responseDTO->response(array('status' => 200, 'message' => 'Registro Guardado Correctamente'), $order);
    }
}


?>
