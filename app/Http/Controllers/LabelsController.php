<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Label;
use App\Project;

use Auth;

class LabelsController extends Controller
{

    public function index(Request $request, Project $project)
    {
        $labels = $project->labels()->paginate(20);
        return view('labels.index', compact('labels', 'project'));
    }

    public function create(Project $project, Label $label)
    {
        return view('labels.create', compact('label', 'project'));
    }

    public function store(Request $request, Project $project, Label $label)
    {
        $params = $request->all();
        $params['user_id'] = Auth::User()->id;
        $params['project_id'] = $project->id;
        $label->create($params);
		return redirect()->route('projects.labels.index', [$project->slug]);
    }

    public function edit(Project $project, Label $label)
    {
        return view('labels.edit', compact('label', 'project'));
    }

    public function update(Request $request, Project $project, Label $label)
    {
        $params = $request->except('user_id', 'project_id');
        $label->fill($params)->save();
        return redirect()->route('projects.labels.index', [$project->slug]);
    }

    public function destroy(Project $project, Label $label)
    {
        $label->delete();
        return back();
    }

}
