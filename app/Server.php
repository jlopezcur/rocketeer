<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $table = 'servers';
    protected $fillable = ['user_id', 'name', 'host', 'ip', 'latency', 'description'];

    // Relations

    public function deployments() {
        return $this->hasMany('App\Deployment');
    }

    public function ttls() {
        return $this->hasMany('App\ServerTTL');
    }

    public function runtimes() {
        return $this->hasMany('App\Runtime');
    }

    // Accessors & Mutators

    public function getColorAttribute() {
        if ($this->latency == 0) {
            return 'danger';
        } else if ($this->latency > 500) {
            return 'warning';
        } else {
            return 'success';
        }
    }

}
