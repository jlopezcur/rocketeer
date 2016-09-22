<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Script extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $table = 'scripts';
    protected $fillable = ['user_id', 'name', 'slug', 'content', 'project_id'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    // Relations

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Scopes

	public function scopeFilterProject($query, $project) {
		if (isset($project->id)) return $query->where('project_id', $project->id);
		return $query;
	}

}
