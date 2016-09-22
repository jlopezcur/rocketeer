<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\ProjectRequest;
use App\Http\Controllers\Controller;

use App\Project;

use Config;
use Auth;

class ProjectsController extends Controller {

    public function index() {
        $projects = Project::orderBy('updated_at', 'desc')
            ->paginate(20);
        return view('projects.index', compact('projects'));
    }

    public function create(Project $project) {
        return view('projects.create', compact('project'));
    }

    public function store(ProjectRequest $request, Project $project) {
        $data = $request->input();
        $data['user_id'] = Auth::user()->id;
        $project->create($data);
		return redirect()->route('projects.show', [$project->slug]);
    }

    public function show(Project $project) {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project) {
        return view('projects.edit', compact('project'));
    }

    public function update(ProjectRequest $request, Project $project) {
        $data = $request->input();
        $data['user_id'] = Auth::user()->id;
        $project->fill($data)->save();
        return redirect()->route('projects.show', [$project->slug]);
    }

    public function destroy(Project $project) {
        $project->delete();
        return back();
    }

}
