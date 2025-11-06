<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\MapSetting;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        $mapSetting = MapSetting::first();
        return view('pages.tentang', compact('about', 'mapSetting'));
    }
}