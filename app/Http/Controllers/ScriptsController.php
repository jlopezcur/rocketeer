<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Script;

use Auth;

class ScriptsController extends Controller
{

    public function index(Request $request)
    {
        $scripts = Script::filterProject($request->get('project_id'))
            ->paginate(20);
        return view('scripts.index', compact('scripts'));
    }

    public function create(Script $script)
    {
        return view('scripts.create', compact('script'));
    }

    public function store(Request $request, Script $script)
    {
        $params = $request->all();
        $script->create($params);
		return redirect()->route('scripts.index');
    }

    public function edit(Script $script)
    {
        return view('scripts.edit', compact('script'));
    }

    public function update(Request $request, Script $script)
    {
        $params = $request->input();
        $script->fill($params)->save();
        return redirect()->route('scripts.index');
    }

    public function destroy(Script $script)
    {
        $script->delete();
        return back();
    }

}
