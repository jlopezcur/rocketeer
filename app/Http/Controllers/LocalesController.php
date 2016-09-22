<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Locale;
use App;

class LocalesController extends Controller
{
    public function index()
    {
        $locales = Locale::paginate(20);
        return view('locales.index', compact('locales'));
    }

    public function create(Locale $locale)
    {
        return view('locales.create', compact('locale'));
    }

    public function store(Request $request, Locale $locale)
    {
        $params = $request->all();
        $locale->create($params);
		return redirect()->route('locales.index');
    }

    public function edit(Locale $locale)
    {
        return view('locales.edit', compact('locale'));
    }

    public function update(Request $request, Locale $locale)
    {
        $params = $request->input();
        $locale->fill($params)->save();
        return redirect()->route('locales.index');
    }

    public function destroy($id)
    {
        //
    }

    public function change(Request $request)
    {
        if ($request->has('locale_id')) {
            $locale = $request->get('locale_id');
            App::setLocale($locale);
            session(['locale' => $locale]);
        }
        return back();
    }
}
