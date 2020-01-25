<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'photo', 'fullname','phone', 'password', 'address', 'position_id', 'branch_id', 'api_token','pin'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    protected $dates = ['deleted_at'];

    // MODEL Create New User
    public function _CreateUser($data)
    {
        $checkID = User::where('user_id', $data['user_id'])->first();

        if (!$checkID) {
            $register = User::create([
                'user_id' => $data['user_id'],
                'photo' => 'default.png',
                'fullname' => $data['fullname'],
                'phone' => $data['phone'],
                // 'email' => $data['email'],
                'pin' => $data['pin'],
                'password' => $data['password'],
                'address' => $data['address'],
                'position_id' => $data['position_id'],
                'branch_id' => $data['branch_id'],
                'api_token' => null
            ]);

            if ($register) {
                $res['status'] = true;
                $res['message'] = "Register Success";
                $res['result'] = $register;
                return response($res,200);
            } else {
                $res['status'] = false;
                $res['message'] = "Regist Failed";
                $res['result'] = null;
                return response($res,400);
            }
        } else {
            $res['status'] = false;
            $res['message'] = "User ID Already Exits";
            $res['result'] = null;
            return response($res, 400);
        }
    }

    // DELETE ONE USER
    public function _DeleteUser($id) {
        $delete = User::where('id', $id)->first();
        $delete->delete();

        if ($delete) {
            $res['status'] = true;
            $res['message'] = "Delete Success";
            $res['result'] = $delete;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Request Time Out";
            $res['result'] = null;
            return response($res, 400);
        }
    }

    // EDIT USER
    public function _EditUser($data)
    {
        $users = User::find($data['id']);
        $users->user_id = $data['user_id'];
        $users->fullname = $data['fullname'];
        $users->phone = $data['phone'];
        $users->pin = $data['pin'];
        $users->password = $data['password'];
        $users->address = $data['address'];
        $users->position_id = $data['position_id'];
        $users->branch_id = $data['branch_id'];
        $users->save();

        if ($users) {
            $res['status'] = true;
            $res['message'] = "Edit User Success";
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Edit User Failed";
            return response($res, 400);
        }
    }
}
