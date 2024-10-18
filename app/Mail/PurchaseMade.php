<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PurchaseMade extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $pdfPath;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $pdfPath)
    {
        $this->data = $data;
        $this->pdfPath = $pdfPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.email')
                    ->subject('Your Purchase Receipt')
                    ->attach($this->pdfPath, [
                        'as' => 'receipt.pdf',
                        'mime' => 'application/pdf',
                    ])
                    ->with('data', $this->data);
    }
}
