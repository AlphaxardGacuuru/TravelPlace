<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $fillable = [
        'name',
        'email',
        'password',
        'token',
        'photo'
    ];

	 protected $casts = [
        "permissions" => "array"
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
	
	public function roleNames()
	{
		$roles = [];

		foreach ($this->userRoles as $userRole) {
			array_push($roles, $userRole->role->name);
		}

		return $roles;
	}
	
	public function roles()
	{
		$roles = [];

		foreach ($this->userRoles as $userRole) {
			array_push($roles, $userRole->role);
		}

		return collect($roles);
	}
}
