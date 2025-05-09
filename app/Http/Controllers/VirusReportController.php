<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Brgy;
use App\CoronavirusType;
use App\Models\Patient;
class VirusReportController extends Controller
{
    //
    public function index()
    {
    try{
        $cities = City::all();
        return view('virusreports.index', compact('cities'));
    
    }catch(\Exception $e){
        return back()->with('error', $e->getMessage());
    }
    }

    public function generate($cityId, $brgyId = null)
    {
      try{
          $data = [];
        if ($cityId && $brgyId ) {
            $brgy = Brgy::findOrFail($brgyId);
            $counts = [];
    
            foreach (CoronaVirusType::cases() as $coronavirusType) {
                $counts[$coronavirusType->value] = $brgy->patients()
                    ->where('coronavirus_status', $coronavirusType->value)
                    ->count();
            }

            $total = array_sum($counts);
    
            $data = [
                'total' => $total,
                'counts' => $counts
            ];
        } elseif ($cityId && !$brgyId) {
            $counts = [];
    
            foreach (CoronavirusType::cases() as $coronavirusType) {
                $counts[$coronavirusType->value] = Patient::whereHas('brgy', function ($query) use ($cityId) {
                    $query->where('city_id', $cityId);
                })->where('coronavirus_status', $coronavirusType->value)->count();
            }

            $total = array_sum($counts);
    
            $data = [
                'total'=> $total,
                'counts' => $counts 
            ];
        }
    
        return $data;
      }catch(\Exception $e){
        return back()->with('error', $e->getMessage());
      }
    }

}
