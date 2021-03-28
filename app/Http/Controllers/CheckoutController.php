<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class CheckoutController extends Controller {

    public function checkout($request){

        dd($request);
        // Enter Your Stripe Secret
        \Stripe\Stripe::setApiKey('sk_test_51IZI8EJcLS5PlhtzXpcQp0aCD36SOofwqBVdAaJSxzPsxeluecKMd4czwugfKStdhbQlOxEL2IHkhRFPXNOU4oSJ00YLyaseuQ');

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $request->price,
            'currency' => 'USD',
            'description' => 'Payment From hotel system',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('checkout.credit-card',compact('intent'));
    }

    public function afterPayment(){
        $rooms = Room::where('user_id', Auth::guard('client')->user()->user_id)->get();
        return redirect()->route('rooms.reservation',compact('rooms'));
    }
}
