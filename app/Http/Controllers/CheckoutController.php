<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller {

    public function checkout(){
        $reservation = Reservation::where('client_id',Auth::guard('client')->user()->id)->latest()->first();

        \Stripe\Stripe::setApiKey('sk_test_51IZI8EJcLS5PlhtzXpcQp0aCD36SOofwqBVdAaJSxzPsxeluecKMd4czwugfKStdhbQlOxEL2IHkhRFPXNOU4oSJ00YLyaseuQ');

        $payment_intent = \Stripe\PaymentIntent::create([
            'description' => 'Stripe Test Payment',
            'amount' => $reservation->price,
            'currency' => 'USD',
            'description' => 'Payment From hotel system',
            'payment_method_types' => ['card'],
        ]);
        $intent = $payment_intent->client_secret;

        return view('clients.checkout',compact('intent','reservation'));
    }

    public function afterPayment(){
        $reservation = Reservation::where('client_id',Auth::guard('client')->user()->id)->latest()->first();
        if (!$reservation == null) {
            if ($reservation->status == 'pending') {
                $reservation->status = 'paid';
                $reservation->save();
            }
        }
        $rooms = Room::where('user_id', Auth::guard('client')->user()->user_id)->get();
        return redirect()->route('rooms.reservation',compact('rooms','reservation'));
    }
}
