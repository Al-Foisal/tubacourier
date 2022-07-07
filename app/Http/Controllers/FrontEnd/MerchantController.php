<?php

namespace App\Http\Controllers\FrontEnd;

use App\Codcharge;
use App\Deliverycharge;
use App\Deliveryman;
use App\Exports\ParcelExport;
use App\Http\Controllers\Controller;
use App\Imports\ParcelImport;
use App\Merchant;
use App\Merchantcharge;
use App\Merchantpayment;
use App\Nearestzone;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use App\Pickup;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Session;

class MerchantController extends Controller {

    public function registerpage() {
        return view('frontEnd.layouts.pages.register');
    }

    public function register(Request $request) {
        $this->validate($request, [
            'companyName'  => 'required',
            'firstName'    => 'required',
            'phoneNumber'  => 'unique:merchants',
            'emailAddress' => 'unique:merchants',
            'password'     => 'required|same:confirmed',
            'confirmed'    => 'required',
        ]);
        //   return $request->all();
        $marchentCheck = Merchant::where('phoneNumber', $request->phoneNumber)->where('emailAddress', $request->emailAddress)->first();

        if ($marchentCheck) {
            Toastr::error('message', 'Opps! your cradential already used');

            return redirect()->back();
        } else {
            $store_data               = new Merchant();
            $verifyToken              = rand(111111, 999999);
            $store_data->companyName  = $request->companyName;
            $store_data->firstName    = $request->firstName;
            $store_data->lastName     = $request->lastName;
            $store_data->phoneNumber  = $request->phoneNumber;
            $store_data->emailAddress = $request->emailAddress;
            $store_data->agree        = $request->agree;
            $store_data->status       = 1;
            $store_data->verifyToken  = $verifyToken;
            $store_data->password     = bcrypt(request('password'));
            $store_data->save();

            $url  = "http://premium.mdlsms.com/smsapi";
            $data = [
                "api_key"  => "C20005455f867568bd8c02.20968541",
                "type"     => "Text",
                "contacts" => $request->phoneNumber,
                "senderid" => "8809612440738",
                "msg"      => "Dear $request->companyName\r\nSuccessfully boarded your account. Your verified token is	$verifyToken .\r\nRegards,\r\n Tuba courier",
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            // return $response;
            curl_close($ch);

            Session::put('phoneverify', $store_data->phoneNumber);
            Toastr::success('message', 'Registration Successfully !!');

            return redirect('merchant/phone-verify');

        }

    }

    public function loginpage() {
        return view('frontEnd.layouts.pages.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'phoneOremail' => 'required',
            'password'     => 'required',
        ]);

        $merchantChedk = Merchant::orWhere('emailAddress', $request->phoneOremail)
            ->orWhere('phoneNumber', $request->phoneOremail)
            ->first();

        if ($merchantChedk) {

            if ($merchantChedk->status == 0 || $merchantChedk->verifyToken == 0) {
                Toastr::warning('warning', 'Opps! your account has been review');

                return redirect()->back();
            } else {

                if (password_verify($request->password, $merchantChedk->password)) {
                    $merchantId = $merchantChedk->id;
                    Session::put('merchantId', $merchantId);
                    Toastr::success('success', 'Thanks , You are login successfully');

                    return redirect('/merchant/dashboard');

                } else {
                    Toastr::error('Opps!', 'Sorry! your password wrong');

                    return redirect()->back();
                }

            }

        } else {
            Toastr::error('Opps!', 'Opps! you have no account');

            return redirect()->back();
        }

    }

    public function phoneVerifyForm() {
        $phoneverify = Session::get('phoneverify');

        if ($phoneverify == !NULL) {
            return view('frontEnd.layouts.pages.merchant.verify');
        } else {
            Toastr::error('!Opps', 'Your process is invalid');

            return redirect('/');
        }

    }

    public function phoneresendcode(Request $request) {
        $merchantInfo              = Merchant::where('phoneNumber', Session::get('phoneverify'))->first();
        $verifyToken               = rand(1111, 9999);
        $merchantInfo->verifyToken = $verifyToken;
        $merchantInfo->save();
        $url  = "http://premium.mdlsms.com/smsapi";
        $data = [
            "api_key"  => "C20005455f867568bd8c02.20968541",
            "type"     => "Text",
            "contacts" => '0' . $merchantInfo->phoneNumber,
            "senderid" => "8809612440738",
            "msg"      => "Your verify Token is $verifyToken ,Thanks for using our services",
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);
        Toastr::success('!Done', 'We send a OTP in your phone');

        return redirect('merchant/phone-verify');

    }

