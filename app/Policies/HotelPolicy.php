<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Hotel;
use Illuminate\Auth\Access\HandlesAuthorization;

class HotelPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function view(User $user, Hotel $hotel)
    {
        return (boolean) $hotel->users()->where('id', $user->id)->first();
    }

    /**
     * Determine whether the user can setup the hotel.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function setup(User $user, Hotel $hotel)
    {
        return (boolean)  $user->isAdmin($hotel) ;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function update(User $user, Hotel $hotel)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function delete(User $user, Hotel $hotel)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function restore(User $user, Hotel $hotel)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Hotel  $hotel
     * @return mixed
     */
    public function forceDelete(User $user, Hotel $hotel)
    {
        //
    }
}
