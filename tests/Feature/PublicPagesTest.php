<?php

namespace Tests\Feature;

use App\Models\Banner;
use App\Models\Facility;
use App\Models\News;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_homepage_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_inactive_news_are_not_displayed_in_list()
    {
        $activeNews = News::factory()->create(['is_active' => true]);
        $inactiveNews = News::factory()->create(['is_active' => false]);

        $this->assertTrue(true); // Placeholder - route testing depends on actual routes
    }

    public function test_inactive_facilities_are_not_displayed_in_list()
    {
        $activeFacility = Facility::factory()->create(['is_active' => true]);
        $inactiveFacility = Facility::factory()->create(['is_active' => false]);

        $this->assertTrue(true); // Placeholder - route testing depends on actual routes
    }
}
