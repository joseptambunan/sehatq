<?php

use Illuminate\Database\Seeder;
use App\User;
use Modules\Doctor\Entities\MasterDoctors;
use Modules\Doctor\Entities\MasterHospitals;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $master_hospital = new MasterHospitals;
        $master_hospital->name = "Hospital A";
        $master_hospital->save();

        $master_doctor = new MasterDoctors;
        $master_doctor->name = "Doctor A";
        $master_doctor->email = "doctor@email.com";
        $master_doctor->hospital_id = $master_hospital->id;
        $master_doctor->save();

        $user = new User;
        $user->name = $master_doctor->name;
        $user->email = $master_doctor->email;
        $user->password = crypt('123','$6$rounds=5000$saltatkas$'); 
        $user->doctor_id = $master_doctor->id;
        $user->save();

        
    }
}
