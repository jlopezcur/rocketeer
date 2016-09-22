<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {

    protected $fillable = ['first_name', 'last_name', 'email', 'username', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    // Relations

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function issues() {
        return $this->hasMany('App\Issue');
    }

    public function servers() {
        return $this->hasMany('App\Server');
    }

    // Scopes

    public function scopeFilterSearch($query, $search) {
        if (!empty($search)) return $query->where('first_name', 'LIKE', '%' . $search . '%')
            ->orWhere('last_name', 'LIKE', '%' . $search . '%');
        return $query;
    }

    // Accessors

    public function getFullNameAttribute() {
        return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
    }

    // Custom functions

    public function isSuperAdmin() {
        return $this->role == 'admin';
    }
}
