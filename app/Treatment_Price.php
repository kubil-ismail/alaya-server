<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Treatment_Price extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'treatment_price';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'treatment_price', 'treatment_id', 'treatment_duration'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    // DELETE ONE Price
    public function _DeleteTreatment($id)
    {
        $delete = Treatment_Price::where('id', $id)->first();
        $delete->delete();

        if ($delete) {
            $res['status']  = true;
            $res['message'] = "Delete Success";
            $res['result']  = $delete;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Request Time Out";
            $res['result']  = null;
            return response($res, 400);
        }

        return response($res, 200);
    }

    public function _CreateTreatmentPrice($data)
    {
        $treatment = Treatment_Price::create([
            'treatment_id'       => $data['treatment_id'],
            'treatment_duration' => $data['treatment_duration'],
            'treatment_price'    => $data['treatment_price']
        ]);

        if ($treatment) {
            $res['status']  = true;
            $res['message'] = "Add Price Treatment Success";
            $res['result']  = $treatment;
            return response($res, 200);
        } else {
            $res['status']  = false;
            $res['message'] = "Add Price Treatment Failed";
            $res['result']  = null;
            return response($res, 400);
        }
    }
}
