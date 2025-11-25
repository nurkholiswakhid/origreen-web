<?php

namespace Tests\Unit\Models;

use App\Models\Banner;
use Tests\TestCase;

class BannerTest extends TestCase
{
    public function test_banner_can_be_created()
    {
        $banner = Banner::create([
            'title' => 'Welcome Banner',
            'description' => 'This is a welcome banner',
            'image_url' => '/storage/banners/banner1.jpg',
            'button1_text' => 'Learn More',
            'button1_url' => '/about',
            'button2_text' => 'Contact',
            'button2_url' => '/contact',
        ]);

        $this->assertNotNull($banner->id);
        $this->assertEquals('Welcome Banner', $banner->title);
        $this->assertEquals('This is a welcome banner', $banner->description);
    }

    public function test_banner_can_be_updated()
    {
        $banner = Banner::factory()->create();

        $banner->update([
            'title' => 'Updated Banner',
            'description' => 'Updated description',
        ]);

        $this->assertEquals('Updated Banner', $banner->title);
        $this->assertEquals('Updated description', $banner->description);
    }

    public function test_banner_can_be_deleted()
    {
        $banner = Banner::factory()->create();
        $bannerId = $banner->id;

        $banner->delete();

        $this->assertNull(Banner::find($bannerId));
    }

    public function test_banner_fillable_attributes()
    {
        $attributes = [
            'title' => 'Test Banner',
            'description' => 'Test Description',
            'image_url' => '/storage/test.jpg',
            'button1_text' => 'Button 1',
            'button1_url' => '/btn1',
            'button2_text' => 'Button 2',
            'button2_url' => '/btn2',
        ];

        $banner = Banner::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $banner->$key);
        }
    }

    public function test_banner_has_timestamps()
    {
        $banner = Banner::factory()->create();

        $this->assertNotNull($banner->created_at);
        $this->assertNotNull($banner->updated_at);
    }

    public function test_banner_button_fields_are_optional()
    {
        $banner = Banner::create([
            'title' => 'Simple Banner',
            'description' => 'Simple Description',
            'image_url' => '/storage/simple.jpg',
        ]);

        $this->assertNull($banner->button1_text);
        $this->assertNull($banner->button2_text);
    }
}
