<?php

namespace App\Http\Controllers;

use App\Area;
use App\Nearestzone;
use App\UpDistrict;
use Illuminate\Http\Request;

class AreaSelectionController extends Controller
{
    public function get_district(Request $request){

        $id = $request->division_id;

        $districts = UpDistrict::where('division_id', $id)->get();

        return response()->json($districts);
    }

    public function get_area(Request $request){
        $id = $request->district_id;

        $areas = Area::where('district_id', $id)->get();

        return response()->json($areas);
    }
    
    public function get_union(Request $request){
        $id = $request->area_id;

        $areas = Nearestzone::where('area_id', $id)->get();

        return response()->json($areas);
    }


}
