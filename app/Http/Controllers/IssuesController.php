<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Project;
use App\Issue;

use Auth, Uuid;

class IssuesController extends Controller {

    public function index(Request $request, Project $project) {
        $issues = Issue::filterSearch($request->get('q'))
			->filterProject($project)
			->orderBy('updated_at', 'desc')
            ->with('project', 'comments', 'milestone', 'labels', 'author', 'assignee')
			->paginate(25);
		return view('issues.index', compact('issues', 'project'));
    }

    public function create(Project $project, Issue $issue) {
        return view('issues.create', compact('issue', 'project'));
    }

    public function store(Request $request, Project $project, Issue $issue) {
		$params = $request->all();
		$params['user_id'] = Auth::user()->id;
		$params['project_id'] = $project->id;
        $params['status'] = 'open';
        $params['number'] = $project->issues()->count() + 1;
		$issue = $issue->create($params);
        if (isset($params['labels'])) $issue->labels()->attach($params['labels']);
		return redirect()->route('projects.issues.index', [$project->slug]);
    }

    public function show(Project $project, Issue $issue) {
		return view('issues.show', compact('issue', 'project'));
    }

    public function edit(Project $project, Issue $issue) {
		return view('issues.edit', compact('issue', 'project'));
    }

    public function update(Request $request, Project $project, Issue $issue) {
        $params = $request->except(['user_id', 'number', 'project_id']);
        $issue->fill($params)->save();
        $issue->labels()->detach(); if (isset($params['labels'])) $issue->labels()->attach($params['labels']);
		return redirect()->route('projects.issues.index', [$project->slug]);
    }

    public function quick_update(Request $request, Project $project, Issue $issue) {
        $params = $request->only('status');
		$issue->fill($params)->save();
        return redirect()->route('projects.issues.index', [$project->slug]);
    }

	public function exportExcel() {
		//$excel = App::make('App\Excel');
		$issues = Issue::orderBy('updated_at', 'desc')->get()->toArray();
		Excel::create(trans('projects.issues'), function($excel) use($issues) {
			$excel->sheet(trans('projects.issues'), function($sheet) use($issues) {
				$sheet->fromArray($issues);
    		});
		})->download('xlsx');
	}

    public function upload(Request $request, Project $project) {
        $uploadedFiles = array();
        foreach ($request->file() as $file) {
            $new_name = Uuid::generate() . '.' . $file->getClientOriginalExtension();
            if ($file->move(public_path('files/issues/'), $new_name)) {
                $uploadedFiles[] = 'files/issues/' . urlencode($new_name);
            }
        }
        echo json_encode($uploadedFiles);
    }

}
