<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Treatment_History extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    protected $table = 'treatment_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'treatment_id', 'treatment_price_id', 'history_duration', 'treatment_time', 'treatment_date', 'treatment_end', 'branch_id'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function _CreateTreatmentHistory($data)
    {
        $treatment = Treatment_History::create([
            'user_id'            => $data['user_id'],
            'treatment_id'       => $data['treatment_id'],
            'treatment_price_id' => $data['treatment_price_id'],
            'history_duration'   => $data['history_duration'],
            'treatment_time'     => $data['treatment_time'],
            'treatment_end'      => date('h:i A'),
            'treatment_date'     => $data['treatment_date'],
            'branch_id'          => $data['branch_id']
        ]);
        
        if ($treatment) {
            $res['status'] = true;
            $res['message'] = "Add Treatment History Success";
            $res['result'] = $treatment;
            return response($res, 200);
        } else {
            $res['status'] = false;
            $res['message'] = "Add Treatment History Failed";
            $res['result'] = null;
            return response($res, 400);
        }
    }
}
