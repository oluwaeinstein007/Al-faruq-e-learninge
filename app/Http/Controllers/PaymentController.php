<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use App\Payment;

class PaymentController extends Controller
{
    public function index (String $exam) {
        $cost = [
            'jamb' => 10000,
            'waec' => 10000,
            'post-jamb' => 10000,
            'ielts' => 40000,
            'sat' => 40000
        ];
        $user = Auth::user();
        if (\array_key_exists($exam, $cost)) {
            return view('payment', [
                'exam' => $exam,
                'cost' => $cost[$exam],
                'name' => $user->name,
                'email' => $user->email,
                'paystackKey' => env('PAYSTACK_KEY')
            ]);
        }
        return redirect('home');
    }

    public function logPayment (Request $request) {
        $classes = [
            'jamb',
            'waec',
            'post-jamb',
            'ielts',
            'sat'
        ];
        $reference = $request->input('txref');
        $class = $request->input('class');
        $classIsValid = \in_array($class, $classes);
        $url = "https://api.paystack.co/transaction/verify/$reference";
        $response = Http::withToken(env('PAYSTACK_SECRET'))->get($url);
        $status = json_decode($response->body())->status;
        if ($status && $classIsValid) {
            $payment = new Payment;
            $payment->user_id = Auth::id();
            $payment->class = $request->input('class');
            $payment->transaction_reference = $reference;
            $payment->save();
            return redirect("class/$class");
        }
        return redirect('error');
    }
}
