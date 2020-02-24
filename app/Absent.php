<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;

class Absent extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'position_id', 'branch_id', 'absent_time', 'absent_date', 'latitude', 'longitude', 'absent_status'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    function _CreateAbsent($data)
    {
        $check =  Absent::where('absent_date', $data['absent_date'])
                ->where('user_id',$data['user_id'])
                ->first();

        if ($check) {
            $res['status'] = false;
            $res['message'] = "Already absent today";
            $res['result'] = null;
            return response($res, 200);
        } else {
             $absent = Absent::create([
                'user_id'       => $data['user_id'],
                'position_id'   => $data['position_id'],
                'branch_id'     => $data['branch_id'],
                'absent_time'   => $data['absent_time'],
                'absent_date'   => $data['absent_date'],
                'latitude'      => $data['latitude'],
                'longitude'     => $data['longitude'],
                'absent_status' => $data['absent_status']
            ]);

            if ($absent) {
                $res['status'] = true;
                $res['message'] = "Add New Absent Success";
                $res['result'] = $absent;
                return response($res, 200);
            } else {
                $res['status'] = false;
                $res['message'] = "Add New Absent Failed";
                $res['result'] = null;
                return response($res, 400);
            }
        }
    }
}
