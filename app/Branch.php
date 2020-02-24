<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Branch extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;


    protected $table = 'branchs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_name', 'address', 'phone', 'map_url', 'latitude', 'longitude', 'open_hour', 'closing_time'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    // DELETE ONE Branch
    public function _DeleteBranch($id)
    {
        $delete = Branch::where('id', $id)->first();
        $delete->delete();

        if ($delete) {
            $res['status'] = true;
            $res['message'] = "Delete Branch Success";
            $res['result'] = $delete;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Request Time Out";
            $res['result'] = null;
            return response($res, 400);
        }

        return response($res, 200);
    }

    // CREATE NEW BRANCH
    public function _CreateBranch($data)
    {
        $branch = Branch::create([
            'branch_name' => $data['branch_name'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'map_url' => $data['map_url'],
            'latitude' => $data['latitude'],
            'longitude' => $data['latitude'],
            'open_hour' => $data['open_hour'],
            'closing_time' => $data['closing_time']
        ]);

        if ($branch) {
            $res['status'] = true;
            $res['message'] = "Add New Branch Success";
            $res['result'] = $branch;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Add New Branch Failed";
            $res['result'] = null;
            return response($res, 400);
        }
    }


    // EDIT Branch
    public function _EditBranch($data)
    {
        $branch = Branch::find($data['id']);
        $branch->branch_name = $data['branch_name'];
        $branch->address = $data['address'];
        $branch->phone = $data['phone'];
        $branch->map_url = $data['map_url'];
        $branch->latitude = $data['latitude'];
        $branch->longitude = $data['longitude'];
        $branch->open_hour = $data['open_hour'];
        $branch->closing_time = $data['closing_time'];
        $branch->save();

        if ($branch) {
            $res['status'] = true;
            $res['message'] = "Edit Branch Success";
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Edit Branch Failed";
            return response($res, 400);
        }
    }
}
