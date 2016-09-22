<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Wiki;
use App\Project;

use Auth, Uuid;

class WikisController extends Controller
{

    public function index(Request $request, Project $project)
    {
        $wikis = Wiki::filterProject($project)
            ->paginate(20);
        return view('wikis.index', compact('wikis'));
    }

    public function create(Project $project, Wiki $wiki)
    {
        return view('wikis.create', compact('wiki', 'project'));
    }

    public function store(Request $request, Project $project, Wiki $wiki)
    {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;
		$params['project_id'] = $project->id;
        $wiki = $wiki->create($params);
        return redirect()->route('projects.wikis.show', [$project->slug, 'path' => $wiki->slug]);
    }

    public function show(Request $request, Project $project, $path = '')
    {
        if (empty($path)) $path = 'home';
        $wiki = $project->wikis()->where('slug', $path)->first();
        return view('wikis.show', compact('wiki', 'project', 'path'));
    }

    public function edit(Project $project, Wiki $wiki)
    {
        return view('wikis.edit', compact('wiki', 'project'));
    }

    public function update(Request $request, Project $project, Wiki $wiki)
    {
        $params = $request->except('user_id', 'project_id');
        $wiki->fill($params)->save();
        return redirect()->route('projects.wikis.show', [$project->slug, 'path' => $wiki->slug]);
    }

    public function destroy(Project $project, Wiki $wiki)
    {
        $wiki->delete();
        return back();
    }

    public function upload(Request $request, Project $project) {
        $uploadedFiles = array();
        foreach ($request->file() as $file) {
            $new_name = Uuid::generate() . '.' . $file->getClientOriginalExtension();
            if ($file->move(public_path('files/wikis/'), $new_name)) {
                $uploadedFiles[] = 'files/wikis/' . urlencode($new_name);
            }
        }
        echo json_encode($uploadedFiles);
    }

}
