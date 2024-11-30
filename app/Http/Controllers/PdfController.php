<?php

namespace App\Http\Controllers;


use App\Mail\PurchaseMade;
use App\Models\Purchase;
use App\Models\Ticket;
use App\Models\Order;
use Dompdf\Options;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;



class PdfController extends Controller
{
    public static function generatePdf(Purchase $purchase)

        {
            $data = [
                'typeOfPayment' => $purchase->payment_type,
                'paymentReference' => $purchase->payment_ref,
                'purchaseNumber' => $purchase->id,
                'totalPrice' => $purchase->total_price,
                'customerNif' => $purchase->nif,
                'customerEmail' => $purchase->customer_email,
                'customerName' => $purchase->customer_name,
                'dateOfPurchase' => $purchase->date,
                'tickets' => $purchase->tickets()->get()
            ];

            $pdf = Pdf::loadView('pdf/pdf', $data);
            $filename = 'purchase' . $data['purchaseNumber'];
            $pdf->save(storage_path('/app/pdf_purchases/' . $filename));
            $pdfPath = storage_path('/app/pdf_purchases/' . $filename);



            Mail::to($purchase->customer_email)->send(new PurchaseMade($data, $pdfPath));

            $purchase->receipt_pdf_filename = $filename;
            $purchase->update();


            return $pdf->stream();
    }

    public function myPdf()
    {
        $purchases = Purchase::whereHas('tickets', function ($query) {
            $query->whereHas('screeningRef', function ($query) {
                $query->whereNotNull('custom');
            });
        })
        ->where('customer_id', optional(auth()->user())->id)
        ->orderBy('created_at', 'desc')
        ->distinct()
        ->get();


        return view('pdf.myPdf')->with('purchases', $purchases);
    }

    public function viewPdf($filename)
    {
        $path = storage_path('app/pdf_purchases/' . $filename);
        if (!file_exists($path)) {
            abort(404);
        }
        return response()->file($path);
    }



}
