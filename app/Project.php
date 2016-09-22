<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Project extends Model implements SluggableInterface
{
    use SluggableTrait, RecordsActivity;

    protected $table = 'projects';
    protected $fillable = ['user_id', 'name', 'web', 'slug', 'image', 'description', 'project_id'];
    protected $sluggable = ['build_from' => 'name', 'save_to' => 'slug'];

    // Relations

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function deployments()
    {
        return $this->hasMany('App\Deployment');
    }

    public function issues()
    {
        return $this->hasMany('App\Issue');
    }

    public function labels()
    {
        return $this->hasMany('App\Label');
    }

    public function milestones()
    {
        return $this->hasMany('App\Milestone');
    }

    public function wikis()
    {
        return $this->hasMany('App\Wiki');
    }

    public function vaults()
    {
        return $this->hasMany('App\Vault');
    }

    public function activities()
    {
        return $this->hasMany('App\ProjectActivity');
    }
}
