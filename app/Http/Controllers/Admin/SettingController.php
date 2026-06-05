<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::firstOrCreate(['id' => 1]);
        $setting->update($request->validated());

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
