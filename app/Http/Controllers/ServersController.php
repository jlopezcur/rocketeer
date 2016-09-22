<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Server;
use Auth;
use JJG\Ping;

class ServersController extends Controller
{
    public function index()
    {
        $servers = Server::where('user_id', Auth::user()->id)->paginate(20);
        return view('servers.index', compact('servers'));
    }

    public function create(Server $server)
    {
        return view('servers.create', compact('server'));
    }

    public function store(Request $request, Server $server)
    {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;
        $server = $server->create($params);
        $this->ping($server);
		return redirect()->route('servers.index');
    }

    public function show(Server $server)
    {
        return view('servers.show', compact('server'));
    }

    public function edit(Server $server)
    {
        return view('servers.edit', compact('server'));
    }

    public function update(Request $request, Server $server)
    {
        $params = $request->input();
        $params['user_id'] = Auth::user()->id;
        $server->fill($params)->save();
        return redirect()->route('servers.index');
    }

    public function destroy(Server $server)
    {
        $server->delete();
        return back();
    }

    /* Ping functions */

    public function ping(Server $server)
    {
        $host = $server->host;
        $latency = $this->do_ping($host);

        $server->update(['latency' => $latency]);
        $server->ttls()->save(new \App\ServerTTL(['value' => $latency]));

        return $latency;
    }

    public function broadcast_ping()
    {
        foreach (Server::get() as $server) {
            $this->ping($server);
        }
    }

    private function do_ping($host) {
        $ping = new Ping($host);
        $latency = $ping->ping();
        if ($latency === false) $latency = 0;
        return $latency;
    }
}
