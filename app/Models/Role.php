<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
    public function roles()
    {
        return $this->belongsToMany(
            config('permission.table_names.model_has_roles'),
            'model_id',
            'role_id'
        );
    }
}
