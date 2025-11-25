<?php

namespace Tests\Unit\Models;

use App\Models\MapSetting;
use Tests\TestCase;

class MapSettingTest extends TestCase
{
    public function test_map_setting_can_be_created()
    {
        $mapSetting = MapSetting::create([
            'address' => 'Jl. Merdeka No. 123, Jakarta',
            'phone' => '+62812345678',
            'email' => 'info@example.com',
            'operation_hours' => '09:00-17:00',
            'google_maps_url' => 'https://maps.google.com/?q=...',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=...',
        ]);

        $this->assertNotNull($mapSetting->id);
        $this->assertEquals('Jl. Merdeka No. 123, Jakarta', $mapSetting->address);
    }

    public function test_map_setting_can_be_updated()
    {
        $mapSetting = MapSetting::factory()->create();

        $mapSetting->update([
            'address' => 'Jl. Updated No. 456',
            'phone' => '+62898765432',
        ]);

        $this->assertEquals('Jl. Updated No. 456', $mapSetting->address);
        $this->assertEquals('+62898765432', $mapSetting->phone);
    }

    public function test_map_setting_can_be_deleted()
    {
        $mapSetting = MapSetting::factory()->create();
        $mapSettingId = $mapSetting->id;

        $mapSetting->delete();

        $this->assertNull(MapSetting::find($mapSettingId));
    }

    public function test_map_setting_fillable_attributes()
    {
        $attributes = [
            'address' => 'Test Address',
            'phone' => '+6281234567',
            'email' => 'test@example.com',
            'operation_hours' => '10:00-18:00',
            'google_maps_url' => 'https://maps.google.com',
            'map_embed_url' => 'https://www.google.com/maps/embed',
        ];

        $mapSetting = MapSetting::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $mapSetting->$key);
        }
    }

    public function test_map_setting_contact_information()
    {
        $mapSetting = MapSetting::factory()->create([
            'phone' => '+62812345678',
            'email' => 'contact@example.com',
        ]);

        $this->assertNotNull($mapSetting->phone);
        $this->assertNotNull($mapSetting->email);
        $this->assertStringStartsWith('+62', $mapSetting->phone);
        $this->assertStringContainsString('@', $mapSetting->email);
    }

    public function test_map_setting_operation_hours()
    {
        $mapSetting = MapSetting::factory()->create([
            'operation_hours' => '09:00-17:00',
        ]);

        $this->assertNotNull($mapSetting->operation_hours);
    }

    public function test_map_setting_map_urls()
    {
        $mapSetting = MapSetting::factory()->create([
            'google_maps_url' => 'https://maps.google.com/place/example',
            'map_embed_url' => 'https://www.google.com/maps/embed?pb=example',
        ]);

        $this->assertNotNull($mapSetting->google_maps_url);
        $this->assertNotNull($mapSetting->map_embed_url);
        $this->assertStringStartsWith('https://', $mapSetting->google_maps_url);
    }

    public function test_map_setting_has_timestamps()
    {
        $mapSetting = MapSetting::factory()->create();

        $this->assertNotNull($mapSetting->created_at);
        $this->assertNotNull($mapSetting->updated_at);
    }
}
