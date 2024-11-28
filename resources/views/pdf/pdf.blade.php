<!doctype html>
<html lang='en'>

<head>
    <title>Purchase {{ $purchaseNumber }}</title>
    <meta charset='utf-8'>
    <style>
        .invoice-icon {
            width: 100px;
            height: 100px;
        }

        .label {
            font-weight: bold;
            font-family: Arial, Helvetica, sans-serif;
        }

        h1, h2 {
            font-family: Arial, Helvetica, sans-serif;
        }

        p {
            font-family: Arial, Helvetica, sans-serif;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .ticket-details {
            flex: 1;
        }

        .qr-code {
            flex: 0 0 auto;
            margin-left: 20px;
            width: 75%;
        }
    </style>
</head>

<body>
    <h1>Invoice</h1>
    <p><span class='label'>Date of purchase:</span> {{ $dateOfPurchase }}</p>
    <p><span class='label'>Customer name:</span> {{ $customerName }}</p>
    <p><span class='label'>Customer email:</span> {{ $customerEmail }}</p>
    <p><span class='label'>Customer NIF:</span> {{ $customerNif }}</p>
    <p><span class='label'>Type of payment:</span> {{ $typeOfPayment }}</p>
    <p><span class='label'>Payment reference:</span> {{ $paymentReference }}</p>
    <br>

    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Tickets</h2>
    @foreach($tickets as $ticket)
        @php
        $tmdbId = $ticket->screeningRef->custom;
                    $movieData=[];
                    $movieData = Cache::remember("movie_{$tmdbId}", 3600, function () use ($tmdbId) {
                        return $this->tmdbService->getMovieByID($tmdbId);
                    });
        @endphp
        <div class="ticket-info">
            <div class="ticket-details">
                <p>
                    <span class='label'>Ticket number:</span> {{ $ticket->id }}<br>
                    <span class='label'>Movie:</span> {{ $movieData['title'] }} <br>
                    <span class='label'>Screening:</span>{{ $ticket->screeningRef->start_time }} at {{ $ticket->screeningRef->date }}  <br>
                    <span class='label'>Seat:</span> {{ $ticket->seatRef->seatName }} <br>
                    <span class='label'>Theater:</span> {{ $ticket->screeningRef->theaterRef->name }} <br>
                    <span class='label'>Price:</span> {{ $ticket->price }}€<br>
                </p>
            </div>
            <div class="qr-code">
                <img class="qr-code" src="data:image/png;base64, {!! base64_encode(QrCode::size(100)->generate('localhost/tickets/show/' . $ticket->qrcode_url)) !!}">
            </div>
        </div>
    @endforeach
    <br>
    <p><span class='label'>Total price:</span> {{ $totalPrice }}€</p>

</body>

</html>
