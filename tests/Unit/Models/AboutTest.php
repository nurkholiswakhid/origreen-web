<?php

namespace Tests\Unit\Models;

use App\Models\About;
use Tests\TestCase;

class AboutTest extends TestCase
{
    public function test_about_can_be_created()
    {
        $about = About::create([
            'title' => 'Tentang Kami',
            'subtitle' => 'Tempat bermain yang menyenangkan',
            'description' => 'Deskripsi lengkap tentang kami',
            'image_url' => '/storage/about.jpg',
            'stats_visitor' => json_encode(['count' => 5000]),
            'stats_rating' => json_encode(['stars' => 4.5]),
        ]);

        $this->assertNotNull($about->id);
        $this->assertEquals('Tentang Kami', $about->title);
    }

    public function test_about_can_be_updated()
    {
        $about = About::factory()->create();

        $about->update([
            'title' => 'Updated Title',
        ]);

        $this->assertEquals('Updated Title', $about->title);
    }

    public function test_about_can_be_deleted()
    {
        $about = About::factory()->create();
        $aboutId = $about->id;

        $about->delete();

        $this->assertNull(About::find($aboutId));
    }

    public function test_about_stats_visitor_is_json_cast()
    {
        $data = ['count' => 5000, 'monthly' => 1000];
        $about = About::create([
            'title' => 'Test',
            'subtitle' => 'Test Subtitle',
            'description' => 'Test Description',
            'stats_visitor' => $data,
            'stats_rating' => json_encode(['stars' => 4.5, 'count' => 200]),
        ]);

        $this->assertIsArray($about->stats_visitor);
        $this->assertEquals(5000, $about->stats_visitor['count']);
    }

    public function test_about_stats_rating_is_json_cast()
    {
        $data = ['stars' => 4.5, 'count' => 200];
        $about = About::create([
            'title' => 'Test',
            'subtitle' => 'Test Subtitle',
            'description' => 'Test Description',
            'stats_visitor' => json_encode(['count' => 5000, 'monthly' => 1000]),
            'stats_rating' => $data,
        ]);

        $this->assertIsArray($about->stats_rating);
        $this->assertEquals(4.5, $about->stats_rating['stars']);
    }

    public function test_about_fillable_attributes()
    {
        $attributes = [
            'title' => 'Test About',
            'subtitle' => 'Test Subtitle',
            'description' => 'Test Description',
            'image_url' => '/storage/test.jpg',
            'stats_visitor' => json_encode(['count' => 100]),
            'stats_rating' => json_encode(['stars' => 4.5]),
        ];

        $about = About::create($attributes);

        $this->assertEquals('Test About', $about->title);
        $this->assertEquals('Test Subtitle', $about->subtitle);
    }

    public function test_about_has_timestamps()
    {
        $about = About::factory()->create();

        $this->assertNotNull($about->created_at);
        $this->assertNotNull($about->updated_at);
    }
}
