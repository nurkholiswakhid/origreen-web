<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;

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
            'icon' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|in:wahana,fasilitas',
            'order' => 'required|integer|min:0',
        ]);

        Facility::create($request->all());

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
            'icon' => 'required|string|max:255',
            'duration' => 'nullable|string|max:255',
            'type' => 'required|in:wahana,fasilitas',
            'order' => 'required|integer|min:0',
        ]);

        $facility->update($request->all());

        return redirect()->route('admin.facilities.index')
            ->with('success', 'Wahana/Fasilitas berhasil diperbarui');
    }

    public function destroy(Facility $facility)
    {
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
}
