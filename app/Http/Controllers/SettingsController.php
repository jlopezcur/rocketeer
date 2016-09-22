<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Setting;

class SettingsController extends Controller
{
    public function edit()
    {
        $settings = Setting::get();
        $parsed = [];
        foreach ($settings as $setting) {
            $parsed[$setting->key] = $setting->value;
        }
        return view('settings.edit', ['settings' => json_decode(json_encode($parsed), FALSE)]);
    }

    public function update(Request $request)
    {
        $params = $request->except(['_token']);
        foreach ($params as $key => $value) {
            $field = Setting::where('key', $key)->first();
            if (empty($field)) {
                Setting::create(['key' => $key, 'value' => $value]);
            } else {
                $field->fill(['value' => $value])->save();
            }
        }
        return back()->with('message', ['status' => 'success', 'content' => 'Your settings was succesfuly saved.']);
    }
}
