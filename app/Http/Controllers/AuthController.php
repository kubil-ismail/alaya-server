<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Auth;

class AuthController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //Login User
    public function login(Request $request)
    {
        $this->validate($request, [
            'user_id'     => 'required|numeric',
            // 'email' => 'required|string',
            'password'    => 'required|string'
        ]);

        $data['user_id'] = $request->input('user_id');
        // $data['email'] = $request->input('email');
        $data['password'] = $request->input('password');

        $login = new Auth();
        return $login->_LoginUser($data);
    }

    // Pin Verify
    public function pin_verify(Request $request) 
    {
        $this->validate($request,[
            'pin' => 'required|numeric'
        ]);

        $data['pin'] = $request->input('pin');

        $login = new Auth();
        return $login->_PinVerify($data);
    }
}
