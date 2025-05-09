<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrgyRequest;
use App\Http\Resources\CityResource;
use App\Models\City;
use Illuminate\Http\Request;
use App\Models\Brgy;
use App\Http\Resources\BrgyResource;
class BrgyController extends Controller
{
    //
    public function index()
    {
       try{
         $brgys = Brgy::all();
        return view('brgys.index', ['brgys' => $brgys]);
       }catch(\Exception $e){
        return back()->with('error', $e->getMessage());
       }
    }

    public function create(Request $request)
    {
        try{
            $cities = City::all();

        return view('brgys.create', ['cities' => $cities]);
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function store(BrgyRequest $request){
        try{
                $validatedData = $request->validated();

        Brgy::create($validatedData);

        return redirect()->route('brgys.index')->with('success','brgy created successfully');
    
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function show(Brgy $brgy){
        try{
                    $city = City::find($brgy->id);
        $cleanedCity = new CityResource($city);
        $cleanedBrgy = new BrgyResource($brgy);  
        return view('brgys.show', ['city'=> $cleanedCity, 'brgy' => $cleanedBrgy]);

        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function edit(Brgy $brgy){
        try{
                $cities = City::all();
        return view('brgys.edit', ['cities'=> $cities,'brgy'=> $brgy]);
    
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function update(BrgyRequest $request, Brgy $brgy){
        try{
                  $validatedData = $request->validated($request);
        $brgy->update($validatedData);
        return redirect()->route('brgys.index')->with('success','brgy edited successfully');
  
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy(Brgy $brgy){
        try{
                   $brgy->delete();
        return redirect()->route('brgys.index')->with('success','brgy deleted successfully');
 
        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

}
