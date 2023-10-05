<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    /*
     * Relationships
     */

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
