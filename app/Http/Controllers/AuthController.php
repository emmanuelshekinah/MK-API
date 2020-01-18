<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AuthController extends Controller
{
    public function auth(Request $request)
    {
        $data = DB::select('SELECT * FROM `users` WHERE `email`="'.$request->email.'" AND `password`="'.bcrypt($request->password).'"');
       
        if(count($data)>0)
        {
            
            return $this->respose("true", $data[0]->id);
        }
        else
        {
            return $this->respose("true", 1);

            // return $this->respose("false", "Access Denied");
        }
    }

    public function respose($respose, $message)
    {
        return '
            {
              "response":"'.$respose.'",
              "message":"'.$message.'"
            }
            ';
    }
}
