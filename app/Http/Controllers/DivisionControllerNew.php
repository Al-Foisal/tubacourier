<?php

namespace App\Http\Controllers;

use App\Division;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class DivisionControllerNew extends Controller
{
    public function add(){
    	return view('backEnd.division.add');

    }
    public function store(Request $request){
    	$this->validate($request,[
            'name'=>'required',
    		
    	]);


    	$store_data                    = new Division();
    	$store_data->name   	   = $request->name;
    	$store_data->save();
    	Toastr::success('message', 'Division add successfully!');
    	return redirect('/admin/division/manage');
    }
     public function manage(){
        $show_data = Division::
             orderBy('id','DESC')
            ->get();
    	return view('backEnd.division.manage',compact('show_data'));
    }
     public function edit($id){
        $edit_data = Division::find($id);
        return view('backEnd.division.edit',compact('edit_data'));
    }
      public function update(Request $request){
      	$update_data = Division::find($request->hidden_id);

        $update_data->name   	    = $request->name;
    	$update_data->save();
        Toastr::success('message', 'Division Update successfully!');
        return redirect('admin/division/manage');
    }

    // public function inactive(Request $request){
    //     $unpublish_data = Division::find($request->hidden_id);
    //     $unpublish_data->status=0;
    //     $unpublish_data->save();
    //     Toastr::success('message', 'Division active successfully!');
    //     return redirect('/admin/division/manage');
    // }

    // public function active(Request $request){
    //     $publishId = Division::find($request->hidden_id);
    //     $publishId->status=1;
    //     $publishId->save();
    //     Toastr::success('message', 'Division active successfully!');
    //     return redirect('/admin/division/manage');
    // }

     public function destroy(Request $request){
        $destroy_id = Division::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Division  delete successfully!');
        return redirect('/admin/division/manage');         
    }

}
