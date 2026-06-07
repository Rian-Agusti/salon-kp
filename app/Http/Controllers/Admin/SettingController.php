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

        $data = $request->validated();
        $data['opening_hour'] = $request->opening_hour . ':00';
        $data['closing_hour'] = $request->closing_hour . ':00';

        $setting->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
