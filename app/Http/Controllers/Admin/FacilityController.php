<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('order')->get();
        return view('admin.facilities.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facilities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'display_type' => 'required|in:image,icon',
            'icon' => 'nullable|string|max:255',
            'main_icon' => 'required_if:display_type,icon|nullable|string|max:255',
            'image' => 'required_if:display_type,image|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|in:wahana,fasilitas',
            'order' => 'nullable|integer|min:0',
        ]);

        $data = $request->except(['image', '_token']);

        // Set default order if not provided
        if (!isset($data['order'])) {
            $data['order'] = Facility::max('order') + 1;
        }

        // Handle display type selection
        if ($request->display_type === 'image') {
            $data['main_icon'] = null; // Clear main_icon when using image

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('facilities', $filename, 'public');
                $data['image_url'] = $path;
            }
        } else {
            $data['main_icon'] = $request->input('main_icon'); // Set main_icon for icon type
            $data['image_url'] = null; // Clear image_url when using icon
        }

        // Create the facility
        $facility = Facility::create($data);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Wahana/Fasilitas berhasil ditambahkan');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facilities.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'display_type' => 'required|in:image,icon',
            'icon' => 'nullable|string|max:255',
            'main_icon' => 'required_if:display_type,icon|nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|in:wahana,fasilitas',
        ]);

        $data = $request->except(['image', '_token', '_method']);

        // Handle changes based on display type
        if ($request->display_type === 'image') {
            // Switching to or staying in image mode
            $data['main_icon'] = null; // Clear main_icon when using image

            if ($request->hasFile('image')) {
                // Delete old image if exists
                if ($facility->image_url && Storage::disk('public')->exists($facility->image_url)) {
                    Storage::disk('public')->delete($facility->image_url);
                }

                // Store new image
                $file = $request->file('image');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('facilities', $filename, 'public');
                $data['image_url'] = $path;
            }
        } else {
            // Switching to icon mode
            $data['main_icon'] = $request->input('main_icon');

            // Delete old image if exists
            if ($facility->image_url && Storage::disk('public')->exists($facility->image_url)) {
                Storage::disk('public')->delete($facility->image_url);
            }
            $data['image_url'] = null;
        }

        // Update the facility with all changes
        $facility->update($data);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Wahana/Fasilitas berhasil diperbarui');
    }

    public function destroy(Facility $facility)
    {
        // Delete associated media first
        $facility->clearMediaCollection('image');

        // Delete the facility
        $facility->delete();

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Wahana/Fasilitas berhasil dihapus');
    }

    public function toggle(Facility $facility)
    {
        $facility->update([
            'is_active' => !$facility->is_active
        ]);

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Status wahana/fasilitas berhasil diperbarui');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:facilities,id',
            'items.*.order' => 'required|integer|min:1'
        ]);

        foreach ($request->items as $item) {
            Facility::where('id', $item['id'])->update(['order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }
}
