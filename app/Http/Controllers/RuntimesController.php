<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Runtime;

use Auth;
use SSH;
use Config;

class RuntimesController extends Controller
{

    // public function index(Request $request)
    // {
    //     $runtimes = Runtime::paginate(20);
    //     return view('runtimes.index', compact('runtimes'));
    // }

    public function store(Request $request, Runtime $runtime)
    {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;
        $runtime->create($params);
		return back();
    }

    public function run(Runtime $runtime) {

        $credentials = $runtime->vault->pairs->pluck('value', 'key');
        $server = $runtime->server;

        if (empty($credentials->host)) $credentials->put('host', (!empty($server->ip) ? $server->ip : $server->host));
        if (empty($credentials->port)) $credentials->put('port', 22);

        $credentials = $credentials->toArray();

        Config::set('remote.connections.runtime.host', $credentials['host']);
        Config::set('remote.connections.runtime.port', $credentials['port']);
        Config::set('remote.connections.runtime.username', $credentials['user']);
        Config::set('remote.connections.runtime.password', $credentials['pass']);

        $output = '';

        $script = $runtime->script->content;
        $script_lines = explode(PHP_EOL, $script);
        foreach ($script_lines as $i => $line) {
            $script_lines[$i] = str_replace("\r", '', $line);
            if (trim($script_lines[$i]) == '') unset($script_lines[$i]);
        }

        SSH::into('runtime')->run($script_lines, function ($line) use (&$output) {
            $output .= $line;
        });

        $runtime->output = $output;
        $runtime->end = \Carbon\Carbon::now();
        $runtime->save();

        return back();

    }

}
