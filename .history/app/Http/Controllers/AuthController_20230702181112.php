<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public $responseDTO;

    public function __construct(){
        $this->responseDTO = new ResponseDTO();   
    }


     /**
     * login.
     */
    public function login(Request $request)
    {
        
        $user = User::where('email', $request->email)->first();
        if(!$user){
            echo "user no encontrado";
        }
        $checkPassword = Hash::check($request->password, $user->password);
        if(!$checkPassword) {
           echo "password incorrecta";
        }
       
        //return $this->responseDTO->response(array('status' => 200, 'message' => 'Registro Guardado Correctamente'), $user);
    }
}


?>
