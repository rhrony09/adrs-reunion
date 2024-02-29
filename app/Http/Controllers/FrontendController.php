<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnrollStoreRequest;
use App\Jobs\SMSNotification;
use App\Mail\NewEnroll;
use App\Models\Batch;
use App\Models\Enroll;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontendController extends Controller {
    public function index() {
        return view('frontend.index', [
            'batches' => Batch::all(),
        ]);
    }

    public function enroll(EnrollStoreRequest $request) {
        $last_enroll = Enroll::latest()->first();
        if (is_null($last_enroll)) {
            $token = Setting::where('key', 'token')->first()->value;
        } else {
            $token = $last_enroll->token + 1;
        }

        $enroll = Enroll::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'batch_id' => $request->batch,
            'payment_method' => $request->payment_method,
            'transaction' => $request->transaction,
            'tshirt_size' => $request->tshirt_size,
            'guest' => $request->guest,
            'token' => $token,
            'amount' => $request->amount,
        ]);

        $message = 'অভিনন্দন, রেজিস্ট্রেশন সফল হয়েছে। আপনার টোকেন নং: ' . intEngToBn($token) . '
ধন্যবাদ';

        $smsdata = [
            'message' => $message,
            'mobile' => $request->mobile,
        ];

        Mail::to('rhrony0009@gmail.com')->send(new NewEnroll($enroll));
        dispatch(new SMSNotification($smsdata));

        return response()->json([
            'success' => true,
            'message' => 'রেজিস্ট্রেশন সফল হয়েছে',
            'data' => 'অভিনন্দন, রেজিস্ট্রেশন সফল হয়েছে। আপনার টোকেন নং: ' . intEngToBn($token),
        ]);
    }
}
