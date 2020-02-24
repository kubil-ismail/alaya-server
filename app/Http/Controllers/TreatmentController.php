<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Treatment;
use App\Treatment_Price;
use App\Treatment_History;

class TreatmentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  GET ALL TREATMENT
    public function getTreatment()
    {
        $result = Treatment::join('treatment_price', 'treatments.id', '=', 'treatment_price.treatment_id')
                ->select('treatment_price.id as treatment_price_id', 'treatments.id as treatment_id', 'treatments.*', 'treatment_price.*')
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

    public function getSelectedTreatment($id) {
        $result = Treatment::join('treatment_price', 'treatments.id', '=', 'treatment_price.treatment_id')
            ->select('treatments.*', 'treatment_price.*','treatment_price.id as treatment_price_id', 'treatments.id as treatment_id')
            ->where('treatments.id',$id)
            ->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get Treatment Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get Treatment Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
    }

    // GET JUST NAME AND DESC TREATMENT
    public function getTreatmentList()
    {
        $result = Treatment::all();

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

    // CREATE NEW TREATMENT
    public function addTreatment(Request $request)
    {
        $this->validate($request, [
            'treatment_name'     => 'required|string',
            'treatment_desc'     => 'required|string'
        ]);

        $data['treatment_name']  = $request->input('treatment_name');
        $data['treatment_desc']  = $request->input('treatment_desc');

        $add = new Treatment();
        return $add->_CreateTreatment($data);
    }

    // Delete One Treatment price
    public function deleteOneTreatment(INT $id)
    {
        $delete = new Treatment_Price();
        return $delete->_DeleteTreatment($id);
    }

    // CREATE NEW TREATMENT
    public function addTreatmentPrice(Request $request)
    {
        $this->validate($request, [
            'treatment_id'          => 'required|numeric',
            'treatment_duration'    => 'required|numeric',
            'treatment_price'       => 'required|string'
        ]);

        $data['treatment_id']       = $request->input('treatment_id');
        $data['treatment_duration'] = $request->input('treatment_duration');
        $data['treatment_price']    = $request->input('treatment_price');

        $add = new Treatment_Price();
        return $add->_CreateTreatmentPrice($data);
    }

    // CREATE NEW TREATMENT HISTORY
    public function addTreatmentHistory(Request $request)
    {
        $this->validate($request, [
            'user_id'            => 'required|numeric',
            'treatment_id'       => 'required|numeric',
            'treatment_price_id' => 'required|numeric',
            'history_duration'   => 'required|string',
            'treatment_time'     => 'required|string',
            'treatment_date'     => 'required|string',
            'branch_id'          => 'required|numeric'
        ]);

        $data['user_id']            = $request->input('user_id');
        $data['treatment_id']       = $request->input('treatment_id');
        $data['treatment_price_id'] = $request->input('treatment_price_id');
        $data['history_duration']   = $request->input('history_duration');
        $data['treatment_time']     = $request->input('treatment_time');
        $data['treatment_date']     = $request->input('treatment_date');
        $data['branch_id']          = $request->input('branch_id');

        $add = new Treatment_History();
        return $add->_CreateTreatmentHistory($data);
    }

    // GET MY TREATMENT HISTORY
    public function getTreatmentHistory(INT $id)
    {
        $result = Treatment_History::join('treatments', 'treatment_history.treatment_id', '=', 'treatments.id')
            ->join('treatment_price', 'treatment_history.treatment_price_id', '=', 'treatment_price.id')
            ->select('treatment_history.id as treatment_history_id', 'treatments.*', 'treatment_history.*', 'treatment_price.*')
            ->where('treatment_history.user_id',$id)
            ->orderBy('treatment_history.id','DESC')
            ->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get All Treatment History Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = true;
            $res['message'] = "Get All Treatment History Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
    }

    // Get detail Treatment history
    public function getSelectedTreatmentHistory(INT $id)
    {
        $result = Treatment_History::join('treatments', 'treatment_history.treatment_id', '=', 'treatments.id')
            ->join('treatment_price', 'treatment_history.treatment_price_id', '=', 'treatment_price.id')
            ->select('treatment_history.id as treatment_history_id', 'treatments.*', 'treatment_history.*', 'treatment_price.*')
            ->where('treatment_history.id', $id)
            ->get();

        if ($result) {
            $res['status']  = true;
            $res['message'] = "Get Treatment History Success";
            $res['result']  = $result;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Get Treatment History Failed";
            $res['result']  = $result;
            return response($res, 400);
        }
            

    }
}
