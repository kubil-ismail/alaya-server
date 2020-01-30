<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Absent;

class AbsentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // Get detail treatment
    public function addAbsent(Request $request)
    {
        $this->validate($request, [
            'user_id'       => 'required|numeric',
            'position_id'   => 'required|numeric',
            'branch_id'     => 'required|numeric',
            'absent_time'   => 'required|string',
            'latitude'      => 'required|string',
            'longitude'     => 'required|string',
            'absent_status' => 'required|string'
        ]);
        
        $data['user_id']        = $request->input('user_id');
        $data['position_id']    = $request->input('position_id');
        $data['branch_id']      = $request->input('branch_id');
        $data['absent_time']    = $request->input('absent_time');
        $data['absent_date']    = date('d/m/Y');
        $data['latitude']       = $request->input('latitude');
        $data['longitude']      = $request->input('longitude');
        $data['absent_status']  = $request->input('absent_status');

        $add = new Absent();
        return $add->_CreateAbsent($data);
    }

    // Get History User
    public function getAbsentHistory($id) 
    {
        $result = Absent::join('users', 'absents.user_id', '=', 'users.id')
            ->where('absents.user_id', $id)
            ->where('absent_status',1)
            ->select('absents.*', 'users.fullname')
            ->orderBy('absents.id', 'DESC')
            ->get();

        $res['status']  = true;
        $res['message'] = "Get Absent Success";
        $res['result']  = $result;
        return response($res, 200);
    }

    // Get Detail
    public function getSelectedAbsentHistory($id)
    {
        $result = Absent::join('users', 'absents.user_id', '=', 'users.id')
            ->join('branchs','absents.branch_id','branchs.id')
            ->where('absents.id', $id)
            ->select('absents.*', 'users.fullname', 'users.user_id', 'branchs.address')
            ->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get Absent History Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get Absent History Failed";
            $res['result']  = $result;
            return response($res, 200);
        }
            

    }

}
