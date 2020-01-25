<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Treatment;
use App\Treatment_Price;
use App\Treatment_History;

class AdminTreatmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  GET ALL TREATMENT User
    public function getTreatmentUser(INT $id)
    {
        $result = Treatment_History::join('treatments', 'treatment_history.treatment_id', '=', 'treatments.id')
            ->select('treatments.id as treatment_id', 'treatments.*', 'treatment_history.*')
            ->where('treatment_history.branch_id',$id)
            ->orderBy('treatment_history.id', 'desc')
            ->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get All Treatment Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get All Treatment Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
            
    }

    // Get detail treatment
    public function getTreatmentUserDetail(INT $id)
    {
        $result = Treatment_History::join('treatments', 'treatment_history.treatment_id', '=', 'treatments.id')
            ->join('users', 'treatment_history.user_id','=','users.id')
            ->join('treatment_price', 'treatment_history.treatment_price_id', '=', 'treatment_price.id')
            ->select('treatments.id as treatment_id', 'treatments.*', 'treatment_history.*', 'users.fullname', 'treatment_price.treatment_price')
            ->where('treatment_history.id',$id)
            ->get();

        $res['status']  = true;
        $res['message'] = "Get Treatment Success";
        $res['result']  = $result;
        return response($res, 200);
    }

    
}