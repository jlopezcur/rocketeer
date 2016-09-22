<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    protected $table = 'activities';
    protected $fillable = ['user_id', 'project_id', 'subject_id', 'subject_type', 'name'];

    // Relations

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function subject()
    {
        return $this->morphTo();
    }

    // Scopes

	public function scopeFilterProject($query, $project_id) {
		if (!empty($project_id)) return $query->where('project_id', $project_id);
		return $query;
	}

    public function scopeFilterUser($query, $user_id) {
		if (!empty($user_id)) return $query->where('user_id', $user_id);
		return $query;
	}

}
