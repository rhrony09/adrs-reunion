<?php

use App\Models\Enroll;
use App\Models\Setting;

function send_sms($msg, $number) {
    if (preg_match('/^([01]\d|2[0-4]|30)/', $number)) {
        $url = "https://sms.imbdagency.com/smsapi";
        $data = [
            "api_key" => env('SMS_API_KEY'),
            "type" => "unicode",
            "contacts" => $number,
            "senderid" => '8809601000500',
            "msg" => $msg,
        ];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}

function intEngToBn($integer) {
    $eng_digits = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    $ben_digits = ["০", "১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯"];
    return str_replace($eng_digits, $ben_digits, $integer);
}

function moneyFormatBD($num = 0) {
    $num = floor($num);
    $explrestunits = '';
    if (strlen($num) > 3) {
        $lastthree = substr($num, strlen($num) - 3, strlen($num));
        $restunits = substr($num, 0, strlen($num) - 3); // extracts the last three digits
        $restunits = strlen($restunits) % 2 == 1 ? '0' . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if ($i == 0) {
                $explrestunits .= (int) $expunit[$i] . ','; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i] . ',';
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $num;
    }
    return $thecash; // writes the final format where $currency is the currency symbol.
}