    public function phoneVerify(Request $request) {
        $this->validate($request, [
            'verifyToken' => 'required',
        ]);
        $verified = Merchant::where('phoneNumber', Session::get('phoneverify'))->first();
        // dd($verified);
        $verifydbtoken   = $verified->verifyToken;
        $verifyformtoken = $request->verifyToken;

        if ($verifydbtoken == $verifyformtoken) {
            $verified->verifyToken = 1;
            $verified->status      = 1;
            $verified->save();
            Session::put('merchantId', $verified->id);
            Session::forget('phoneverify');
            Toastr::success('Your account is verified', 'success!');

            return redirect('merchant/dashboard');
        } else {
            Toastr::error('sorry your verify token wrong', 'Opps!');

            return redirect()->back();
        }

    }

    // Merchant Login Function End

    public function dashboard() {

        $deliverd = Parcel::where(['merchantId' => Session::get('merchantId'), 'merchantpayStatus' => 1])->sum('merchantAmount');

        $cancelled = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->sum('merchantAmount');

        $merchantdue     = Parcel::where(['merchantId' => Session::get('merchantId')])->sum('merchantDue');
        $deliverdparcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->count();

        $pardeliverdparcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->count();

        $canelledparcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->count();

        $deliverycharge = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->sum('deliveryCharge');
        $codcharge      = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->sum('codCharge');

        $pendingparcels        = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->count();
        $lastdaypendingparcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->whereDay('created_at', '>=', Carbon::now()->subdays(1))->count();

        $pendingamount = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->sum('merchantAmount');

        $last24hourparcels = Parcel::where(['merchantId' => Session::get('merchantId')])->whereDay('created_at', '>=', Carbon::now()->subdays(1))->count();
        $last24hourtk      = Parcel::where(['merchantId' => Session::get('merchantId')])->whereDay('created_at', '>=', Carbon::now()->subdays(1))->sum('merchantAmount');

        $totalparcels = Parcel::where(['merchantId' => Session::get('merchantId')])->count();

        $totalamount = Parcel::where(['merchantId' => Session::get('merchantId')])->sum('merchantAmount');

        $inreviewdparcels = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 0])->count();

        $placepercel     = Parcel::where(['merchantId' => Session::get('merchantId')])->count();
        $pendingparcel   = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->count();
        $intransitparcel = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 1])->count();

        $cancelparcel   = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 9])->count();
        $collectamount  = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 10])->count();
        $totalpaid      = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 11])->count();
        $parcelreturn   = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 8])->count();
        $totalhold      = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 5])->count();
        $merchantUnPaid = Parcel::where(['merchantId' => Session::get('merchantId'), 'status' => 4])->whereNull('merchantpayStatus')->sum('merchantAmount');
        $merchantPaid   = Parcel::where(['merchantId' => Session::get('merchantId'), 'merchantpayStatus' => 1])->sum('merchantAmount');

        return view('frontEnd.layouts.pages.merchant.dashboard', compact('placepercel', 'pendingparcel', 'deliverd', 'parcelreturn', 'cancelparcel', 'totalhold', 'totalamount', 'merchantUnPaid', 'merchantPaid', 'collectamount', 'totalpaid', 'intransitparcel', 'cancelled', 'merchantdue', 'deliverdparcels', 'pardeliverdparcels', 'canelledparcels', 'deliverycharge', 'codcharge', 'pendingparcels', 'lastdaypendingparcels', 'pendingamount', 'last24hourparcels', 'last24hourtk', 'totalparcels', 'inreviewdparcels'));
    }

    // Merchant Dashboard
    public function profile() {
        $profileinfos = Merchant::all();

        return view('frontEnd.layouts.pages.merchant.profile', compact('profileinfos'));

    }

    public function profileEdit() {
        $profileinfos = Merchant::all();
        $nearestzones = Nearestzone::where('status', 1)->get();

        return view('frontEnd.layouts.pages.merchant.profileedit', compact('nearestzones'));

    }

    public function support() {
        return view('frontEnd.layouts.pages.merchant.support');
    }

    // Merchant Profile Edit
    public function profileUpdate(Request $request) {
        $update_merchant = Merchant::find(Session::get('merchantId'));

        $update_image = $request->file('logo');

        if ($update_image) {
            $file       = $request->file('logo');
            $name       = $file->getClientOriginalName();
            $uploadPath = 'uploads/merchant/';
            File::delete(public_path() . 'uploads/merchant', $update_merchant->logo);
            $file->move($uploadPath, $name);
            $fileUrl = $uploadPath . $name;
        } else {
            $fileUrl = $update_merchant->logo;
        }

        $update_merchant->logo             = $fileUrl;
        $update_merchant->phoneNumber      = $request->phoneNumber;
        $update_merchant->pickLocation     = $request->pickLocation;
        $update_merchant->nearestZone      = $request->nearestZone;
        $update_merchant->pickupPreference = $request->pickupPreference;
        $update_merchant->paymentMethod    = $request->paymentMethod;
        $update_merchant->withdrawal       = $request->withdrawal;
        $update_merchant->nameOfBank       = $request->nameOfBank;
        $update_merchant->bankBranch       = $request->bankBranch;
        $update_merchant->bankAcHolder     = $request->bankAcHolder;
        $update_merchant->bankAcNo         = $request->bankAcNo;
        $update_merchant->bkashNumber      = $request->bkashNumber;
        $update_merchant->roketNumber      = $request->roketNumber;
        $update_merchant->nogodNumber      = $request->nogodNumber;
        $update_merchant->save();

        return redirect()->back()->with('success', 'Your account update successfully');
    }

    // Merchant Profile Update
    public function logout() {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');

        return redirect('/merchant/login');
    }

