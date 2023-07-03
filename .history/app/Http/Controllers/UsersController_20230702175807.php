<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Utils\ResponseDTO;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public $responseDTO;

    public function __construct(){
        $this->responseDTO = new ResponseDTO();   
    }


     /**
     * Create the user.
     */
    public function store(Request $request)
    {
        echo "user";
        $user = new User;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        return $this->responseDTO->response(array('status' => 200, 'message' => 'Registro Guardado Correctamente'), $user);
    }
}


?>
