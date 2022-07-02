<?php

namespace App\Http\Controllers;

use App\Area;
use App\Nearestzone;
use App\UpDistrict;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AreaControllerNew extends Controller
{
    public function add(){

        $districts = UpDistrict::latest()->get();
    	return view('backEnd.area.add', compact('districts'));

    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
            'district_id' => 'required',
    		
    	]);


    	$store_data                    = new Area();
    	$store_data->name   	   = $request->name;
    	$store_data->district_id   	   = $request->district_id;
    	$store_data->save();
    	Toastr::success('message', 'District add successfully!');
    	return redirect('/admin/area/manage');
    }
     public function manage(){
        $show_data = Area::
             orderBy('id','DESC')
            ->get();
    	return view('backEnd.area.manage',compact('show_data'));
    }
     public function edit($id){
        $districts = UpDistrict::latest()->get();
        $edit_data = Area::find($id);

        return view('backEnd.area.edit',compact('edit_data','districts'));
    }
      public function update(Request $request){
      	$update_data = Area::find($request->hidden_id);

          $update_data->name   	   = $request->name;
          $update_data->district_id   	   = $request->district_id;
    	$update_data->save();
        Toastr::success('message', 'District Update successfully!');
        return redirect('admin/area/manage');
    }

    // public function inactive(Request $request){
    //     $unpublish_data = Area::find($request->hidden_id);
    //     $unpublish_data->status=0;
    //     $unpublish_data->save();
    //     Toastr::success('message', 'Area active successfully!');
    //     return redirect('/admin/area/manage');
    // }

    // public function active(Request $request){
    //     $publishId = Area::find($request->hidden_id);
    //     $publishId->status=1;
    //     $publishId->save();
    //     Toastr::success('message', 'Area active successfully!');
    //     return redirect('/admin/area/manage');
    // }

     public function destroy(Request $request){
        $destroy_id = Area::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Deleted successfully!');
        return redirect('/admin/area/manage');         
    }
}
