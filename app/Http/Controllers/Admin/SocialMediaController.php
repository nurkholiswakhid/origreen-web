<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('sort_order')->get();
        return view('admin.social-media.index', compact('socialMedia'));
    }

    public function create()
    {
        return view('admin.social-media.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        SocialMedia::create($validated);

        return redirect()
            ->route('admin.social-media.index')
            ->with('success', 'Social media berhasil ditambahkan.');
    }

    public function edit(SocialMedia $socialMedia)
    {
        return view('admin.social-media.edit', compact('socialMedia'));
    }

    public function update(Request $request, SocialMedia $socialMedia)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'icon' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'sort_order' => 'required|integer|min:0',
        ]);

        $socialMedia->update($validated);

        return redirect()
            ->route('admin.social-media.index')
            ->with('success', 'Social media berhasil diperbarui.');
    }

    public function destroy(SocialMedia $socialMedia)
    {
        $socialMedia->delete();

        return redirect()
            ->route('admin.social-media.index')
            ->with('success', 'Social media berhasil dihapus.');
    }

    public function reorder(Request $request)
    {
        $items = $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:social_media,id',
            'items.*.order' => 'required|integer|min:1'
        ])['items'];

        foreach ($items as $item) {
            SocialMedia::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    public function toggle(SocialMedia $socialMedia)
    {
        $socialMedia->update([
            'is_active' => !$socialMedia->is_active
        ]);

        // Check if request wants JSON response
        if (request()->wantsJson()) {
            return response()->json(['success' => true, 'is_active' => $socialMedia->is_active]);
        }

        return redirect()
            ->route('admin.social-media.index')
            ->with('success', 'Status social media berhasil diperbarui.');
    }
}
