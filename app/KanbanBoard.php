<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class KanbanBoard extends Model {

    protected $fillable = ['project_id', 'name', 'description', 'slug'];

    public function project() {
        return $this->belongsTo('App\Project');
    }

}
