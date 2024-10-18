<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Discipline;
use App\Models\Seat;
use App\Http\Requests\CartConfirmationFormRequest;
use App\Models\Ticket;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
use App\Models\Customer;
use App\Models\Screening;
use App\Models\Movie;
use App\Models\Payment;
use App\Models\Theater;


class CartController extends Controller
{


    public function show(): View
    {
        $cart = session('cart', null);
        return view('cart.show', compact('cart'));
    }



    public function addToCart(Request $request, $screeningId): RedirectResponse
    {
        $cart = session('cart', collect());
        $selectedSeats = json_decode($request->input('selected_seats'), true);
        $cart = session('cart', []);
        if (auth()->check()) {
            $price = DB::table('configuration')->value('ticket_price') - (DB::table('configuration')->value('registered_customer_ticket_discount'));
        } else {
            $price = DB::table('configuration')->value('ticket_price');
        }
        foreach ($selectedSeats as $seatId) {
            $exists = collect($cart)->contains(function ($item) use ($seatId, $screeningId) {
                return $item['seatId'] == $seatId && $item['screeningId'] == $screeningId;
            });

            if (!$exists) {
                $cart[] = [
                    'seatId' => $seatId,
                    'screeningId' => $screeningId,
                    'price' => $price,
                    'movie' => Movie::find(Screening::find($screeningId)->movie_id)->title,
                    'hora' => Screening::find($screeningId)->start_time,
                    'theater' => Theater::find(Screening::find($screeningId)->theater_id)->name,
                ];
            }
        }

        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function removeFromCart(Request $request, $seatId, $screeningId): RedirectResponse
    {
        $cart = session('cart', []);
        $cart = array_filter($cart, function ($item) use ($seatId, $screeningId) {
            return $item['seatId'] != $seatId || $item['screeningId'] != $screeningId;
        });
        session(['cart' => $cart]);
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->session()->forget('cart');
        return back()
            ->with('alert-type', 'success')
            ->with('alert-msg', 'Shopping Cart has been cleared');
    }


    public function confirm(CartConfirmationFormRequest $request): RedirectResponse
    {
        $cart = session('cart', null);
        
        if (empty($cart)) {
            return back()
               ->with('alert-type', 'danger')
                ->with('alert-msg', "Cart was not confirmed, because cart is empty!");
        } else {
            $payment_type = $request->payment_type;
            $userEmail = $request->email;
            $nif = $request->nif;


            $card_number = $request->card_number;
            $cvc_code = $request->cvc_code;
            $email_address = $request->email_address;
            $phone_number = $request->phone_number;

            $payment = new Payment();
            $valid = $payment->isValidPayment($payment_type, $card_number, $cvc_code, $email_address, $phone_number);

            if(!$valid){
                return back()
                    ->with('alert-type', 'danger')
                    ->with('alert-msg', "Cart was not confirmed, because payment is invalid!");
            }

            $totalPrice = 0;
            foreach ($cart as $item) {
                $totalPrice += $item['price'];
            }

            $userName = $request->name;
            $customer_id = null;

            if($payment_type == 'VISA'){
                $payment_ref = $request->card_number;
            }elseif($payment_type == 'PAYPAL'){
                $payment_ref = $request->email_address;
            }elseif($payment_type == 'MBWAY'){
                $payment_ref = $request->phone_number;
            }

            if(auth()->check()){
                $user = auth()->user();
                $customer = $user->customer()->first();
                $customer_id = $customer->id;
            }

            $purchase = Purchase::create([
                'date' => date('Y-m-d H:i:s'),
                'total_price' => $totalPrice,
                'customer_name' => $userName,
                'customer_email' => $userEmail,
                'payment_type' => $payment_type,
                'payment_ref' => $payment_ref,
                'customer_id' => $customer_id,
                'nif' => $nif
            ]);

            foreach ($cart as $item) {
                $qr_code = md5(uniqid(rand(), true));
                $seat = $item['seatId'];
                $screeningId = $item['screeningId'];
                $price = $item['price'];
                Ticket::create([
                    'screening_id' => $screeningId,
                    'seat_id' => $seat,
                    'purchase_id' => $purchase->id,
                    'price' => $price,
                    'qrcode_url' => $qr_code,
                ]);
            }

        }
        $request->session()->forget('cart');

        return redirect()->route('pdf.generatePdf', ['purchase' => $purchase]);

    }


    public function form(): View
    {
        $cart = session('cart', null);
        return view('cart.form', compact('cart'));
    }

}
