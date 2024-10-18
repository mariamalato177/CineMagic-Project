<?php

namespace App\Policies;

use App\Models\Screening;
use App\Models\Customer;
use App\Models\User;

class ScreeningPolicy
{
    public function before(?User $user, string $ability): bool|null
    {
        if ($user?->admin) {
            return true;
        }
        // When "Before" returns null, other methods (eg. viewAny, view, etc...) will be
        // used to check the user authorizaiton
        return null;
    }

    public function viewAny(User $user): bool
    {
        return $user->type == 'E' || $user->type == 'A';
    }

    public function view(User $user, Customer $customer): bool
    {
        if ($user->type == 'A' || ($user->type == 'C' && $user->id == $customer->user_id)) {
            return true;
        }
        // If user is teacher, then he can view the detail information of his students only
        // if ($user->type == 'E') {
        //     // ID set of disciplines that user teaches:
        //     $purchasesOfTeacherSet = $user->customer->purchases->pluck('id')->toArray();
        //     // ID set of disciplines that the student is enrolled:
        //     $disciplinesOfStudentSet = $student->disciplines->pluck('id')->toArray();
        //     return count(array_intersect($disciplinesOfTeacherSet, $disciplinesOfStudentSet)) >= 1;
        // }
        return false;
    }



    public function create(User $user): bool
    {
        return $user->type == 'A';
    }

    public function update(User $user): bool
    {
        return $user->type == 'A';
    }

    public function delete(User $user): bool
    {
        return $user->type == 'A';
    }
}
