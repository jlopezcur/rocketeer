<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deployment extends Model
{
    protected $table = 'deployments';
    protected $fillable = ['project_id', 'server_id', 'name', 'type', 'port', 'username', 'password'];

    // Relations

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function server() {
        return $this->belongsTo('App\Server');
    }

    // Scopes

    public function scopeFilterProject($query, $project_id)
    {
        if (!empty($project_id)) return $query->where('project_id', $project_id);
        return $query;
    }

    public function scopeFilterServer($query, $server_id)
    {
        if (!empty($server_id)) return $query->where('server_id', $server_id);
        return $query;
    }
}
