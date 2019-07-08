<?php

namespace App\Policies;

use App\User;
use App\SavedResults;
use Illuminate\Auth\Access\HandlesAuthorization;

class SavedResultPolicy {

    use HandlesAuthorization;

    /**
     * Determine whether the user can view any saved results.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user) {
        //
    }

    /**
     * Determine whether the user can view the saved results.
     *
     * @param  \App\User  $user
     * @param  \App\SavedResults  $savedResults
     * @return mixed
     */
    public function view(User $user, SavedResults $savedResult) {
        return (boolean) ($savedResult->user_id == $user->id);
    }

    /**
     * Determine whether the user can create saved results.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user) {
        //
    }

    /**
     * Determine whether the user can update the saved results.
     *
     * @param  \App\User  $user
     * @param  \App\SavedResults  $savedResults
     * @return mixed
     */
    public function update(User $user, SavedResults $savedResult) {
        return (boolean) ($savedResult->user_id == $user->id);
    }

    /**
     * Determine whether the user can delete the saved results.
     *
     * @param  \App\User  $user
     * @param  \App\SavedResults  $savedResults
     * @return mixed
     */
    public function delete(User $user, SavedResults $savedResult) {
        return (boolean) ($savedResult->user_id == $user->id);
    }

    /**
     * Determine whether the user can restore the saved results.
     *
     * @param  \App\User  $user
     * @param  \App\SavedResults  $savedResults
     * @return mixed
     */
    public function restore(User $user, SavedResults $savedResults) {
        //
    }

    /**
     * Determine whether the user can permanently delete the saved results.
     *
     * @param  \App\User  $user
     * @param  \App\SavedResults  $savedResults
     * @return mixed
     */
    public function forceDelete(User $user, SavedResults $savedResults) {
        //
    }

}
