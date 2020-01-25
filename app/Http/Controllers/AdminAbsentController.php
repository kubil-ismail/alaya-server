<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Absent;

class AdminAbsentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  GET ALL Absent User
    public function getAbsentUser(INT $id)
    {
        $result = Absent::join('users','absents.user_id','=','users.id')
                    ->join('branchs','absents.branch_id','=','branchs.id')
                    ->select('absents.*', 'users.*','absents.id as id','branchs.branch_name')
                    ->orderBy('absents.id','desc')
                    ->where('absents.branch_id',$id)->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get All Absent Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get All Absent Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
    }

    // Get detail Absent
    public function getAbsentUserDetail(INT $id)
    {
        $result = Absent::join('users', 'absents.user_id', '=', 'users.id')
            ->join('branchs', 'absents.branch_id', '=', 'branchs.id')
            ->join('position', 'absents.position_id','=', 'position.id')
            ->select('absents.*', 'users.*', 'absents.id as id', 'branchs.branch_name', 'position.name as position_name', 'branchs.open_hour as open_hour')
            ->where('absents.id', $id)->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get Absent Detail Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get Absent Detail Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
    }
}
