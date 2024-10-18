<?php
namespace App\Http\Controllers;

use App\Models\Screening;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Purchase;



class TicketController extends Controller
{
    public function index(Screening $screening): View
    {

        $theater = $screening->theaterRef;
        $seats = $theater->seats;


        return view('screenings.show', compact('screening', 'seats'));
    }



    public function purchase(Request $request, Screening $screening)
    {
        // Handle seat selection and redirect to payment
        // Validate selected seats
        $validated = $request->validate([
            'seats' => 'required|array|min:1',
            'seats.*' => 'exists:seats,id'
        ]);

        // Create tickets
        foreach ($validated['seats'] as $seatId) {
            Ticket::create([
                'screening_id' => $screening->id,
                'seat_id' => $seatId,
                'movie_id' => $screening->movie_id,
                'purchase_id' => null, // Replace with actual purchase logic
                'price' => 10.00, // Replace with dynamic pricing
                'qrcode_url' => null, // Generate QR code if needed
                'status' => 'reserved',
            ]);
        }

        // Redirect to payment page (Assume you have a payment route)
        return redirect()->route('payment.index', ['screening' => $screening]);
    }

    public function showTickets(Purchase $purchase)
    {
        $tickets = $purchase->tickets()->get();
        return view('tickets.show', ['tickets' => $tickets]);
    }

    //show qr code for ticket
    public function showQr(Ticket $ticket)
    {
        $user = $ticket->purchaseRef->customerRef?->user();
        return view('tickets.showQrCode', ['ticket' => $ticket, 'user' => $user]);
    }

    public function validation(Request $request)
    {
        $qrcode_url = $request->route('qrcode_url');
        $ticket = Ticket::where('qrcode_url', $qrcode_url)->first();
        $user = $ticket->purchaseRef?->customerRef?->user();
        return view('tickets.showQrCode', ['ticket' => $ticket, 'user' => $user]);
    }



    //invalidate ticket
    public function invalidateTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'invalid';
        $ticket->save();
        return redirect()->back();
    }

}

