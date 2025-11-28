<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Registration;

class RegistrationPolicy
{
    /**
     * Determine if the user can view the registration.
     */
    public function view(User $user, Registration $registration): bool
    {
        return $user->id === $registration->user_id || $user->isAdmin();
    }

    /**
     * Determine if the user can update the registration.
     */
    public function update(User $user, Registration $registration): bool
    {
        return $user->id === $registration->user_id;
    }

    /**
     * Determine if the user can delete the registration.
     */
    public function delete(User $user, Registration $registration): bool
    {
        return $user->id === $registration->user_id;
    }
}
