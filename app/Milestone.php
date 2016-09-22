<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Milestone extends Model implements SluggableInterface
{
    use SluggableTrait, RecordsActivity;

    protected $table = 'milestones';
    protected $fillable = ['name', 'slug', 'description', 'project_id', 'user_id', 'due_date'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];
    protected $touches = ['project'];

    // Relations

    public function project() {
        return $this->belongsTo('App\Project');
    }

    public function issues() {
        return $this->hasMany('App\Issue');
    }

    public function author() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    // Accesors

    public function getPercentageAttribute()
    {
        $all_issues = $this->issues->count();
        $closed_issues = $this->issues()->where('status', 'closed')->count();
        $percentage = 0; if ($all_issues != 0) $percentage = round(($closed_issues / $all_issues) * 100);
        return $percentage;
    }

}
