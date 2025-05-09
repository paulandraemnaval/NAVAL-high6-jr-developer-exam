<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class CheckStatusController extends Controller
{
    //
    public function index(){
        try{
            return view('checkstatus.index');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function check($number){
        try{
            $data = [];

            $patient = Patient::where('number', $number)->first();

            if($patient?->count() > 0){
                $data = [
                    'message' => 'patient found',
                    'name'=> $patient->name,
                    'city'=> $patient->brgy->city->name,
                    'brgy' => $patient->brgy->name,
                    'case_type' => $patient->case_type->value,
                    'coronavirus_status' => $patient->coronavirus_status?->value,                
                ];
            
            return $data;
        }

        else{
            $data = [
                'message' => 'no patient with the entered number'
            ];

            return $data;
        }
        
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }
}
