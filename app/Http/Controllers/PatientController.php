<?php

namespace App\Http\Controllers;

use App\CoronavirusType;
use App\Http\Requests\PatientRequest;
use App\Http\Resources\PatientResource;
use App\Models\Brgy;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\City;
use App\CaseType;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    //
    public function index()
    {
        try{
                  $patients = Patient::all();
        return view('patients.index', compact('patients'));
  
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function create(){
    try{
        $cities = City::all();
        $brgys = Brgy::all();

        return view('patients.create', compact('cities', 'brgys'));
    
    }catch(\Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
    }    
    }

    public function store(PatientRequest $request){
        try{
                   $validatedData = $request->validated();
        Patient::create($validatedData);
        return redirect()->route('patients.index')->with('success','patient created successfully');
 
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
 
    }

    public function show(Patient $patient){

        try{
                    $cleanedPatient = new PatientResource($patient);

        return view('patients.show', compact('cleanedPatient'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit(Patient $patient){
        try{
                 $brgys = Brgy::all();
        return view('patients.edit', compact('brgys', 'patient'));
   
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function update(PatientRequest $request, Patient $patient){
        try{
                 $validatedData = $request->validated();

        
        $patient->update($validatedData);
        return redirect()->route('patients.index')->with('success','patient data edited successfully');
   
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Patient $patient){
    try{
            $patient->delete();
        return redirect()->route('patients.index')->with('success','Patient deleted successfully');
    
    }catch(\Exception $e){
        return redirect()->back()->with('error', $e->getMessage());
    }
    }
}
