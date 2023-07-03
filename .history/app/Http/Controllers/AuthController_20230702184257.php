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
            return $this->responseDTO->response(array('status' => 400, 'message' => 'Usuario no encontrado'), null);
        }
        $checkPassword = Hash::check($request->password, $user->password);
        if(!$checkPassword) {
            return $this->responseDTO->response(array('status' => 400, 'message' => 'Clave incorrecta'), $user);
        }
        $token = $user->createToken('auth_token')->plainTextToken;
        $payload = [
            "user" => $user,
            "token" => $token
        ];
       
        return $this->responseDTO->response(array('status' => 200, 'message' => 'Login Correctamente'), $payload);
    }

    public function logout(){
        echo "millos";
    }
}


?>
