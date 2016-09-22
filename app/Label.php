<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{

    use RecordsActivity;

    protected $table = 'labels';
    protected $fillable = ['user_id', 'project_id', 'name', 'color'];
    protected $touches = ['project'];

    // Relations

	public function project()
	{
        return $this->belongsTo('App\Project');
    }

}
