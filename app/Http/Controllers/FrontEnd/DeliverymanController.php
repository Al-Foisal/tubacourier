<?php

namespace App\Http\Controllers\FrontEnd;

use App\Deliveryman;
use App\Exports\RiderParcelExport;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Session;

class DeliverymanController extends Controller {

    public function todaysPayment() {
        $allparcel = DB::table('parcels')
            ->where('parcels.deliverymanId', Session::get('deliverymanId'))
            ->where('parcels.status', 4)
            ->where('parcels.deliverymanPaystatus', null)
            ->where('parcels.agentPaystatus', null)
            ->whereDate('parcels.updated_at', today())
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->join('agents', 'agents.id', '=', 'parcels.agentId')
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'agents.name as agentname')
            ->orderBy('parcels.id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.deliveryman.todays-payment', compact('allparcel'));
    }

    public function delayPayment() {
        $allparcel = DB::table('parcels')
            ->where('parcels.deliverymanId', Session::get('deliverymanId'))
            ->where('parcels.status', 4)
            ->where('parcels.deliverymanPaystatus', null)
            ->where('parcels.agentPaystatus', null)
            ->whereDate('parcels.updated_at', '<', today())
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->join('agents', 'agents.id', '=', 'parcels.agentId')
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'agents.name as agentname')
            ->orderBy('parcels.id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.deliveryman.delay-payment', compact('allparcel'));
    }

    public function submitPayment(Request $request) {

        if ($request->parcel_id == null) {
            Toastr::error('message', 'No parcel selected');

            return redirect()->back();
        }

        $parcel = Parcel::whereIn('id', $request->parcel_id)->update(['deliverymanPaystatus' => 1]);

        Toastr::success('message', 'Parcel payment updated');

        return redirect()->back();

    }

    public function loginform() {
        return view('frontEnd.layouts.pages.deliveryman.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        $checkAuth = Deliveryman::where('email', $request->email)
            ->first();

        if ($checkAuth) {

            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');

                return redirect()->back();
            } else {

                if (password_verify($request->password, $checkAuth->password)) {
                    $deliverymanId = $checkAuth->id;
                    Session::put('deliverymanId', $deliverymanId);
                    Toastr::success('success', 'Thanks , You are login successfully');

                    return redirect('deliveryman/dashboard');

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

    public function dashboard() {
        $totalparcel = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->count();
        $totaldelivery = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 4])->count();
        $totalhold = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 5])->count();
        $totalcancel = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 9])->count();
        $returnpendin = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 6])->count();
        $returnmerchant = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 8])->count();
        $totalamount = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['status' => 4])
            ->sum('deliverymanAmount');
        $unpaidamount = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['deliverymanPaystatus' => 0])
            ->sum('deliverymanAmount');
        $paidamount = Parcel::where(function ($query) {
            $query->where('deliverymanId', Session::get('deliverymanId'));
            $query->orWhere('pickupmanId', Session::get('deliverymanId'));
        })->where(['deliverymanPaystatus' => 1])
            ->sum('deliverymanAmount');

        return view('frontEnd.layouts.pages.deliveryman.dashboard', compact('totalparcel', 'totaldelivery', 'totalhold', 'totalcancel', 'returnpendin', 'returnmerchant', 'totalamount', 'unpaidamount', 'paidamount'));
    }

    public function parcels(Request $request) {
        $filter = $request->filter_id;

        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->orWhere('parcels.pickupmanId', Session::get('deliverymanId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->orWhere('parcels.pickupmanId', Session::get('deliverymanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->orWhere('parcels.pickupmanId', Session::get('deliverymanId'))
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->orWhere('parcels.pickupmanId', Session::get('deliverymanId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.deliverymanId', Session::get('deliverymanId'))
                ->orWhere('parcels.pickupmanId', Session::get('deliverymanId'))
                ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('id', 'DESC')
                ->get();
        }

        return view('frontEnd.layouts.pages.deliveryman.parcels', compact('allparcel'));
    }

    public function parcelstatus($slug) {
        $parceltype = Parceltype::where('slug', $slug)->first();
        $allparcel  = DB::table('parcels')
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->where(function ($query) use ($parceltype) {
                $query->where('parcels.deliverymanId', Session::get('deliverymanId'));
                $query->orWhere('parcels.pickupmanId', Session::get('deliverymanId'));
            })
            ->where('parcels.status', $parceltype->id)
            ->orderBy('id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.deliveryman.parcels', compact('allparcel'));
    }

    public function invoice($id) {
        $show_data = DB::table('parcels')
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->where('parcels.deliverymanId', Session::get('deliverymanId'))
            ->join('nearestzones', 'parcels.reciveZone', '=', 'nearestzones.id')
            ->where('parcels.id', $id)
            ->select('parcels.*', 'nearestzones.zonename', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();

        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.deliveryman.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');

            return redirect()->back();
        }

    }

    public function statusupdate(Request $request) {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $parcel         = Parcel::find($request->hidden_id);
        $parcel->status = $request->status;
        $parcel->save();

        if ($request->note) {
            $note           = new Parcelnote();
            $note->parcelId = $request->hidden_id;
            $note->note     = $request->note;
            $note->save();
        }

        if ($request->status == 3) {
            $parcel         = Parcel::find($request->hidden_id);
            $parcel->status = $request->status;
            $parcel->save();

            $codcharge              = 0;
            $parcel->merchantAmount = ($parcel->merchantAmount) - ($codcharge);
            $parcel->merchantDue    = ($parcel->merchantAmount) - ($codcharge);
            $parcel->codCharge      = $codcharge;
            $parcel->save();
        } elseif ($request->status == 4) {

            $validMerchant = Merchant::find($parcel->merchantId);

            $parcel = Parcel::find($request->hidden_id);

            $otp_code = mt_rand(111111, 999999);

            $parcel->verifyToken = $otp_code;
            $parcel->save();

            $url  = "http://api.greenweb.com.bd/api.php?json";
            $data = [
                'to'      => "$parcel->recipientPhone",
                'message' => "Dear $validMerchant->firstName, Your Parcel ID $parcel->trackingCode has been delivered successfully to the customer.\n Please Verify Your Parcel Using This OTP code \n $parcel->verifyToken \n Thanks for being with Tuba courier",
                'token'   => "4dbd910d5f812da950e8727696be481b",
            ];                 // Add parameters in key value
            $ch = curl_init(); // Initialize cURL
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_exec($ch);
            curl_close($ch);

            $parcel_id = $parcel->id;

            return view('frontEnd.deliveryman_verify', compact('parcel_id'));

        } elseif ($request->status == 8) {
            $parcel                 = Parcel::find($request->hidden_id);
            $returncharge           = $parcel->deliveryCharge / 2;
            $parcel->merchantAmount = $parcel->merchantAmount - $returncharge;
            $parcel->merchantDue    = $parcel->merchantAmount - $returncharge;
            $parcel->deliveryCharge = $parcel->deliveryCharge + $returncharge;
            $parcel->save();
        }

        Toastr::success('message', 'Parcel information update successfully!');

        return redirect()->back();
    }

    public function pickup() {
        $show_data = DB::table('pickups')
            ->where('pickups.deliveryman', Session::get('deliverymanId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();

        return view('frontEnd.layouts.pages.deliveryman.pickup', compact('show_data', 'deliverymen'));
    }

    public function pickupdeliverman(Request $request) {
        $this->validate($request, [
            'deliveryman' => 'required',
        ]);
        $pickup              = Pickup::find($request->hidden_id);
        $pickup->deliveryman = $request->deliveryman;
        $pickup->save();

        Toastr::success('message', 'A deliveryman asign successfully!');

        return redirect()->back();
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $agentInfo       = Agent::find($parcel->merchantId);
        $data            = [
            'contact_mail' => $agentInfo->email,
            'ridername'    => $deliverymanInfo->name,
            'riderphone'   => $deliverymanInfo->phone,
            'codprice'     => $pickup->cod,
        ];
        $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
            $textmsg->from('info@aschi.com.bd');
            $textmsg->to($data['contact_mail']);
            $textmsg->subject('Pickup Assign Notification');
        });

    }

    public function pickupstatus(Request $request) {
        $this->validate($request, [
            'status' => 'required',
        ]);
        $pickup         = Pickup::find($request->hidden_id);
        $pickup->status = $request->status;
        $pickup->save();

        Toastr::success('message', 'Pickup status update successfully!');

        return redirect()->back();
    }

    public function passreset() {
        return view('frontEnd.layouts.pages.deliveryman.passreset');
    }

    public function passfromreset(Request $request) {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $validDeliveryman = Deliveryman::Where('email', $request->email)
            ->first();

        if ($validDeliveryman) {
            $verifyToken                     = rand(111111, 999999);
            $validDeliveryman->passwordReset = $verifyToken;
            $validDeliveryman->save();
            Session::put('resetDeliverymanId', $validDeliveryman->id);

            $data = [
                'contact_mail' => $validDeliveryman->email,
                'verifyToken'  => $verifyToken,
            ];
            $send = Mail::send('frontEnd.layouts.pages.deliveryman.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('support@aschi.com.bd');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });

            return redirect('deliveryman/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');

            return redirect()->back();
        }

    }

    public function saveResetPassword(Request $request) {
        // return "okey";
        $validDeliveryman = Deliveryman::find(Session::get('resetDeliverymanId'));

        if ($validDeliveryman->passwordReset == $request->verifyPin) {
            $validDeliveryman->password      = bcrypt(request('newPassword'));
            $validDeliveryman->passwordReset = NULL;
            $validDeliveryman->save();

            Session::forget('resetDeliverymanId');
            Session::put('deliverymanId', $validDeliveryman->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');

            return redirect('deliveryman/dashboard');
        } else {
            return $request->verifyPin;
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect()->back();
        }

    }

    public function resetpasswordverify() {

        if (Session::get('resetDeliverymanId')) {
            return view('frontEnd.layouts.pages.deliveryman.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect('forget/password');
        }

    }

    public function logout() {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');

        return redirect('deliveryman/logout');
    }

    public function export(Request $request) {
        return Excel::download(new RiderParcelExport(), 'parcel.xlsx');

    }

    // rrr
    public function parcel_verify(Request $request) {

        $input_otp = $request->otp;
        $parcel_id = $request->parcel_id;

        $parcel = Parcel::find($parcel_id);

        $merchant_parcel_otp = $parcel->verifyToken;

        if ($input_otp == $merchant_parcel_otp) {

            $codcharge              = 0;
            $parcel->merchantAmount = ($parcel->merchantAmount) - ($codcharge);
            $parcel->merchantDue    = ($parcel->merchantAmount) - ($codcharge);
            $parcel->codCharge      = $codcharge;
            $parcel->status         = 4;
            $parcel->verifyToken    = 1;

            $parcel->save();

            Toastr::success('message', 'Parcel information update successfully!');

            return redirect('deliveryman/parcels');
        } else

        if ($input_otp != $merchant_parcel_otp) {

            $parcel_id = $request->parcel_id;

            Toastr::error('message', 'Oops Your OTP Is Not Valid.Please Try Agein Or Resend New OTP.');

            return view('frontEnd.deliveryman_verify', compact('parcel_id'));

        }

    }

    public function parcel_resend(Request $request) {

//  ddd

// $codcharge=$request->customerpay/100;

// $codcharge=0;

// $parcel->merchantAmount=($parcel->merchantAmount)-($codcharge);

// $parcel->merchantDue=($parcel->merchantAmount)-($codcharge);

// $parcel->codCharge=$codcharge;
        // $parcel->save();

        $parcel        = Parcel::find($request->parcel_id);
        $validMerchant = Merchant::find($parcel->merchantId);

        $otp_code = mt_rand(111111, 999999);

        $parcel->verifyToken = $otp_code;
        $parcel->save();

        $url  = "http://api.greenweb.com.bd/api.php?json";
        $data = [
            'to'      => "$parcel->recipientPhone",
            'message' => "Dear $validMerchant->firstName, Your Parcel ID $parcel->trackingCode has been delivered successfully to the customer.\n Please Verify Your Parcel Using This OTP code \n $parcel->verifyToken \n Thanks for being with Tuba courier",
            'token'   => "4dbd910d5f812da950e8727696be481b",
        ];                 // Add parameters in key value
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        curl_close($ch);

        $parcel_id = $parcel->id;

        Toastr::success('message', 'OTP Resend Success.');

        return view('frontEnd.deliveryman_verify', compact('parcel_id'));
    }

}
