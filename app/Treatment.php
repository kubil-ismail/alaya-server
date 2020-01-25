<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Treatment extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'treatments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'treatment_name', 'treatment_desc'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    // MODEL Create New User
    public function _CreateTreatment($data)
    {
        $treatment = Treatment::create([
            'treatment_name' => $data['treatment_name'],
            'treatment_desc' => $data['treatment_desc']
        ]);

        if ($treatment) {
            $res['status'] = true;
            $res['message'] = "Add Treatment Success";
            $res['result'] = $treatment;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Add Treatment Failed";
            $res['result'] = null;
            return response($res, 400);
        }
    }
}
