<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model {

	use RecordsActivity;

	protected $table = 'issues';
	protected $fillable = ['title', 'description', 'status', 'user_id', 'assignee_id', 'number', 'project_id', 'milestone_id'];
	protected $touches = ['project'];

	// Relations

	public function project()
	{
        return $this->belongsTo('App\Project');
    }

	public function author()
	{
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

	public function assignee()
	{
        return $this->belongsTo('App\User', 'assignee_id', 'id');
    }

	public function milestone()
	{
        return $this->belongsTo('App\Milestone');
    }

	public function labels()
    {
        return $this->belongsToMany('App\Label');
    }

	public function comments()
    {
        return $this->hasMany('App\IssueComment');
    }

	// Scopes

	public function scopeFilterProject($query, $project) {
		if (isset($project->id)) return $query->where('project_id', $project->id);
		return $query;
	}

	public function scopeFilterSearch($query, $q) {

		$queryHelper = new QueryHelper($q);

		if (trim($q) != '') {

			// Open / Closed
			if ($queryHelper->has('is')) $query = $query->where('status', $queryHelper->get('is'));

			// Author
			if ($queryHelper->has('author')) {
				$user = User::where('username', $queryHelper->get('author'))->first();
				if ($user != null) $query = $query->where('user_id', $user->id);
				else $query = $query->where('user_id', null);
			}

			// Asignee
			if ($queryHelper->has('assignee')) {
				$user = User::where('username', $queryHelper->get('assignee'))->first();
				if ($user != null) $query = $query->where('user_id', $user->id);
				else $query = $query->where('assignee_id', null);
			}

			// Milestone
			if ($queryHelper->has('milestone')) {
				$milestone = Milestone::findBySlug($queryHelper->get('milestone'));
				if ($milestone != null) $query = $query->where('milestone_id', $milestone->id);
				else $query = $query->where('milestone_id', null);
			}

			// Label
			if ($queryHelper->has('label')) {
				$name = $queryHelper->get('label');
				$query = $query->whereHas('labels', function ($query) use ($name) {
                    $query->where('name', $name);
                });
			}

			// Mentions
			// TODO: Complete Mentions
			if ($queryHelper->has('mentions')) {
				$username = $queryHelper->get('mentions');
				$query = $query->whereHas('comments', function ($query) use ($username) {
                    $query->where('comment', '%#' . $username . '%');
                });
			}

			// TODO: Search by the rest of the sting

		} else {
			$query = $query->where('status', 'open');
		}
		return $query;
	}

}


class QueryHelper {

	protected $query;

	public function __construct($query = '') {
		$this->query = $query;
	}

	public function has($param) {
		$pattern = '/' . $param . '/';
		preg_match($pattern, $this->query, $coincidencias, PREG_OFFSET_CAPTURE);
		if (!empty($coincidencias)) return true;
		return false;
	}

	public function get($param) {
		$pattern = '/' . $param . ':(\w+)/';
		preg_match($pattern, $this->query, $coincidencias, PREG_OFFSET_CAPTURE);
		if (!empty($coincidencias)) return $coincidencias[1][0];
		return false;
	}

}
