<?php

namespace Modules\Doctor\Entities;

use Illuminate\Database\Eloquent\Model;

class MasterHospitals extends Model
{
    protected $fillable = [];

    public function doctors(){
    	return $this->hasMany("Modules\Doctor\Entities\MasterDoctors","hospital_id");
    }
}