// Merchant Logout

    //Parcel Oparation
    public function parcelcreate() {
        $packages = Deliverycharge::where('status', 1)->get();
        Session::forget('codpay');
        Session::forget('pdeliverycharge');
        Session::forget('pcodecharge');

        return view('frontEnd.layouts.pages.merchant.parcelcreate', compact('packages'));
    }

    public function parcelstore(Request $request) {
        $this->validate($request, [
            'cod'         => 'required',
            'percelType'  => 'required',
            'name'        => 'required',
            'address'     => 'required',
            'phonenumber' => 'required',
            'sale_price'  => 'required|min:2',
            'invoice_id'  => 'required|min:2',
        ]);

        if ($request->weight > 1 || $request->weight != NULL) {
            $extraweight    = $request->weight - 1;
            $deliverycharge = (Session::get('deliverycharge') * 1) + ($extraweight * Session::get('extradeliverycharge'));
            $weight         = $request->weight;
        } else {
            $deliverycharge = (Session::get('deliverycharge'));
            $weight         = 1;
        }

        $codtype = Merchantcharge::where(['merchantId' => Session::get('merchantId'), 'packageId' => $request->package])->first();

        if ($codtype == NULL) {
            $codtype = Deliverycharge::where(['id' => $request->package])->first();
        }

        if ($codtype->codpercent == 1) {
            $codcharge = ($request->cod * $codtype->cod) / 100;
        } else {
            $codcharge = $codtype->cod;
        }

        $store_parcel                   = new Parcel();
        $store_parcel->invoiceNo        = $request->invoiceno;
        $store_parcel->merchantId       = Session::get('merchantId');
        $store_parcel->cod              = $request->cod;
        $store_parcel->sale_price       = $request->sale_price;
        $store_parcel->invoice_id       = $request->invoice_id;
        $store_parcel->percelType       = $request->percelType;
        $store_parcel->recipientName    = $request->name;
        $store_parcel->recipientAddress = $request->address;
        $store_parcel->recipientPhone   = $request->phonenumber;
        $store_parcel->productWeight    = $weight;
        $store_parcel->trackingCode     = 'TC' . mt_rand(111111, 999999);
        $store_parcel->note             = $request->note;
        $store_parcel->deliveryCharge   = $deliverycharge;
        $store_parcel->codCharge        = $codcharge;
        $store_parcel->division_id      = $request->division_id;
        $store_parcel->up_district_id   = $request->district_id;
        $store_parcel->area_id          = $request->area_id;
        $store_parcel->reciveZone       = $request->reciveZone;
        $store_parcel->productPrice     = $request->productPrice;
        $store_parcel->merchantAmount   = ($request->cod) - ($deliverycharge + $codcharge);
        $store_parcel->merchantDue      = ($request->cod) - ($deliverycharge + $codcharge);
        $store_parcel->orderType        = $request->package;
        $store_parcel->codType          = 1;
        $store_parcel->status           = 1;
        $store_parcel->save();

        $note           = new Parcelnote();
        $note->parcelId = $store_parcel->id;
        $note->note     = 'parcel create successfully';

//  $note->save();

// $data = array(

//     'trackingCode' =>  $store_parcel->trackingCode,

//     'subject' => 'New Parcel Place',

//    );

//     // return $data;

//     $send = Mail::send('frontEnd.emails.parcelplace', $data, function($textmsg) use ($data){

//     $textmsg->to('contact@8809612440738.com.bd');

//     $textmsg->subject($data['subject']);
        //    });

        Toastr::success('Success!', 'Thanks! your parcel add successfully');

        return redirect()->back();
    }

    public function pickuprequest(Request $request) {
        $this->validate($request, [
            'pickupAddress' => 'required',
        ]);

        $date       = date('Y-m-d');
        $findpickup = Pickup::where('date', $date)->Where('merchantId', Session::get('merchantId'))->count();

        if ($findpickup) {
            Toastr::error('Opps!', 'Sorry! your pickup request already pending');

            return redirect()->back();
        } else {
            $store_pickup                = new Pickup();
            $store_pickup->merchantId    = Session::get('merchantId');
            $store_pickup->pickuptype    = $request->pickuptype;
            $store_pickup->area          = $request->area;
            $store_pickup->pickupAddress = $request->pickupAddress;
            $store_pickup->note          = $request->note;
            $store_pickup->date          = $date;
            $store_pickup->estimedparcel = $request->estimedparcel;
            $store_pickup->save();
            Toastr::success('Success!', 'Thanks! your pickup request send  successfully');

            return redirect()->back();
        }

    }

    public function pickup() {
        $show_data = DB::table('pickups')
            ->where('pickups.merchantId', Session::get('merchantId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();

        return view('frontEnd.layouts.pages.merchant.pickup', compact('show_data', 'deliverymen'));
    }

    public function parcels(Request $request) {
        $filter = $request->filter_id;

        if ($request->trackId != NULL) {
            $allparcel = Parcel::where('merchantId', Session::get('merchantId'))
                ->where('trackingCode', $request->trackId)
                ->with('merchant', 'division', 'district', 'area', 'union')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL) {
            $allparcel = Parcel::where('merchantId', Session::get('merchantId'))
                ->where('recipientPhone', $request->phoneNumber)
                ->with('merchant', 'division', 'district', 'area', 'union')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = Parcel::where('merchantId', Session::get('merchantId'))
                ->whereBetween('created_at', [$request->startDate, $request->endDate])
                ->with('merchant', 'division', 'district', 'area', 'union')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = Parcel::where('merchantId', Session::get('merchantId'))
                ->where('recipientPhone', $request->phoneNumber)
                ->whereBetween('created_at', [$request->startDate, $request->endDate])
                ->with('merchant', 'division', 'district', 'area', 'union')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $allparcel = Parcel::where('merchantId', Session::get('merchantId'))
                ->with('merchant', 'division', 'district', 'area', 'union')
                ->get();
        }

        return view('frontEnd.layouts.pages.merchant.parcels', compact('allparcel'));
    }

    public function parcelstatus($slug) {
        $parceltype = Parceltype::where('slug', $slug)->first();
        $allparcel  = Parcel::where('merchantId', Session::get('merchantId'))
            ->where('status', $parceltype->id)
            ->with('merchant', 'division', 'district', 'area', 'union')
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.merchant.allparcel', compact('allparcel'));
    }

    public function parceldetails($id) {
        $parceldetails = Parcel::where(['merchantId' => Session::get('merchantId'), 'id' => $id])
            ->with('merchant', 'division', 'district', 'area', 'union')
            ->first();
        $trackInfos = Parcelnote::where('parcelId', $id)->orderBy('id', 'ASC')->with('notes')->get();

        return view('frontEnd.layouts.pages.merchant.parceldetails', compact('parceldetails', 'trackInfos'));
    }

    public function invoice($id) {
        $show_data = Parcel::where('merchantId', Session::get('merchantId'))
            ->where('parcels.id', $id)
            ->with('merchant', 'division', 'district', 'area', 'union')
            ->first();

        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.merchant.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');

            return redirect()->back();
        }

    }

    public function parceledit($id) {
        $parceledit = Parcel::where(['merchantId' => Session::get('merchantId'), 'id' => $id])->first();

        if ($parceledit != NULL) {
            $ordertype = Deliverycharge::find($parceledit->orderType);
            $codcharge = Codcharge::find($parceledit->codType);
            $areas     = Nearestzone::where('status', 1)->get();
            Session::put('codpay', $parceledit->cod);
            Session::put('pcodecharge', $parceledit->codCharge);
            Session::put('pdeliverycharge', $parceledit->deliveryCharge);

            return view('frontEnd.layouts.pages.merchant.parceledit', compact('ordertype', 'codcharge', 'parceledit', 'areas'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');

            return redirect()->back();
        }

    }

    public function parcelupdate(Request $request) {
        $this->validate($request, [
            'cod'         => 'required',
            'name'        => 'required',
            'address'     => 'required',
            'phonenumber' => 'required',
        ]);

// fixed delivery charge
        if ($request->weight > 1 || $request->weight != NULL) {
            $extraweight    = $request->weight - 1;
            $deliverycharge = (Session::get('deliverycharge') * 1) + ($extraweight * Session::get('extradeliverycharge'));
            $weight         = $request->weight;
        } else {
            $deliverycharge = (Session::get('deliverycharge'));
            $weight         = 1;
        }

        $codtype = Merchantcharge::where(['merchantId' => Session::get('merchantId'), 'packageId' => $request->package])->first();
        if ($codtype->codpercent == 1) {
            $codcharge = ($request->cod * $codtype->cod) / 100;
        } else {
            $codcharge = $codtype->cod;
        }

        $update_parcel                   = Parcel::find($request->hidden_id);
        $update_parcel->invoiceNo        = $request->invoiceno;
        $update_parcel->merchantId       = Session::get('merchantId');
        $update_parcel->cod              = $request->cod;
        $update_parcel->percelType       = $request->percelType;
        $update_parcel->recipientName    = $request->name;
        $update_parcel->recipientAddress = $request->address;
        $update_parcel->recipientPhone   = $request->phonenumber;
        $update_parcel->productWeight    = $weight;
        $update_parcel->note             = $request->note;
        $update_parcel->division_id      = $request->division_id;
        $update_parcel->up_district_id   = $request->district_id;
        $update_parcel->area_id          = $request->area_id;
        $update_parcel->reciveZone       = $request->reciveZone;
        $update_parcel->deliveryCharge   = $deliverycharge;
        $update_parcel->codCharge        = $codcharge;
        $update_parcel->merchantAmount   = ($request->cod) - ($deliverycharge + $codcharge);
        $update_parcel->merchantDue      = ($request->cod) - ($deliverycharge + $codcharge);
        $update_parcel->orderType        = $request->package;
        $update_parcel->codType          = 1;
        $update_parcel->save();
        Toastr::success('Success!', 'Thanks! your parcel update successfully');

        return redirect()->back();
    }

    public function singleservice(Request $request) {
        $data = [
            'contact_mail' => 'info@8809612440738.com.bd',
            'address'      => $request->address,
            'area'         => $request->area,
            'note'         => $request->note,
            'estimate'     => $request->estimate,
        ];
        $send = Mail::send('frontEnd.emails.singleservice', $data, function ($textmsg) use ($data) {
            $textmsg->to($data['contact_mail']);
            $textmsg->subject('A Single Service Request');
        });
        Toastr::success('Success!', 'Thanks! your  request send successfully');

        return redirect()->back();
    }

    public function payments() {
        $merchantInvoice = Merchantpayment::where('merchantId', Session::get('merchantId'))->get();

        return view('frontEnd.layouts.pages.merchant.payments', compact('merchantInvoice'));
    }

    public function inovicedetails($id) {
        $invoiceInfo    = Merchantpayment::find($id);
        $inovicedetails = Parcel::where('paymentInvoice', $id)->get();

        return view('frontEnd.layouts.pages.merchant.inovicedetails', compact('inovicedetails', 'invoiceInfo'));
    }

    public function passreset() {
        return view('frontEnd.layouts.pages.passreset');
    }

    public function passfromreset(Request $request) {
        $this->validate($request, [
            'phoneNumber' => 'required',
        ]);
        $validMerchant = Merchant::Where('phoneNumber', $request->phoneNumber)
            ->first();
        if ($validMerchant) {

            $verifyToken                  = rand(111111, 999999);
            $validMerchant->passwordReset = $verifyToken;
            $validMerchant->save();
            Session::put('resetCustomerId', $validMerchant->id);

//  $data = array(

//  'contact_mail' => $validMerchant->phoneNumber,

//  'verifyToken' => $verifyToken,

// );

// $send = Mail::send('frontEnd.emails.passwordreset', $data, function($textmsg) use ($data){

//  $textmsg->from('info@8809612440738.com.bd');

//  $textmsg->to($data['contact_mail']);

//  $textmsg->subject('Forget password token');
            // });

            $url  = "http://premium.mdlsms.com/smsapi";
            $data = [
                "api_key"  => "C20005455f867568bd8c02.20968541",
                "type"     => "text",
                "contacts" => $validMerchant->phoneNumber,
                "senderid" => "8809612440738",
                "msg"      => "Dear $validMerchant->firstName, \r\n Your password reset token is $verifyToken. Enjoy our services. If any query call us 01310-271166\r\nRegards\r\nTuba courier ",
            ];
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($ch);
            curl_close($ch);

            return redirect('/merchant/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');

            return redirect()->back();
        }

    }

    public function resetpasswordverify() {

        if (Session::get('resetCustomerId')) {
            return view('frontEnd.layouts.pages.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect('forget/password');
        }

    }

    public function saveResetPassword(Request $request) {
        $validMerchant = Merchant::find(Session::get('resetCustomerId'));

        if ($validMerchant->passwordReset == $request->verifyPin) {
            $validMerchant->password      = bcrypt(request('newPassword'));
            $validMerchant->passwordReset = NULL;
            $validMerchant->save();

            Session::forget('resetCustomerId');
            Session::put('merchantId', $validMerchant->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');

            return redirect('/merchant/dashboard');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect()->back();
        }

    }

    public function parceltrack(Request $request) {
        $trackparcel = Parcel::where('trackingCode', 'LIKE', '%' . $request->trackid . "%")
            ->with('merchant', 'division', 'district', 'area', 'union')
            ->orderBy('id', 'DESC')
            ->first();

        if ($trackparcel) {
            $trackInfos = Parcelnote::where('parcelId', $trackparcel->id)->orderBy('id', 'ASC')->get();

            return view('frontEnd.layouts.pages.merchant.trackparcel', compact('trackparcel', 'trackInfos'));
        } else {
            return redirect()->back();
        }

    }

    public function import(Request $request) {
        Excel::import(new ParcelImport(), request()->file('excel'));
        Toastr::success('Wow! Bulk uploaded', 'success!');

        return redirect()->back();
    }

    public function export(Request $request) {
        return Excel::download(new ParcelExport(), 'parcel.xlsx');

    }

    public function index() {
        return view('frontEnd.layouts.pages.merchant.changepass');
    }

    public function changepassword(Request $request) {
        $this->validate($request, [
            'old_password'          => 'required',
            'new_password'          => 'required',
            'password_confirmation' => 'required_with:new_password|same:new_password|',
        ]);

        $user     = Merchant::find(Session::get('merchantId'));
        $hashPass = $user->password;

        if (Hash::check($request->old_password, $hashPass)) {

            $user->fill([
                'password' => Hash::make($request->new_password),
            ])->save();

            Toastr::success('message', 'Password changed successfully!');

            return back();
        } else {
            Toastr::error('message', 'Old password not match!');

            return back();
        }

    }

}
