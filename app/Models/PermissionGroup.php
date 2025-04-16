<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class PermissionGroup extends Model
{
    //

    public function permissions(){
        return $this->hasMany(Permission::class);
    }
}
