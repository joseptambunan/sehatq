<?php

namespace Modules\Access\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;

class AccessController extends Controller
{
    
    public function index()
    {
        return view('access::index');
    }

    public function login(Request $request){
        $credentials = $request->only('email','password');
        if (Auth::attempt($credentials)) {
            $user = User::find(Auth::user()->id);
            $user->updated_at = date("Y-m-d H:i:s");
            $user->save();
            
            $data['error_code'] = "200";
            $data['error_message'] = "Success Login";
            
        }else{
            $data['error_code'] = "401";
            $data['error_message'] = "Invalid Login";
        }

        echo json_encode($data);
    }

    public function profile(Request $request){
        $user = User::find($request->id);

        $data['error_code'] = "200";
        $data['error_message'] = $user;

        echo json_encode($data);
    }

    
}
