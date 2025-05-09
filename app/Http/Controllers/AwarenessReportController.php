<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CaseType;
use App\Models\Patient;
use App\Models\City;
use App\Models\Brgy;
class AwarenessReportController extends Controller
{
    //
    public function index()
    {
        try{
            $cities = City::with("brgys")->get();
        return view('awarenessreports.index', compact('cities'));
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
 
    public function generate($cityId, $brgyId = null)
    {
        try{
$data = [];
        if ($cityId && $brgyId ) {
            $brgy = Brgy::findOrFail($brgyId);
            $counts = [];
    
            foreach (CaseType::cases() as $caseType) {
                $counts[$caseType->value] = $brgy->patients()
                    ->where('case_type', $caseType->value)
                    ->count();
            }
    
            $data = [
                'counts' => $counts
            ];
        } elseif ($cityId && !$brgyId) {
            $counts = [];
    
            foreach (CaseType::cases() as $caseType) {
                $counts[$caseType->value] = Patient::whereHas('brgy', function ($query) use ($cityId) {
                    $query->where('city_id', $cityId);
                })->where('case_type', $caseType->value)->count();
            }
    
            $data = [
                'counts' => $counts
            ];
        }
    
        return $data;
        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

}
