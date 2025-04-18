<?php

namespace App\Policies;

use App\Models\Lists;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ListsPolicy {
    public function modify(User $user, Lists $list): Response {
        //
        return $user->id === $list->user_id ? Response::allow() : Response::deny('You do not own this post');
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Lists $lists): bool {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Lists $lists): bool {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lists $lists): bool {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lists $lists): bool {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lists $lists): bool {
        //
    }
}
