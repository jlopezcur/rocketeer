<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IssueComment extends Model
{

    use RecordsActivity;

    protected $table = 'issue_comments';
	protected $fillable = ['user_id', 'issue_id', 'comment'];

    // Relations

	public function author()
	{
        return $this->belongsTo('App\User', 'user_id');
    }

    public function issue()
	{
        return $this->belongsTo('App\Issue');
    }
}
