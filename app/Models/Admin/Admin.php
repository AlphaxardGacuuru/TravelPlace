<?php

namespace App\Models\Admin;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'photo',
    ];

    protected $casts = [
        "permissions" => "array",
    ];

    /*
     * Relationships
     */

    public function userRoles()
    {
        return $this->hasMany(UserRole::class);
    }

    /*
     * Custom Functions
     */

    // Returns names of roles
    public function roleNames()
    {
        $roles = [];

        foreach ($this->userRoles as $userRole) {
            array_push($roles, $userRole->role->name);
        }

        return $roles;
    }

    // Returns all roles
    public function roles()
    {
        $roles = [];

        foreach ($this->userRoles as $userRole) {
            array_push($roles, $userRole->role);
        }

        return collect($roles);
    }

    // Returns an array of permissions
    public function permissions()
    {
        $entities = [];

        foreach ($this->userRoles as $userRole) {
            $roleEntities = $userRole->role->entities;

            array_push($entities, $roleEntities);
        }

        // Combine array and get unique
        return collect($entities)
            ->collapse()
            ->unique();
    }
}
