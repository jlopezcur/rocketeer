<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Milestone;
use App\Project;

use Auth;

class MilestonesController extends Controller {

    public function index(Project $project) {
        $milestones = $project->milestones()->paginate(12);
		return view('milestones.index', compact('milestones', 'project'));
    }

    public function create(Project $project, Milestone $milestone) {
        return view('milestones.create', compact('milestone', 'project'));
    }

    public function store(Request $request, Project $project, Milestone $milestone) {
        $params = $request->all();
        $params['project_id'] = $project->id;
        $params['user_id'] = Auth::user()->id;
        $milestone->create($params);
		return redirect()->route('projects.milestones.index', [$project->slug]);
    }

    public function show(Project $project, Milestone $milestone) {
        return view('milestones.show', compact('milestone', 'project'));
    }

    public function edit(Project $project, Milestone $milestone) {
        return view('milestones.edit', compact('milestone', 'project'));
    }

    public function update(Request $request, Project $project, Milestone $milestone) {
        $params = $request->except('user_id', 'project_id');
        $milestone->fill($params)->save();
		return redirect()->route('projects.milestones.index', [$project->slug]);
    }

    public function destroy(Project $project, Milestone $milestone) {
        $milestone->delete();
		return back();
    }
}
