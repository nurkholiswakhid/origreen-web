<?php

namespace Tests\Unit\Models;

use App\Models\SocialMedia;
use Tests\TestCase;

class SocialMediaTest extends TestCase
{
    public function test_social_media_can_be_created()
    {
        $social = SocialMedia::create([
            'platform' => 'Facebook',
            'url' => 'https://facebook.com/example',
            'icon' => 'fab fa-facebook',
            'is_active' => true,
            'sort_order' => 1,
        ]);

        $this->assertNotNull($social->id);
        $this->assertEquals('Facebook', $social->platform);
    }

    public function test_social_media_can_be_updated()
    {
        $social = SocialMedia::factory()->create();

        $social->update([
            'url' => 'https://facebook.com/updated',
            'is_active' => false,
        ]);

        $this->assertEquals('https://facebook.com/updated', $social->url);
        $this->assertFalse($social->is_active);
    }

    public function test_social_media_can_be_deleted()
    {
        $social = SocialMedia::factory()->create();
        $socialId = $social->id;

        $social->delete();

        $this->assertNull(SocialMedia::find($socialId));
    }

    public function test_social_media_is_active_is_cast_to_boolean()
    {
        $social = SocialMedia::create([
            'platform' => 'Test',
            'url' => 'https://test.com',
            'is_active' => 1,
        ]);

        $this->assertIsBool($social->is_active);
        $this->assertTrue($social->is_active);
    }

    public function test_social_media_sort_order_is_cast_to_integer()
    {
        $social = SocialMedia::create([
            'platform' => 'Test',
            'url' => 'https://test.com',
            'sort_order' => '5',
        ]);

        $this->assertIsInt($social->sort_order);
        $this->assertEquals(5, $social->sort_order);
    }

    public function test_social_media_fillable_attributes()
    {
        $attributes = [
            'platform' => 'Instagram',
            'url' => 'https://instagram.com/example',
            'icon' => 'fab fa-instagram',
            'is_active' => true,
            'sort_order' => 2,
        ];

        $social = SocialMedia::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $social->$key);
        }
    }

    public function test_social_media_platforms()
    {
        $platforms = ['Facebook', 'Instagram', 'Twitter', 'LinkedIn', 'YouTube'];

        foreach ($platforms as $platform) {
            $social = SocialMedia::factory()->create(['platform' => $platform]);
            $this->assertEquals($platform, $social->platform);
        }
    }

    public function test_social_media_sort_order_determines_display_order()
    {
        SocialMedia::truncate();

        $social3 = SocialMedia::factory()->create(['platform' => 'C', 'sort_order' => 3]);
        $social1 = SocialMedia::factory()->create(['platform' => 'A', 'sort_order' => 1]);
        $social2 = SocialMedia::factory()->create(['platform' => 'B', 'sort_order' => 2]);

        $ordered = SocialMedia::orderBy('sort_order')->get();

        $this->assertEquals(1, $ordered->first()->sort_order);
        $this->assertEquals(2, $ordered[1]->sort_order);
        $this->assertEquals(3, $ordered->last()->sort_order);
    }

    public function test_social_media_has_timestamps()
    {
        $social = SocialMedia::factory()->create();

        $this->assertNotNull($social->created_at);
        $this->assertNotNull($social->updated_at);
    }
}
