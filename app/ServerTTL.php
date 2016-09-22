<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServerTTL extends Model
{
    protected $table = 'server_ttls';
    protected $fillable = ['server_id', 'value'];
}
