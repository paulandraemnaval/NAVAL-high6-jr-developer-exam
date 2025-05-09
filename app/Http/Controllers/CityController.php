<?php

namespace App\Http\Controllers;

use App\Models\Brgy;
use Illuminate\Http\Request;
use App\Models\City;
use App\Http\Requests\CityRequest;
use App\Http\Resources\CityResource;
class CityController extends Controller
{
    //
    public function index(){
        try{
            $cities = City::all();

        return view('cities.index', ['cities' => $cities]);

        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function create(){
        try{
            return view('cities.create');
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(CityRequest $request){
        try{
            $data =$request->validated();

            City::create($data);

        return redirect(route('cities.index'))->with('success','city created successfully');
    
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(City $city){
        try{
            $cleanedData = new CityResource($city);
            return view('cities.show', ['city'=> $cleanedData]);
   
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
        
    }

    public function edit(City $city){
        try{
            return view('cities.edit', ['city'=> $city]);
   
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(CityRequest $request, City $city){
        try{
            $validatedData = $request->validated();

            $city->update($validatedData);    

            return redirect(route('cities.index'))->with('success','city updated successfully');
        
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }    
    }

    public function destroy(City $city){
        try{
            $city->delete();
            return redirect(route('cities.index'))->with('success','city deleted successfully');
   
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function get_brgys($cityid){
        try{
            return Brgy::where('city_id', $cityid)->get();
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }   
}
