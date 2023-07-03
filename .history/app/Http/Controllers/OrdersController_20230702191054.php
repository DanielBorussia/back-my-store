<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\Orders;

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
