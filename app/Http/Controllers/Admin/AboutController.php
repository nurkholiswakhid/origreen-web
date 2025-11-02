<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function edit()
    {
        $about = About::first();
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image_url' => 'required|url|max:255',
            'subtitle' => 'required|string|max:255',
            'description1' => 'required|string',
            'description2' => 'required|string',
            'stats_visitor' => 'required|string|max:255',
            'stats_rating' => 'required|string|max:255',
        ]);

        $about = About::first();
        $about->update($request->all());

        return redirect()->back()->with('success', 'About section berhasil diperbarui');
    }
}
