<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Testimonial;
use App\Models\Facility;
use App\Models\About;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data untuk dashboard
        $statistics = [
            'news_count' => News::count(),
            'testimonials_count' => Testimonial::count(),
            'facilities_count' => Facility::count(),
        ];

        // Mengambil aktivitas terbaru (5 berita terbaru)
        $recentNews = News::latest()->take(3)->get();
        
        // Mengambil testimoni terbaru
        $recentTestimonials = Testimonial::latest()->take(3)->get();

        return view('admin.dashboard', compact('statistics', 'recentNews', 'recentTestimonials'));
    }
}
