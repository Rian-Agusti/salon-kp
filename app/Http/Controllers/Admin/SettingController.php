<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    public function edit()
    {
        return view('admin.settings.edit');
    }

    public function update(UpdateSettingRequest $request)
    {
        $setting = Setting::firstOrCreate(['id' => 1]);

        $data = $request->validated();
        $data['opening_hour'] = $request->opening_hour . ':00';
        $data['closing_hour'] = $request->closing_hour . ':00';

        $setting->update($data);

        \Illuminate\Support\Facades\Cache::forget('public.setting');

        return redirect()->route('admin.settings.edit')->with('success', 'Settings updated successfully.');
    }
}
