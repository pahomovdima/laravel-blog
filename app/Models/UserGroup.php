<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

    protected $fillable = [
        'name', 'description'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users() {
        return $this->hasMany(User::class);
    }

}
