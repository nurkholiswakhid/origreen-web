<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapSetting;
use Illuminate\Http\Request;

class MapSettingController extends Controller
{
    public function edit()
    {
        $mapSetting = MapSetting::first();
        return view('admin.map-settings.edit', compact('mapSetting'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'operation_hours' => 'required|string|max:255',
            'google_maps_url' => 'required|url|max:255',
            'map_embed_url' => 'required|url',
        ]);

        $mapSetting = MapSetting::first();
        $mapSetting->update($request->all());

        return redirect()->route('admin.map-settings.edit')
            ->with('success', 'Pengaturan peta berhasil diperbarui');
    }
}
