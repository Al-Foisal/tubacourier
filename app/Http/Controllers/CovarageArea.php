<?php

namespace App\Http\Controllers;

use App\CoverageArea;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CovarageArea extends Controller {
    public function add() {

        return view('backEnd.covarage.add');

    }

    public function store(Request $request) {
        $this->validate($request, [

            'district'      => 'required',
            'lockdown'      => 'required',
            'area'          => 'required',
            'post_code'     => 'required',
            'home_delivery' => 'required',
            'charge_1kg'    => 'required',
            'charge_2kg'    => 'required',
            'charge_3kg'    => 'required',
            'code_charge'   => 'required',
            'area_sts'      => 'required',

        ]);

        $store_data                = new CoverageArea();
        $store_data->district      = $request->district;
        $store_data->lockdown      = $request->lockdown;
        $store_data->area_sts      = $request->area_sts;
        $store_data->area          = $request->area;
        $store_data->post_code     = $request->post_code;
        $store_data->home_delivery = $request->home_delivery;
        $store_data->charge_1kg    = $request->charge_1kg;
        $store_data->charge_2kg    = $request->charge_2kg;
        $store_data->charge_3kg    = $request->charge_3kg;
        $store_data->code_charge   = $request->code_charge;

        $store_data->save();
        Toastr::success('message', 'District add successfully!');

        return redirect('/admin/covarage/manage');
    }

    public function manage() {
        $show_data = CoverageArea::
            orderBy('id', 'DESC')
            ->get();

        return view('backEnd.covarage.manage', compact('show_data'));
    }

    public function edit($id) {
        $edit_data = CoverageArea::find($id);

        return view('backEnd.covarage.edit', compact('edit_data'));
    }

    public function update(Request $request) {

        $this->validate($request, [

            'district'      => 'required',
            'lockdown'      => 'required',
            'area'          => 'required',
            'post_code'     => 'required',
            'home_delivery' => 'required',
            'charge_1kg'    => 'required',
            'charge_2kg'    => 'required',
            'charge_3kg'    => 'required',
            'code_charge'   => 'required',
            'area_sts'      => 'required',

        ]);

        $update_data = CoverageArea::find($request->hidden_id);

        $update_data->district      = $request->district;
        $update_data->area          = $request->area;
        $update_data->area_sts      = $request->area_sts;
        $update_data->lockdown      = $request->lockdown;
        $update_data->post_code     = $request->post_code;
        $update_data->home_delivery = $request->home_delivery;
        $update_data->charge_1kg    = $request->charge_1kg;
        $update_data->charge_2kg    = $request->charge_2kg;
        $update_data->charge_3kg    = $request->charge_3kg;
        $update_data->code_charge   = $request->code_charge;

        $update_data->save();
        Toastr::success('message', 'District Update successfully!');

        return redirect('admin/covarage/manage');
    }

// public function inactive(Request $request){

//     $unpublish_data = CoverageArea::find($request->hidden_id);

//     $unpublish_data->status=0;

//     $unpublish_data->save();

//     Toastr::success('message', 'CoverageArea active successfully!');

//     return redirect('/admin/covarage/manage');

// }

// public function active(Request $request){

//     $publishId = CoverageArea::find($request->hidden_id);

//     $publishId->status=1;

//     $publishId->save();

//     Toastr::success('message', 'CoverageArea active successfully!');

//     return redirect('/admin/covarage/manage');
    // }

    public function destroy(Request $request) {
        $destroy_id = CoverageArea::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'District  delete successfully!');

        return redirect('/admin/covarage/manage');
    }

    function fetch_data(Request $request) {
        if ($request->ajax()) {
            $sort_by   = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $search_area     = $request->get('searcharea');
            $query     = $request->get('query');
            $query     = str_replace(" ", "%", $query);
    
            $data      = DB::table('coverage_areas')
                ->where('area_sts', $search_area)
                // ->where('district', 'like', '%' . $query . '%')
                ->where('area', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(50);
    
            return view('backEnd.covarage.pagination_data', compact('data'))->render();
        }
    
    }

    public function list(Request $request) {
        $data = CoverageArea::latest()->paginate(50);

        return view('backEnd.covarage.list', compact('data'));
    }

}
