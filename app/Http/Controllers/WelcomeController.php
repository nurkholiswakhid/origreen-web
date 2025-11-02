<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Facility;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\MapSetting;
use App\Models\Faq;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $banner = Banner::first();
        $about = About::first();
        $facilities = Facility::orderBy('order')->get();
        $news = News::orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
        $testimonials = Testimonial::where('is_active', true)
                    ->latest()
                    ->take(3)
                    ->get();
        $mapSetting = MapSetting::first();
        $faqs = Faq::where('is_active', true)
                   ->orderBy('order')
                   ->get();

        return view('welcome', compact('banner', 'about', 'facilities', 'news', 'testimonials', 'mapSetting', 'faqs'));
    }
}
