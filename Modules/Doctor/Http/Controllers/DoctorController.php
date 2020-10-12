<?php

namespace Modules\Doctor\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Doctor\Entities\DoctorBookings;
use Modules\Doctor\Entities\MasterHospitals;
use Modules\Doctor\Entities\MasterDoctors;



class DoctorController extends Controller
{
    public function booking(Request $request){
        $doctor = MasterDoctors::find($request->doctor_id);
        if ( $doctor->quota == false ){
            $data['status'] = "410";
            $data['message'] = "This doctor has full booked";
            echo json_encode($data);
            exit();
        }

        if ( $doctor->hours_work == false ){
            $data['status'] = "410";
            $data['message'] = "This doctor has reach time limit";
            echo json_encode($data);
            exit();
        }

        $booking_doctor = new DoctorBookings;
        $booking_doctor->doctor_id = $request->doctor_id;
        $booking_doctor->patient_name = $request->patient_name;
        $booking_doctor->booking_schedule = date("Y-m-d H:i:s", strtotime($request->booking_schedule));
        $booking_doctor->created_at = date("Y-m-d H:i:s");
        $booking_doctor->save();

        $data['status'] = "200";
        $data['message'] = "Booking Has been Placed";

        echo json_encode($data);

    }

    public function doctor_hospital(Request $request){
        $hospital = MasterHospitals::find($request->id);
        $data = array();
        foreach ($hospital->doctors as $key => $value) {
            $array['doctor'] = $value->name;
            $data['hospital'][] = $array;
        }

        echo json_encode($data);
    }

    public function hospitals(){
        $hospital = MasterHospitals::get();
        $data = array();
        foreach ($hospital as $key => $value) {
            $array['id'] = $value->id;
            $array['name'] = $value->name;
            $data['hospital'][] = $array;
        }
        echo json_encode($data);
    }

    public function doctors(){
        $doctors = MasterDoctors::get();
        $data = array();
        foreach ($doctors as $key => $value) {
            $array['id'] = $value->id;
            $array['name'] = $value->name;
            $array['hospital'] = $value->hospital->name;
            $data['doctors'][] = $array;
        }
        echo json_encode($data);
    }

    public function schedule(Request $request){
        $data = array();
        $doctor = MasterDoctors::find($request->id);
        foreach ($doctor->booking as $key => $value) {
            $array['patient_name'] = $value->patient_name;
            $array['schedule'] = date("d/M/Y H:i:s", strtotime($value->booking_schedule));
            $data['schedule'][] = $array;
        }

        echo json_encode($data);
    }
}
