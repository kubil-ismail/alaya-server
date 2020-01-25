<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Register new user
    public function register(Request $request)
    {
        $this->validate($request, [
            'user_id'     => 'required|string',
            'fullname'     => 'required|string',
            'phone'     => 'required|string',
            // 'email'     => 'required|email',
            'pin'     => 'required|string',
            'password'     => 'required|string',
            'address'     => 'required|string',
            'position_id'     => 'required|string',
            'branch_id' => 'required|string'
        ]);

        $data['user_id'] = $request->input('user_id');
        $data['fullname'] = $request->input('fullname');
        $data['phone'] = $request->input('phone');
        // $data['email'] = $request->input('email');
        $data['pin'] = $request->input('pin');
        $data['password'] = Hash::make($request->input('password'));
        $data['address'] = $request->input('address');
        $data['position_id'] = $request->input('position_id');
        $data['branch_id'] = $request->input('branch_id');

        $register = new User();
        return $register->_CreateUser($data);
    }

    // Get All User
    public function getAllUser()
    {
        $result = User::join('branchs', 'users.branch_id', '=', 'branchs.id')
            ->join('position', 'users.position_id', '=', 'position.id')
            ->select('users.id as id_user', 'position.id as position_id', 'position.name as position_name', 'branchs.id as branch_id', 'users.*', 'branchs.*', 'position.*')
            ->get();

        $res['status'] = true;
        $res['message'] = "Get All User Success";
        $res['result'] = $result;
        return response($res, 200);
    }

    // Get Select User
    public function getSelectUser($id)
    {
        $result = User::join('branchs', 'users.branch_id', '=', 'branchs.id')
            ->join('position', 'users.position_id', '=', 'position.id')
            ->select('users.id as id_user', 'position.id as position_id', 'position.name as position_name', 'branchs.id as branch_id', 'users.*', 'branchs.*', 'position.*')
            ->where('users.id',$id)
            ->get();

        if ($result) {
            $res['status'] = true;
            $res['message'] = "Get User Success";
            $res['result'] = $result;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "User could not be found";
            $res['result'] = $result;
            return response($res, 400);
        }
    }

    // Delete One User
    public function deleteOneUser(INT $id)
    {
        $delete = new User();
        return $delete->_DeleteUser($id);
    }

    // Update One User 
    public function updateOneUser(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required|numeric' ,
            'user_id'       => 'required|string',
            'fullname'      => 'required|string',
            'phone'         => 'required|string',
            // 'email'      => 'required|email',
            'pin'           => 'required|string',
            'password'      => 'required|string',
            'address'       => 'required|string',
            'position_id'   => 'required|string',
            'branch_id'     => 'required|string'
        ]);

        $data['id'] = $request->input('id');
        $data['user_id'] = $request->input('user_id');
        $data['fullname'] = $request->input('fullname');
        $data['phone'] = $request->input('phone');
        $data['pin'] = $request->input('pin');
        $data['password'] = Hash::make($request->input('password'));
        $data['address'] = $request->input('address');
        $data['position_id'] = $request->input('position_id');
        $data['branch_id'] = $request->input('branch_id');

        $update = new User();
        return $update->_EditUser($data);    
    }
}
