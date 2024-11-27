<!doctype html>
<html lang='en'>

<head>
    <title>Purchase <?php echo e($purchaseNumber); ?></title>
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
    <p><span class='label'>Date of purchase:</span> <?php echo e($dateOfPurchase); ?></p>
    <p><span class='label'>Customer name:</span> <?php echo e($customerName); ?></p>
    <p><span class='label'>Customer email:</span> <?php echo e($customerEmail); ?></p>
    <p><span class='label'>Customer NIF:</span> <?php echo e($customerNif); ?></p>
    <p><span class='label'>Type of payment:</span> <?php echo e($typeOfPayment); ?></p>
    <p><span class='label'>Payment reference:</span> <?php echo e($paymentReference); ?></p>
    <br>

    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Tickets</h2>
    <?php $__currentLoopData = $tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="ticket-info">
            <div class="ticket-details">
                <p>
                    <span class='label'>Ticket number:</span> <?php echo e($ticket->id); ?><br>
                    <span class='label'>Screening:</span> <?php echo e($ticket->screeningRef->movieRef->title); ?> <?php echo e($ticket->screeningRef->start_time); ?><br>
                    <span class='label'>Seat:</span> <?php echo e($ticket->seatRef->seatName); ?>  <?php echo e($ticket->screeningRef->theaterRef->name); ?> Theater <br>
                    <span class='label'>Price:</span> <?php echo e($ticket->price); ?>€<br>
                </p>
            </div>
            <div class="qr-code">
                <img class="qr-code" src="data:image/png;base64, <?php echo base64_encode(QrCode::size(100)->generate('localhost/tickets/show/' . $ticket->qrcode_url)); ?>">
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <br>
    <p><span class='label'>Total price:</span> <?php echo e($totalPrice); ?>€</p>

</body>

</html>
<?php /**PATH /var/www/html/resources/views/pdf/pdf.blade.php ENDPATH**/ ?>