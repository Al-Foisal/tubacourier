<?php

namespace App\Http\Controllers;

use App\Division;
use App\UpDistrict;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DistrictControllerNew extends Controller
{
    public function add(){
        $divisions = Division::orderBy('name')->get();

    	return view('backEnd.up_district.add', compact('divisions'));

    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
            'division_id' => 'required',
    		
    	]);


    	$store_data                    = new UpDistrict();
    	$store_data->name   	   = $request->name;
    	$store_data->division_id   	   = $request->division_id;
    	$store_data->save();
    	Toastr::success('message', 'District add successfully!');
    	return redirect('/admin/up_district/manage');
    }
     public function manage(){
        $show_data = UpDistrict::
             orderBy('id','DESC')
            ->get();
    	return view('backEnd.up_district.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = UpDistrict::find($id);
        $divisions = Division::orderBy('name')->get();

        return view('backEnd.up_district.edit',compact('edit_data','divisions'));
    }
      public function update(Request $request){
      	$update_data = UpDistrict::find($request->hidden_id);

          $update_data->name   	   = $request->name;
          $update_data->division_id   	   = $request->division_id;
    	$update_data->save();
        Toastr::success('message', 'District Update successfully!');
        return redirect('admin/up_district/manage');
    }

    // public function inactive(Request $request){
    //     $unpublish_data = UpDistrict::find($request->hidden_id);
    //     $unpublish_data->status=0;
    //     $unpublish_data->save();
    //     Toastr::success('message', 'UpDistrict active successfully!');
    //     return redirect('/admin/up_district/manage');
    // }

    // public function active(Request $request){
    //     $publishId = UpDistrict::find($request->hidden_id);
    //     $publishId->status=1;
    //     $publishId->save();
    //     Toastr::success('message', 'UpDistrict active successfully!');
    //     return redirect('/admin/up_district/manage');
    // }

     public function destroy(Request $request){
        $destroy_id = UpDistrict::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'District  delete successfully!');
        return redirect('/admin/up_district/manage');         
    }
}
