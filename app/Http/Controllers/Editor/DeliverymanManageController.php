<?php

namespace App\Http\Controllers\Editor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Nearestzone;
use App\Deliveryman;
use App\Parcel;
use App\Deliverymanpayment;
use DB;
class DeliverymanManageController extends Controller
{
    
    public function add(){
    $areas = Nearestzone::where('status',1)->get();
    return view('backEnd.deliveryman.add',compact('areas'));
   }
    public function save(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required',
    		'phone'=>'required',
    		'designation'=>'required',
    		'area'=>'required',
    		'image'=>'required',
    		'password'=>'required',
            'status'=>'required',
    	]);
        
    	// image upload
    	$file = $request->file('image');
    	$name = time().$file->getClientOriginalName();
    	$uploadPath = 'uploads/deliveryman/';
    	$file->move($uploadPath,$name);
    	$fileUrl =$uploadPath.$name;

    	$store_data					=	new Deliveryman();
    	$store_data->name 			=	$request->name;
    	$store_data->email  		= 	$request->email;
    	$store_data->phone  		= 	$request->phone;
    	$store_data->designation 	= 	$request->designation;
    	$store_data->area 			= 	$request->area;
    	$store_data->password 		= 	bcrypt(request('password'));
    	$store_data->image 			= 	$fileUrl;
        $store_data->commisiontype  =   $request->commisiontype;
        $store_data->commision      =   $request->commision;
    	$store_data->status 		= 	$request->status;
    	$store_data->save();
        Toastr::success('message', 'Deliveryman add successfully!');
    	return redirect('editor/deliveryman/manage');
    }
   
   public function manage(){
    	$show_datas = DB::table('deliverymen')
    	->join('nearestzones', 'deliverymen.area', '=', 'nearestzones.id' )
    	->select('deliverymen.*', 'nearestzones.zonename')
        ->orderBy('id','DESC')
    	->get();
    	return view('backEnd.deliveryman.manage',compact('show_datas'));
    }

    public function edit($id){
        $edit_data = Deliveryman::find($id);
        $areas = Nearestzone::where('status',1)->get();
    	return view('backEnd.deliveryman.edit',compact('edit_data','areas'));
    }

    public function update(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required',
    		'phone'=>'required',
    		'designation'=>'required',
    		'area'=>'required',
    		'status'=>'required',
    	]);
    	$update_data = Deliveryman::find($request->hidden_id);
    	// image upload
    	$update_file = $request->file('image');
    	if ($update_file) {
	    	$name = time().$update_file->getClientOriginalName();
	    	$uploadPath = 'uploads/deliveryman/';
	    	$update_file->move($uploadPath,$name);
	    	$fileUrl =$uploadPath.$name;
    	}else{
    		$fileUrl = $update_data->image;
    	}

    	$update_data->name 			=	$request->name;
    	$update_data->email  		= 	$request->email;
    	$update_data->phone  		= 	$request->phone;
    	$update_data->designation 	= 	$request->designation;
    	$update_data->area 			= 	$request->area;
    	$update_data->password 		= 	bcrypt(request('password'));
    	$update_data->image 		= 	$fileUrl;
        $update_data->commisiontype  =   $request->commisiontype;
        $update_data->commision      =   $request->commision;
    	$update_data->status 		= 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Employee update successfully!');
    	return redirect('editor/deliveryman/manage');
    }

    public function inactive(Request $request){
        $inactive_data = Deliveryman::find($request->hidden_id);
        $inactive_data->status=0;
        $inactive_data->save();
        Toastr::success('message', 'Employee inactive successfully!');
        return redirect('editor/deliveryman/manage');      
    }

    public function active(Request $request){
        $inactive_data = Deliveryman::find($request->hidden_id);
        $inactive_data->status=1;
        $inactive_data->save();
        Toastr::success('message', 'Employee active successfully!');
        return redirect('editor/deliveryman/manage');        
    }

    public function destroy(Request $request, $id){
        $destroy_id = Deliveryman::find($id);
        $destroy_id->delete();
        Toastr::success('message', 'Employee delete successfully!');
        return redirect('editor/deliveryman/manage');         
    }
    public function view($id){
        $deliverymanInfo = Deliveryman::find($id);
        $parcels = DB::table('parcels')
            ->join('merchants', 'merchants.id','=','parcels.merchantId')
            ->join('deliverymen', 'parcels.deliverymanId','=','deliverymen.id')
            ->where('parcels.deliverymanId', $id)
            ->orderBy('parcels.id','DESC')
            ->select('parcels.*','merchants.firstName','merchants.lastName','merchants.phoneNumber','merchants.emailAddress','merchants.companyName','merchants.status as mstatus','merchants.id as mid')
            ->get();
        $totalamount=Parcel::where(['deliverymanId'=>$id,'status'=>4])
        ->sum('merchantDue');
        $unpaidamount=Parcel::where(['deliverymanId'=>$id,'status'=>4])
        ->sum('merchantDue');
        return view('backEnd.deliveryman.view',compact('deliverymanInfo','parcels','totalamount','unpaidamount'));
    }
    public function bulkpayment(Request $request){
        $selectption = $request->selectptions;
        if($selectption==1){
            $payment = new Deliverymanpayment();
            $payment->deliverymanId = $request->deliverymanId;
            $payment->save();
            $parcels_id = $request->parcel_id;
            foreach($parcels_id as $parcel_id){
                $parcel         =   Parcel::find($parcel_id);
                $parcel->dPayinvoice = $payment->id;
                $parcel->deliverymanPaystatus = 1;
                $parcel->save();
            } 
            Toastr::success('message', 'Payment paid successfully!');
            return redirect()->back();
        }elseif($selectption==0){
            $parcels_id = $request->parcel_id;
            foreach($parcels_id as $parcel_id){
                $parcel         =   Parcel::find($parcel_id);
                $parcel->deliverymanPaystatus   = 0;
                $parcel->save();
        }
         Toastr::success('message', 'Payment process successfully!');
         return redirect()->back();
        }
    }
    public function paymentinvoice($id){
       $allInvoice = Deliverymanpayment::where('deliverymanId',$id)->get();
        return view('backEnd.deliveryman.paymentinvoice',compact('allInvoice'));
    }
    public function inovicedetails($id){
        $invoiceInfo = Deliverymanpayment::find($id);
        $inovicedetails = Parcel::where('dPayinvoice',$id)->get();
        $deliverymanInfo = Deliveryman::find($invoiceInfo->deliverymanId);
        return view('backEnd.deliveryman.inovicedetails',compact('inovicedetails','invoiceInfo','deliverymanInfo'));
    }
}
