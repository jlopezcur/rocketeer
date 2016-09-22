<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Runtime extends Model
{
    protected $table = 'runtimes';
    protected $fillable = ['user_id', 'server_id', 'vault_id', 'script_id', 'end', 'output'];
    protected $dates = ['created_at', 'updated_at', 'end'];

    // Relations

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function server() {
        return $this->belongsTo('App\Server');
    }

    public function vault() {
        return $this->belongsTo('App\Vault');
    }

    public function script() {
        return $this->belongsTo('App\Script');
    }
}
