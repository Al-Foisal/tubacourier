<?php

namespace App\Http\Controllers\Author;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Merchantpayment;
use App\Deliverycharge;
use App\Merchantcharge;
use App\Nearestzone;
use App\Merchant;
use App\Parceltype;
use App\Parcel;
use App\Post;
use Exception;
use Auth;
use Mail;
use DB;
class MerchantOperationController extends Controller
{
    public function manage(){
    	$merchants = Merchant::orderBy('id','ASC')
    	->get();
    	
    // 	$parceltype = Parceltype::where('slug',$request->slug)->first();
    	
    	 $show_data = DB::table('parcels')
         ->join('merchants', 'merchants.id','=','parcels.merchantId')
         ->join('nearestzones', 'parcels.reciveZone','=','nearestzones.id')
         
         ->orderBy('id','DESC')
         ->select('parcels.*','nearestzones.zonename','merchants.firstName','merchants.lastName','merchants.phoneNumber','merchants.emailAddress','merchants.companyName','merchants.status as mstatus','merchants.id as mid')
        ->get();
    	
    	return view('backEnd.merchant.manage',compact('merchants', 'show_data'));
    }
    public function merchantrequest(){
    	$merchants = Merchant::where('verifyToken',0)->orderBy('id','DESC')->get();
    	return view('backEnd.merchant.merchantrequest',compact('merchants'));
    }
    public function profileedit($id){
    	$merchantInfo = Merchant::find($id);
    	$nearestzones = Nearestzone::where('status',1)->get();
        $allpackage   = Deliverycharge::where(['status'=>1])->with(['merchantcharge'=> function ($dcharge) use ($id){
            $dcharge->where('merchantId',$id);
        }])
        ->get();
    	return view('backEnd.merchant.edit',compact('merchantInfo','nearestzones','allpackage'));
    }
      // Merchant Profile Edit
        public function profileUpdate(Request $request){
        $update_merchant = Merchant::find($request->hidden_id);
        $update_merchant->phoneNumber   = $request->phoneNumber;
        $update_merchant->pickLocation  = $request->pickLocation;
        $update_merchant->nearestZone   = $request->nearestZone;
        $update_merchant->pickupPreference = $request->pickupPreference;
        $update_merchant->paymentMethod = $request->paymentMethod;
        $update_merchant->withdrawal    = $request->withdrawal;
        $update_merchant->nameOfBank    = $request->nameOfBank;
        $update_merchant->bankBranch    = $request->bankBranch;
        $update_merchant->bankAcHolder  = $request->bankAcHolder;
        $update_merchant->bankAcNo      = $request->bankAcNo;
        $update_merchant->bkashNumber   = $request->bkashNumber;
        $update_merchant->roketNumber   = $request->roketNumber;
        $update_merchant->nogodNumber   = $request->nogodNumber;
        $update_merchant->save();
        Toastr::success('message', 'Merchant  info update successfully!');
        return redirect()->back();
    }
    
    public function chargesetup(Request $request){
        $findexits = Merchantcharge::where(['merchantId'=>$request->merchantId,'packageId'=>$request->packageId])->first();
        if(!$findexits){
          $mcharge                  = new Merchantcharge();
          $mcharge->merchantId      = $request->merchantId;
          $mcharge->packageId       = $request->packageId;
          $mcharge->delivery        = $request->delivery;
          $mcharge->extradelivery   = $request->extradelivery;
          $mcharge->cod             = $request->cod;
          $mcharge->codpercent      = $request->codpercent;
          $mcharge->save();
        }else{
          $mucharge = Merchantcharge::where(['merchantId'=>$request->merchantId,'packageId'=>$request->packageId])->first();
          $mucharge->merchantId      = $request->merchantId;
          $mucharge->packageId       = $request->packageId;
          $mucharge->delivery        = $request->delivery;
          $mucharge->extradelivery   = $request->extradelivery;
          $mucharge->cod             = $request->cod;
          $mucharge->codpercent       = $request->codpercent;
          $mucharge->save();
        }
        Toastr::success('message', 'Merchant  info update successfully!');
        return redirect()->back();
    }
    
     public function inactive(Request $request){
        $inactive_merchant = Merchant::find($request->hidden_id);
        $inactive_merchant->status=0;
        $inactive_merchant->save();
        Toastr::success('message', 'Merchant  inactive successfully!');
        return redirect()->back();
    }

    public function active(Request $request){
        $active_merchant = Merchant::find($request->hidden_id);
        $active_merchant->status=1;
        $active_merchant->verifyToken=1;
        $active_merchant->save();
        
        $active_merchant = Merchant::find($request->hidden_id);
          $url = "http://premium.mdlsms.com/smsapi";
          $data = [
            "api_key" => "C20005455f867568bd8c02.20968541",
            "type" => "text",
            "contacts" => "0$active_merchant->phoneNumber",
            
            "senderid" => "8809612440738",
            "msg" => "Dear $active_merchant->companyName\r\n  Successfully boarded your account. Now you can login & enjoy our services.\r\nRegards,\r\n Zuri Express" ,
          ];
          $ch = curl_init();
          curl_setopt($ch, CURLOPT_URL, $url);
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch);
          curl_close($ch);
        Toastr::success('message', 'Merchant active successfully!');
        return redirect()->back();
        
    }
    public function view($id){
    	$merchantInfo = Merchant::find($id);

        $totalamount = DB::table('parcels')
            ->join('merchants', 'merchants.id','=','parcels.merchantId')
            ->where('parcels.merchantId', $id)
            ->sum('parcels.merchantAmount');

        $totaldue = DB::table('parcels')
            ->join('merchants', 'merchants.id','=','parcels.merchantId')
            ->where('parcels.merchantId', $id)
            ->sum('parcels.merchantDue');

        $parcels = DB::table('parcels')
            ->join('merchants', 'merchants.id','=','parcels.merchantId')
            ->where('parcels.merchantId', $id)
            ->orderBy('parcels.id','DESC')
            ->select('parcels.*','merchants.firstName','merchants.lastName','merchants.phoneNumber','merchants.emailAddress','merchants.companyName','merchants.status as mstatus','merchants.id as mid')
            ->get();
    	return view('backEnd.merchant.view',compact('merchantInfo','totalamount','totaldue','parcels'));
    }
    public function paymentinvoice($id){
        $merchantInvoice = Merchantpayment::where('merchantId',$id)->get();
        return view('backEnd.merchant.paymentinvoice',compact('merchantInvoice'));
    }
    public function inovicedetails($id){
        $invoiceInfo = Merchantpayment::find($id);
        $inovicedetails = Parcel::where(['paymentInvoice'=>$id,'merchantId'=>$invoiceInfo->merchantId])->get();
        $merchantInfo = Merchant::find($invoiceInfo->merchantId);
        return view('backEnd.merchant.inovicedetails',compact('inovicedetails','invoiceInfo','merchantInfo'));
    }
    
    
    public function delete($id){
        $info = Merchant::find($id);
        $info->delete();
             Toastr::success('message', 'Merchant delete successfully!');
        return redirect()->back();
    }
}
