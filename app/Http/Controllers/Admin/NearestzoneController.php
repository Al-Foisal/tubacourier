<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Nearestzone;
use App\Area;
use File;

class NearestzoneController extends Controller
{
    public function add(){

        $newareas =  Area::orderBy('name')->get();

    	return view('backEnd.nearestzone.add', compact('newareas'));

    }
    public function store(Request $request){
    	$this->validate($request,[
            'zonename'=>'required',
            'area_id'=>'required',
    		'status'=>'required',
    	]);


    	$store_data                    = new Nearestzone();
    	$store_data->zonename   	   = $request->zonename;
    	$store_data->status            = $request->status;
    	$store_data->area_id            = $request->area_id;
    	$store_data->save();
    	Toastr::success('message', 'Nearestzone add successfully!');
    	return redirect('/admin/nearestzone/manage');
    }
     public function manage(){
        $show_data = Nearestzone::
             orderBy('id','DESC')
            ->get();
    	return view('backEnd.nearestzone.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = Nearestzone::find($id);
        $newareas =  Area::orderBy('name')->get();

        return view('backEnd.nearestzone.edit',compact('edit_data','newareas'));
    }
      public function update(Request $request){
      	$update_data = Nearestzone::find($request->hidden_id);

        $update_data->zonename   	    = $request->zonename;
    	$update_data->status            = $request->status;
    	$update_data->area_id            = $request->area_id;
    	$update_data->save();
        Toastr::success('message', 'Nearestzone Update successfully!');
        return redirect('admin/nearestzone/manage');
    }

    public function inactive(Request $request){
        $unpublish_data = Nearestzone::find($request->hidden_id);
        $unpublish_data->status=0;
        $unpublish_data->save();
        Toastr::success('message', 'Nearestzone active successfully!');
        return redirect('/admin/nearestzone/manage');
    }

    public function active(Request $request){
        $publishId = Nearestzone::find($request->hidden_id);
        $publishId->status=1;
        $publishId->save();
        Toastr::success('message', 'Nearestzone active successfully!');
        return redirect('/admin/nearestzone/manage');
    }

     public function destroy(Request $request){
        $destroy_id = Nearestzone::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Nearestzone  delete successfully!');
        return redirect('/admin/nearestzone/manage');         
    }
    
 


}
