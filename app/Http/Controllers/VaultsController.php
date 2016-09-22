<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Vault;

use Auth;

class VaultsController extends Controller {

    public function index() {
        $vaults = Vault::roots()->paginate(12);
		return view('vaults.index', compact('vaults'));
    }

    public function create(Vault $vault) {
        return view('vaults.create', compact('vault'));
    }

    public function store(Request $request, Vault $vault) {
        $params = $request->all();
        $params['user_id'] = Auth::user()->id;
        $vault = $vault->create($params);
        if ($request->has('parent_id')) $vault->makeChildOf(Vault::find($request->get('parent_id')));

        if ($request->has('pairs')) {
            foreach ($request->get('pairs') as $pair) {
                $vault->pairs()->create([
                    'key' => $pair['key'],
                    'value' => $pair['value'],
                    'comment' => $pair['comment']
                ]);
            }
        }

		return redirect()->route('vaults.show', $vault->id);
    }

    public function show(Vault $vault) {
        return view('vaults.show', compact('vault'));
    }

    public function edit(Vault $vault) {
        return view('vaults.edit', compact('vault'));
    }

    public function update(Request $request, Vault $vault) {
        $params = $request->except(['user_id', 'parent_id']);
        $vault->fill($params)->save();
        $vault->pairs()->delete();
        if ($request->has('pairs')) {
            foreach ($request->get('pairs') as $pair) {
                $vault->pairs()->create([
                    'key' => $pair['key'],
                    'value' => $pair['value'],
                    'comment' => $pair['comment']
                ]);
            }
        }
		return redirect()->route('vaults.show', $vault->id);
    }

    public function destroy(Vault $vault) {
        $vault->delete();
		return back();
    }
}
