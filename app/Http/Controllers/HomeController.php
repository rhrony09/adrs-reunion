<?php

namespace App\Http\Controllers;

use App\Jobs\SMSNotification;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        return view('home');
    }

    public function debug() {
        $message = 'অভিনন্দন, রেজিস্ট্রেশন সফল হয়েছে।';

        $smsdata = [
            'message' => $message,
            'mobile' => '01839096877',
        ];
        return send_sms($message, '01839096877');
    }
}
