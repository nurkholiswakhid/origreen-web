<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        try {
            // Log incoming request data
            Log::info('Incoming request data:', $request->all());

            // Validate the request
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'image_url' => 'nullable|string',
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

            // Get or create about record
            $about = About::firstOrNew();

            // Prepare the data
            $data = [
                'title' => $validated['title'],
                'subtitle' => $validated['subtitle'],
                'description' => $validated['description'],
                'stats_visitor' => [
                    'icon' => $validated['stats_visitor']['icon'],
                    'title' => $validated['stats_visitor']['title'],
                    'value' => $validated['stats_visitor']['value'],
                    'color' => $validated['stats_visitor']['color'],
                ],
                'stats_rating' => [
                    'icon' => $validated['stats_rating']['icon'],
                    'title' => $validated['stats_rating']['title'],
                    'value' => $validated['stats_rating']['value'],
                    'color' => $validated['stats_rating']['color'],
                ],
            ];

            Log::info('Prepared data:', $data);

            // Handle image upload
            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($about->image_url && Storage::disk('public')->exists(str_replace('/storage/', '', $about->image_url))) {
                    Storage::disk('public')->delete(str_replace('/storage/', '', $about->image_url));
                }

                // Store new image
                $imagePath = $request->file('image')->store('about', 'public');
                $data['image_url'] = '/storage/' . $imagePath;
            } elseif ($request->filled('image_url')) {
                $data['image_url'] = $request->image_url;
            }

            // Update or create the record
            if ($about->exists) {
                $about->update($data);
            } else {
                $about = About::create($data);
            }

            return redirect()->back()->with('success', 'About section berhasil diperbarui');
            
        } catch (\Exception $e) {
            Log::error('Error updating about section: ' . $e->getMessage());
            Log::error('Error details: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Log the request data for debugging
            Log::info('Request data:', $request->all());
            
            return redirect()->back()
                ->withInput()
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
