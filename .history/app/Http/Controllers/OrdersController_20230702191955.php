<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\Orders;
use App\Models\ProductsOrders;
use App\Models\Products;

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
            return $this->responseDTO->response(array('status' => 200, 'message' => 'OK'), null);
        }
        for ($i=0; $i < count($orders) ; $i++) { 
            $order = $orders[$i];
            $productsOrders = ProductsOrders::where("idOrder", $order->id)->get();
            for ($w=0; $w <count($productsOrders) ; $w++) { 
                $product = $productsOrders[$w];
                $productData = Products::where("id", $product->id)->first();
                $productsOrders[$w] = $productData;
            }
            $order->products = $productsOrders;
        }
        return $this->responseDTO->response(array('status' => 200, 'message' => 'OK'), $orders);
    }

     /**
     * Create the product.
     */
    public function store(Request $request)
    {
        $product = new Products;
        $product->name = $request->name;
        $product->image = $request->image;
        $product->price = $request->price;
        $product->save();
        return $this->responseDTO->response(array('status' => 200, 'message' => 'Registro Guardado Correctamente'), $product);
    }
}


?>
