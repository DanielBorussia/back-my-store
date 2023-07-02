<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\Products;

class ProductsController extends Controller
{
    public $responseDTO;

    public function __construct(){
        $this->responseDTO = new ResponseDTO();   
    }

    /**
     * Show the products.
     */
    public function index()
    {
        $products = Products::all();
        return $this->responseDTO->response(array('status' => 200, 'message' => 'OK'), $products);
    }
}


?>
