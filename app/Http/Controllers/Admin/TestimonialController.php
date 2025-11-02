<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->paginate(10);
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar_url' => 'nullable|url|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        Testimonial::create($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil ditambahkan');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'occupation' => 'nullable|string|max:255',
            'content' => 'required|string',
            'avatar_url' => 'nullable|url|max:255',
            'rating' => 'required|numeric|min:1|max:5',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');
        $testimonial->update($data);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil diperbarui');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Testimoni berhasil dihapus');
    }

    public function toggle(Testimonial $testimonial)
    {
        $testimonial->update([
            'is_active' => !$testimonial->is_active
        ]);

        return redirect()->route('admin.testimonials.index')
            ->with('success', 'Status testimoni berhasil diperbarui');
    }
}
