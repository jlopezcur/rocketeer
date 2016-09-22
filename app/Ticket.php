<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = ['tickets_group_id', 'status', 'resolved_by', 'assigned_to', 'priority', 'title' , 'email' , 'name' , 'last_name' ,'phone' , 'description', 'project_id'];


    public function resolvedBy() {
        return $this->belongsTo('App\User', 'resolved_by');
    }

    public function assignedTo() {
        return $this->belongsTo('App\User', 'assigned_to');
    }

    public function project() {
        return $this->belongsTo('App\Project');
    }
}
