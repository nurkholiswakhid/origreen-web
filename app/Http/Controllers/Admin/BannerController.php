<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function edit()
    {
        $banner = Banner::first();
        return view('admin.banner.edit', compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'button1_text' => 'required|string|max:255',
            'button1_url' => 'required|string|max:255',
            'button2_text' => 'required|string|max:255',
            'button2_url' => 'required|string|max:255',
        ]);

        $banner = Banner::first();
        $banner->update($request->all());

        return redirect()->back()->with('success', 'Banner berhasil diperbarui');
    }
}
