<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Branch;

class BranchController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    //  GET ALL NAME BRANCH
    public function getBrachName()
    {
        // RETURN ID & NAME BRANCH
        $result = Branch::all();

        $res['status'] = true;
        $res['message'] = "Get Branch Success";
        $res['result'] = $result;
        return response($res, 200);
    }

    // Delete One User
    public function deleteOneBranch(INT $id)
    {
        $delete = new Branch();
        return $delete->_DeleteBranch($id);
    }    

    public function addBranch(Request $request)
    {
        $this->validate($request, [
            'branch_name'   => 'required|string',
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'map_url'       => 'required|string',
            'latitude'      => 'required|string',
            'longitude'     => 'required|string',
            'open_hour'     => 'required|string',
            'closing_time'  => 'required|string'
        ]);
        
        $data['branch_name']  = $request->input('branch_name');
        $data['address']      = $request->input('address');
        $data['phone']        = $request->input('phone');
        $data['map_url']      = $request->input('map_url');
        $data['latitude']     = $request->input('latitude');
        $data['latitude']     = $request->input('latitude');
        $data['open_hour']    = $request->input('open_hour');
        $data['closing_time'] = $request->input('closing_time');

        $add = new Branch();
        return $add->_CreateBranch($data);
    }

    // Update Branch
    public function updateBranch(Request $request)
    {
        $this->validate($request, [
            'id'            => 'required|numeric',
            'branch_name'   => 'required|string',
            'address'       => 'required|string',
            'phone'         => 'required|string',
            'map_url'       => 'required|string',
            'latitude'      => 'required|string',
            'longitude'     => 'required|string',
            'open_hour'     => 'required|string',
            'closing_time'  => 'required|string'
        ]);

        $data['id']  = $request->input('id');
        $data['branch_name']  = $request->input('branch_name');
        $data['address']      = $request->input('address');
        $data['phone']        = $request->input('phone');
        $data['map_url']      = $request->input('map_url');
        $data['latitude']     = $request->input('latitude');
        $data['latitude']     = $request->input('latitude');
        $data['open_hour']    = $request->input('open_hour');
        $data['closing_time'] = $request->input('closing_time');

        $update = new Branch();
        return $update->_EditBranch($data);
    }
}
