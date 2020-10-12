<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Model;

class MasterDoctors extends Model
{
    protected $fillable = [];

    public function booking(){
    	return $this->hasMany("Modules\Doctor\Entities\DoctorBookings","doctor_id");
    }

    public function user(){
        return $this->belongsTo("App\User");
    }

    public function getQuotaAttribute(){
    	if ( count($this->booking) > 10 ) {
    		return false;
    	}

    	return true;
    }

    public function hospital(){
        return $this->belongsTo("Modules\Doctor\Entities\MasterHospitals","hospital_id");
    }

    public function getHoursWorkAttribute(){
        $start = strtotime($this->user->updated_at);
        $now = strtotime(date("Y-m-d H:i:s"));
        $selisih = $now - $start;
        $minutes = $selisih / 60;
        
        if ( $minutes > 30 ){
            return false;
        }
        return true;
    }
}
