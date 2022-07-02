<?php

namespace App\Http\Controllers\FrontEnd;

use App\Agent;
use App\Deliverycharge;
use App\Deliveryman;
use App\Exports\AgentParcelExport;
use App\Http\Controllers\Controller;
use App\Merchant;
use App\Merchantcharge;
use App\Parcel;
use App\Parcelnote;
use App\Parceltype;
use App\Pickup;
use Brian2694\Toastr\Facades\Toastr;
use DB;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Mail;
use Session;

class AgentController extends Controller {

    public function todaysPayment() {
        $allparcel = DB::table('parcels')
            ->where('parcels.agentId', Session::get('agentId'))
            ->where('parcels.status', 4)
            ->where('parcels.agentPaystatus', null)
            ->where('parcels.deliverymanId', '!=', null)
            ->where('parcels.deliverymanPaystatus', 1)
            ->whereDate('parcels.updated_at', today())
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->join('deliverymen', 'deliverymen.id', '=', 'parcels.deliverymanId')
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'deliverymen.name as deliverymanname')
            ->orderBy('parcels.id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.agent.todays-payment', compact('allparcel'));
    }

    public function delayPayment() {
        $allparcel = DB::table('parcels')
            ->where('parcels.agentId', Session::get('agentId'))
            ->where('parcels.status', 4)
            ->where('parcels.agentPaystatus', null)
            ->where('parcels.deliverymanId', '!=', null)
            ->where('parcels.deliverymanPaystatus', 1)
            ->whereDate('parcels.updated_at', '<', today())
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->join('deliverymen', 'deliverymen.id', '=', 'parcels.deliverymanId')
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'deliverymen.name as deliverymanname')
            ->orderBy('parcels.id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.agent.delay-payment', compact('allparcel'));
    }

    public function submitPayment(Request $request) {

        if ($request->parcel_id == null) {
            Toastr::error('message', 'No parcel selected');

            return redirect()->back();
        }

        $parcel = Parcel::whereIn('id', $request->parcel_id)->update(['agentPaystatus' => 1]);

        Toastr::success('message', 'Parcel payment updated');

        return redirect()->back();

    }

    public function loginform() {
        return view('frontEnd.layouts.pages.agent.login');
    }

    public function login(Request $request) {
        $this->validate($request, [
            'email'    => 'required',
            'password' => 'required',
        ]);
        $checkAuth = Agent::where('email', $request->email)
            ->first();

        if ($checkAuth) {

            if ($checkAuth->status == 0) {
                Toastr::warning('warning', 'Opps! your account has been suspends');

                return redirect()->back();
            } else {

                if (password_verify($request->password, $checkAuth->password)) {
                    $agentId = $checkAuth->id;
                    Session::put('agentId', $agentId);
                    Toastr::success('success', 'Thanks , You are login successfully');

                    return redirect('/agent/dashboard');

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
        $totalparcel    = Parcel::where(['agentId' => Session::get('agentId')])->count();
        $totaldelivery  = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 4])->count();
        $totalhold      = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 5])->count();
        $totalcancel    = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 9])->count();
        $returnpendin   = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 6])->count();
        $returnmerchant = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 8])->count();
        $totalamount    = Parcel::where(['agentId' => Session::get('agentId'), 'status' => 4])
            ->sum('cod');

        return view('frontEnd.layouts.pages.agent.dashboard', compact('totalparcel', 'totaldelivery', 'totalhold', 'totalcancel', 'returnpendin', 'returnmerchant', 'totalamount'));
    }

    public function parcelcreate() {
        $merchants = Merchant::orderBy('id', 'DESC')->get();
        $delivery  = Deliverycharge::where('status', 1)->get();

        return view('frontEnd.layouts.pages.agent.create', compact('merchants', 'delivery'));
    }

    public function parcelstore(Request $request) {
        $this->validate($request, [
            'cod'         => 'required',
            'name'        => 'required',
            'address'     => 'required',
            'phonenumber' => 'required',
        ]);

        $charge = Merchantcharge::where(['merchantId' => $request->merchantId, 'packageId' => $request->orderType])->first();

        if (!$charge) {
            $charge = Deliverycharge::where('id', $request->orderType)->first();
        }

        if ($request->weight > 1 || $request->weight != NULL) {
            $extraweight    = $request->weight - 1;
            $deliverycharge = ($charge->delivery * 1) + ($extraweight * $charge->extradelivery);
            $weight         = $request->weight;
        } else {
            $deliverycharge = $charge->delivery;
            $weight         = 1;
        }

        if ($charge->codpercent == 1) {
            $codcharge = ($request->cod * $charge->cod) / 100;
        } else {
            $codcharge = $charge->cod;
        }

        $store_parcel                   = new Parcel();
        $store_parcel->invoice_id       = rand() . time();
        $store_parcel->invoiceNo        = $request->invoiceno;
        $store_parcel->merchantId       = $request->merchantId;
        $store_parcel->percelType       = $request->parcelType;
        $store_parcel->cod              = $request->cod;
        $store_parcel->recipientName    = $request->name;
        $store_parcel->recipientAddress = $request->address;
        $store_parcel->recipientPhone   = $request->phonenumber;
        $store_parcel->productWeight    = $weight;
        $store_parcel->trackingCode     = 'TC' . mt_rand(111111, 999999);
        $store_parcel->note             = $request->note;
        $store_parcel->deliveryCharge   = $deliverycharge;
        $store_parcel->codCharge        = $codcharge;
        $store_parcel->reciveZone       = $request->reciveZone;
        $store_parcel->merchantAmount   = ($request->cod) - ($deliverycharge + $codcharge);
        $store_parcel->merchantDue      = ($request->cod) - ($deliverycharge + $codcharge);
        $store_parcel->orderType        = $request->orderType;
        $store_parcel->codType          = 1;
        $store_parcel->status           = 1;
        $store_parcel->agentId          = Session::get('agentId');
        $store_parcel->save();
        Toastr::success('Success!', 'Thanks! your parcel add successfully');

        return redirect()->back();
    }

    public function parcels(Request $request) {
        $filter = $request->filter_id;

        if ($request->trackId != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.trackingCode', $request->trackId)
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.agentId', Session::get('agentId'))
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } elseif ($request->phoneNumber != NULL || $request->phoneNumber != NULL && $request->startDate != NULL && $request->endDate != NULL) {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.agentId', Session::get('agentId'))
                ->where('parcels.recipientPhone', $request->phoneNumber)
                ->whereBetween('parcels.created_at', [$request->startDate, $request->endDate])
                ->select('parcels.*', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress', 'merchants.companyName', 'merchants.status as mstatus', 'merchants.id as mid')
                ->orderBy('id', 'DESC')
                ->get();
        } else {
            $allparcel = DB::table('parcels')
                ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
                ->where('parcels.agentId', Session::get('agentId'))
                ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
                ->orderBy('parcels.id', 'DESC')
                ->get();
        }

        $aparceltypes = Parceltype::limit(3)->get();

        return view('frontEnd.layouts.pages.agent.parcels', compact('allparcel', 'aparceltypes'));
    }

    public function parcelstatus($slug) {
        $parceltype = Parceltype::where('slug', $slug)->first();
        $allparcel  = DB::table('parcels')
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->where('parcels.agentId', Session::get('agentId'))
            ->select('parcels.*', 'merchants.companyName', 'merchants.firstName', 'merchants.lastName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->orderBy('parcels.id', 'DESC')
            ->get();

        return view('frontEnd.layouts.pages.agent.parcels', compact('allparcel'));
    }

    public function invoice($id) {
        $show_data = DB::table('parcels')
            ->join('merchants', 'merchants.id', '=', 'parcels.merchantId')
            ->where('parcels.agentId', Session::get('agentId'))
            ->join('nearestzones', 'parcels.reciveZone', '=', 'nearestzones.id')
            ->where('parcels.id', $id)
            ->select('parcels.*', 'nearestzones.zonename', 'merchants.companyName', 'merchants.phoneNumber', 'merchants.emailAddress')
            ->first();

        if ($show_data != NULL) {
            return view('frontEnd.layouts.pages.agent.invoice', compact('show_data'));
        } else {
            Toastr::error('Opps!', 'Your process wrong');

            return redirect()->back();
        }

    }

    public function delivermanasiagn(Request $request) {
        $this->validate($request, [
            'deliverymanId' => 'required',
        ]);
        $parcel                = Parcel::find($request->hidden_id);
        $parcel->deliverymanId = $request->deliverymanId;
        $parcel->save();

        Toastr::success('message', 'A deliveryman asign successfully!');

        return redirect()->back();
        $deliverymanInfo = Deliveryman::find($parcel->deliverymanId);
        $merchantinfo    = Agent::find($parcel->merchantId);
        $data            = [
            'contact_mail' => $merchantinfo->email,
            'ridername'    => $deliverymanInfo->name,
            'riderphone'   => $deliverymanInfo->phone,
            'codprice'     => $parcel->cod,
            'trackingCode' => $parcel->trackingCode,
        ];
        $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
            $textmsg->from('info@aschi.com.bd');
            $textmsg->to($data['contact_mail']);
            $textmsg->subject('Percel Assign Notification');
        });

    }

    public function statusupdate(Request $request) {
        //   return $request->all();
        $this->validate($request, [
            'status' => 'required',
        ]);
        $parcel         = Parcel::find($request->hidden_id);
        $parcel->status = $request->status;
        $parcel->save();

        $pnote          = Parceltype::find($request->status);
        $note           = new Parcelnote();
        $note->parcelId = $request->hidden_id;
        $note->note     = "Your parcel " . $pnote->title;
        $note->save();

        $deliverymanInfo = Deliveryman::where(['id' => $parcel->deliverymanId])->first();

        if ($request->status == 2 && $deliverymanInfo != NULL) {
            $merchantinfo = Agent::find($parcel->merchantId);
            $data         = [
                'contact_mail' => $merchantinfo->email,
                'ridername'    => $deliverymanInfo->name,
                'riderphone'   => $deliverymanInfo->phone,
                'codprice'     => $parcel->cod,
                'trackingCode' => $parcel->trackingCode,
            ];
            $send = Mail::send('frontEnd.emails.percelassign', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@aschi.com.bd');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Percel Assign Notification');
            });
        }

        if ($request->status == 3) {
            $codcharge              = 0;
            $parcel->merchantAmount = ($parcel->merchantAmount) - ($codcharge);
            $parcel->merchantDue    = ($parcel->merchantAmount) - ($codcharge);
            $parcel->codCharge      = $codcharge;
            $parcel->save();
        } elseif ($request->status == 4) {
            $merchantinfo = Merchant::find($parcel->merchantId);
            $data         = [
                'contact_mail' => $merchantinfo->emailAddress,
                'trackingCode' => $parcel->trackingCode,
            ];
            $send = Mail::send('frontEnd.emails.percelcancel', $data, function ($textmsg) use ($data) {
                $textmsg->from('info@aschi.com.bd');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Percel Cancelled Notification');
            });
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

    public function logout() {
        Session::flush();
        Toastr::success('Success!', 'Thanks! you are logout successfully');

        return redirect('agent/logout');
    }

    public function pickup() {
        $show_data = DB::table('pickups')
            ->where('pickups.agent', Session::get('agentId'))
            ->orderBy('pickups.id', 'DESC')
            ->select('pickups.*')
            ->get();
        $deliverymen = Deliveryman::where('status', 1)->get();

        return view('frontEnd.layouts.pages.agent.pickup', compact('show_data', 'deliverymen'));
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

        if ($request->status == 2) {
            $deliverymanInfo = Deliveryman::where(['id' => $pickup->deliveryman])->first();

// $data = array(

//  'name' => $deliverymanInfo->name,

//  'companyname' => $merchantInfo->companyName,

//  'phone' => $deliverymanInfo->phone,

//  'address' => $merchantInfo->pickLocation,

// );

// $send = Mail::send('frontEnd.emails.pickupdeliveryman', $data, function($textmsg) use ($data){

//  $textmsg->from('info@aschi.com.bd');

//  $textmsg->to($data['contact_mail']);

//  $textmsg->subject('Pickup request update');
            // });
        }

        Toastr::success('message', 'Pickup status update successfully!');

        return redirect()->back();
    }

    public function passreset() {
        return view('frontEnd.layouts.pages.agent.passreset');
    }

    public function passfromreset(Request $request) {
        $this->validate($request, [
            'email' => 'required',
        ]);
        $validAgent = Agent::Where('email', $request->email)
            ->first();

        if ($validAgent) {
            $verifyToken               = rand(111111, 999999);
            $validAgent->passwordReset = $verifyToken;
            $validAgent->save();
            Session::put('resetAgentId', $validAgent->id);

            $data = [
                'contact_mail' => $validAgent->email,
                'verifyToken'  => $verifyToken,
            ];
            $send = Mail::send('frontEnd.layouts.pages.agent.forgetemail', $data, function ($textmsg) use ($data) {
                $textmsg->from('support@tubacourier.com');
                $textmsg->to($data['contact_mail']);
                $textmsg->subject('Forget password token');
            });

            return redirect('agent/resetpassword/verify');
        } else {
            Toastr::error('Sorry! You have no account', 'warning!');

            return redirect()->back();
        }

    }

    public function saveResetPassword(Request $request) {
        $validAgent = Agent::find(Session::get('resetAgentId'));

        if ($validAgent->passwordReset == $request->verifyPin) {
            $validAgent->password      = bcrypt(request('newPassword'));
            $validAgent->passwordReset = NULL;
            $validAgent->save();

            Session::forget('resetAgentId');
            Session::put('agentId', $validAgent->id);
            Toastr::success('Wow! Your password reset successfully', 'success!');

            return redirect('agent/dashboard');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect()->back();
        }

    }

    public function resetpasswordverify() {

        if (Session::get('resetAgentId')) {
            return view('frontEnd.layouts.pages.agent.passwordresetverify');
        } else {
            Toastr::error('Sorry! Your process something wrong', 'warning!');

            return redirect('forget/password');
        }

    }

    public function export(Request $request) {
        return Excel::download(new AgentParcelExport(), 'parcel.xlsx');

    }

}
