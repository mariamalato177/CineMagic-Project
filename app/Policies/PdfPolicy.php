<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use App\Models\Ticket;

class PdfPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Purchase $purchase, Ticket $ticket): bool
    {
        if((($user->user_type == 'C' && $user->id == $purchase->customer_id) || $user->user_type == 'A') && $ticket->status=='valid'){
            return true;
        }
        return false;

    }
}
