<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Nearestzone;
use App\Agent;
use App\Parcel;
use App\Agentpayment;
use DB;
class AgentManageController extends Controller
{
    public function add(){
    $areas = Nearestzone::where('status',1)->get();
    return view('backEnd.agent.add',compact('areas'));
   }
    public function save(Request $request){
    	$this->validate($request,[
    		'name'=>'required',
    		'email'=>'required',
    		'phone'=>'required',
    		'designation'=>'required',
    		'area'=>'required',
    		'image'=>'required',
    		'commision'=>'required',
            'commisiontype'=>'required',
            'bookcommision'=>'required',
    		'password'=>'required',
            'status'=>'required',
    	]);
        
    	// image upload
    	$file = $request->file('image');
    	$name = time().$file->getClientOriginalName();
    	$uploadPath = 'uploads/agent/';
    	$file->move($uploadPath,$name);
    	$fileUrl =$uploadPath.$name;

    	$store_data					=	new Agent();
    	$store_data->name 			=	$request->name;
    	$store_data->email  		= 	$request->email;
    	$store_data->phone  		= 	$request->phone;
    	$store_data->designation 	= 	$request->designation;
    	$store_data->area 			= 	$request->area;
    	$store_data->password 		= 	bcrypt(request('password'));
    	$store_data->image 			= 	$fileUrl;
        $store_data->commision      =   $request->commision;
        $store_data->commisiontype  =   $request->commisiontype;
        $store_data->bookcommision  =   $request->bookcommision;
    	$store_data->status 		= 	$request->status;
    	$store_data->save();
        Toastr::success('message', 'Agent add successfully!');
    	return redirect('author/agent/manage');
    }
   
   public function manage(){
    	$show_datas = DB::table('agents')
    	->join('nearestzones', 'agents.area', '=', 'nearestzones.id' )
    	->select('agents.*', 'nearestzones.zonename')
        ->orderBy('id','DESC')
    	->get();
    	return view('backEnd.agent.manage',compact('show_datas'));
    }

    public function edit($id){
        $edit_data = Agent::find($id);
        $areas = Nearestzone::get();
    	return view('backEnd.agent.edit',compact('edit_data','areas'));
    }
    public function view($id){
       $agentInfo = Agent::find($id);
        $parcels = DB::table('parcels')
            ->join('merchants', 'merchants.id','=','parcels.merchantId')
            ->join('agents', 'parcels.agentId','=','agents.id')
            ->where('parcels.agentId', $id)
            ->orderBy('parcels.id','DESC')
            ->select('parcels.*','merchants.firstName','merchants.lastName','merchants.phoneNumber','merchants.emailAddress','merchants.companyName','merchants.status as mstatus','merchants.id as mid')
            ->get();
        $totalamount=Parcel::where(['agentId'=>$id,'status'=>4])
        ->sum('merchantDue');
        $unpaidamount=Parcel::where(['agentId'=>$id,'status'=>4])
        ->sum('merchantDue');
        return view('backEnd.agent.view',compact('agentInfo','parcels','totalamount','unpaidamount'));
    }
    
    public function bulkpayment(Request $request){
        $selectption = $request->selectptions;
        if($selectption==1){
            $payment = new Agentpayment();
            $payment->agentId = $request->agentId;
            $payment->save();
            $parcels_id = $request->parcel_id;
            foreach($parcels_id as $parcel_id){
                $parcel         =   Parcel::find($parcel_id);
                $parcel->aPayinvoice = $payment->id;
                $parcel->agentPaystatus = 1;
                $parcel->save();
            } 
            Toastr::success('message', 'Payment paid successfully!');
           return redirect()->back();
        }elseif($selectption==0){
            $parcels_id = $request->parcel_id;
            foreach($parcels_id as $parcel_id){
                $parcel         =   Parcel::find($parcel_id);
                $parcel->agentPaystatus   = 0;
                $parcel->save();
            
        }
         Toastr::success('message', 'Payment process successfully!');
         return redirect()->back();
        }
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
    	$update_data = Agent::find($request->hidden_id);
    	// image upload
    	$update_file = $request->file('image');
    	if ($update_file) {
	    	$name = time().$update_file->getClientOriginalName();
	    	$uploadPath = 'uploads/agent/';
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
        $update_data->bookcommision =   $request->bookcommision;
        $update_data->commision     =   $request->commision;
        $update_data->commisiontype =   $request->commisiontype;
    	$update_data->status 		= 	$request->status;
    	$update_data->save();
        Toastr::success('message', 'Employee update successfully!');
    	return redirect('author/agent/manage');
    }

    public function inactive(Request $request){
        $inactive_data = Agent::find($request->hidden_id);
        $inactive_data->status=0;
        $inactive_data->save();
        Toastr::success('message', 'Employee inactive successfully!');
        return redirect('author/agent/manage');      
    }

    public function active(Request $request){
        $inactive_data = Agent::find($request->hidden_id);
        $inactive_data->status=1;
        $inactive_data->save();
        Toastr::success('message', 'Employee active successfully!');
        return redirect('author/agent/manage');        
    }

    public function destroy(Request $request){
        $destroy_id = Agent::find($request->hidden_id);
        $destroy_id->delete();
        Toastr::success('message', 'Employee delete successfully!');
        return redirect('author/agent/manage');         
    }
}
