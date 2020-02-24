<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Support\Facades\Hash;

class Auth extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'password', 'api_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // MODEL Login User
    public function _LoginUser($data)
    {
        $check = User::where('user_id', $data['user_id'])->first();
        if ($check) {
            $pass = Hash::check($data['password'], $check->password);
            if ($pass) {
                    
                $token = sha1(time());
                $set_token = User::where('id', $check->id)->update(['api_token' => $token]);
                $data = User::join('branchs', 'users.branch_id', '=', 'branchs.id')
                    ->join('position', 'users.position_id', '=', 'position.id')
                    ->select('users.id as id_user', 'position.id as position_id', 'position.name as position_name', 'branchs.id as branch_id', 'users.*', 'branchs.*', 'position.*')
                    ->where('users.api_token', $token)
                    ->first();
                
                if ($set_token) {
                    
                    $res['status'] = true;
                    $res['message'] = "Login Success";
                    $res['result'] = $data;
                    return response($res, 200);
                } else {
                    $res['status'] = false;
                    $res['message'] = "Request Timeout";
                    $res['result'] = null;
                    return response($res, 400);
                }
            } else {
                $res['status'] = false;
                $res['message'] = "Password invalid";
                $res['result'] = null;
                return response($res, 400);
            }
        } else {
            $res['status'] = false;
            $res['message'] = "User ID Invalid";
            $res['result'] = null;
            return response($res, 400);
        }
    }

    // MODEL Pin Verivy
    public function _PinVerify($data)
    {
        
    }
}
