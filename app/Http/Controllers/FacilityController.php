<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    public function index()
    {
        $wahana = Facility::where('type', 'wahana')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $fasilitas = Facility::where('type', 'fasilitas')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('pages.wahana', compact('wahana', 'fasilitas'));
    }
}
