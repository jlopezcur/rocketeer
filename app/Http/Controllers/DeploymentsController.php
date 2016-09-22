<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Deployment;

use Auth;

class DeploymentsController extends Controller
{

    public function index(Request $request)
    {
        $deployments = Deployment::filterProject($request->get('project_id'))
            ->filterServer($request->get('server_id'))
            ->paginate(20);
        return view('deployments.index', compact('deployments'));
    }

    public function create(Deployment $deployment)
    {
        return view('deployments.create', compact('deployment'));
    }

    public function store(Request $request, Deployment $deployment)
    {
        $params = $request->all();
        $deployment->create($params);
		return redirect()->route('deployments.index');
    }

    public function edit(Deployment $deployment)
    {
        return view('deployments.edit', compact('deployment'));
    }

    public function update(Request $request, Deployment $deployment)
    {
        $params = $request->input();
        $deployment->fill($params)->save();
        return redirect()->route('deployments.index');
    }

    public function destroy(Deployment $deployment)
    {
        $deployment->delete();
        return back();
    }

    public function deploy(Deployment $deployment) {
        Config::set('remote.connections.runtime.host', $deployment->host);
        Config::set('remote.connections.runtime.port', $deployment->port);
        Config::set('remote.connections.runtime.username', $deployment->username);
        Config::set('remote.connections.runtime.password', $deployment->password);

        SSH::into('runtime')->run(array(
            'cd /var/www',
            'git pull origin master',
        ));
    }
}
