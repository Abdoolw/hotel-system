<?php
namespace App\Policies;

use App\Models\User;
use App\Models\House;

class HousePolicy
{
    /**
     * Determine if the given user can view any houses.
     */
    public function viewAny(User $user)
    {
        // return $user->hasPermissionTo('image-list');

        return $user->hasPermissionTo('image-list') ? Response::allow() : abort(404, 'Page not found');
    }

    /**
     * Determine if the given user can view the house.
     */
    public function view(User $user, House $house)
    {
        return $user->hasPermissionTo('image-list') || $user->id === $house->user_id;
    }

    /**
     * Determine if the given user can create houses.
     */
    public function create(User $user)
    {
        // return $user->hasPermissionTo('image-create') ? Response::allow() : Response::denyAsNotFound();
        // if ($user->hasPermissionTo('image-create')) {
        //     return Response::allow(); // إذا كان لديه إذن
        // }
        // return Response::deny('You do not have permission to create this house.');
        return $user->hasPermissionTo('image-create') ? Response::allow() : abort(404, 'Page not found');
    }

    /**
     * Determine if the given user can update the house.
     */
    public function update(User $user, House $house)
    {
        return $user->hasPermissionTo('image-edit') || $user->id === $house->user_id;
    }

    /**
     * Determine if the given user can delete the house.
     */
    public function delete(User $user, House $house)
    {
        return $user->hasPermissionTo('image-delete') || $user->id === $house->user_id;
    }
}
