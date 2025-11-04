<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_url' => 'required_without:image|nullable|string',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'stats_visitor' => 'required|array',
            'stats_visitor.icon' => 'required|string',
            'stats_visitor.title' => 'required|string',
            'stats_visitor.value' => 'required|string',
            'stats_visitor.color' => 'required|string',
            'stats_rating' => 'required|array',
            'stats_rating.icon' => 'required|string',
            'stats_rating.title' => 'required|string',
            'stats_rating.value' => 'required|string',
            'stats_rating.color' => 'required|string',
        ]);

        $about = About::first();
        $data = $request->except(['image']);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists in storage
            if ($about->image_url && Storage::disk('public')->exists(str_replace('/storage/', '', $about->image_url))) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $about->image_url));
            }

            // Store new image
            $imagePath = $request->file('image')->store('about', 'public');
            $data['image_url'] = '/storage/' . $imagePath;
        }

        $about->update($data);

        return redirect()->back()->with('success', 'About section berhasil diperbarui');
    }
}
