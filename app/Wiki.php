<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Wiki extends Model implements SluggableInterface
{
    use SluggableTrait;

    protected $table = 'wikis';
    protected $fillable = ['title', 'slug', 'content', 'user_id', 'project_id'];
    protected $sluggable = ['build_from' => 'title', 'save_to' => 'slug'];

    // Relations

	public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }

    // Scopes

	public function scopeFilterProject($query, $project) {
		if (isset($project->id)) return $query->where('project_id', $project->id);
		return $query;
	}

}
