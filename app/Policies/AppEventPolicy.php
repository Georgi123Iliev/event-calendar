<?php

namespace App\Policies;

use App\Models\AppEvent;
use App\Models\User;
use App\Models\Organizer;
use Illuminate\Auth\Access\Response;

class EventPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AppEvent $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->organizer()->exists();
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AppEvent $event): bool
    {

        if($user->organizer()->exists())
        {
            $event->organizers()->where('organizer_id', $user->organizer()->id())->exists();
        }
        else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AppEvent $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AppEvent $event): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AppEvent $event): bool
    {
        return false;
    }
}
