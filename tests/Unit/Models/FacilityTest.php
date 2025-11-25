<?php

namespace Tests\Unit\Models;

use App\Models\Facility;
use Tests\TestCase;

class FacilityTest extends TestCase
{
    public function test_facility_can_be_created()
    {
        $facility = Facility::create([
            'name' => 'Roller Coaster',
            'description' => 'A thrilling roller coaster ride',
            'display_type' => 'image',
            'icon' => 'fas fa-heart',
            'main_icon' => 'fas fa-star',
            'duration' => 120,
            'type' => 'wahana',
            'is_active' => true,
            'order' => 1,
        ]);

        $this->assertNotNull($facility->id);
        $this->assertEquals('Roller Coaster', $facility->name);
        $this->assertTrue($facility->is_active);
    }

    public function test_facility_can_be_updated()
    {
        $facility = Facility::factory()->create();

        $facility->update([
            'name' => 'Updated Facility',
            'is_active' => false,
        ]);

        $this->assertEquals('Updated Facility', $facility->name);
        $this->assertFalse($facility->is_active);
    }

    public function test_facility_can_be_deleted()
    {
        $facility = Facility::factory()->create();
        $facilityId = $facility->id;

        $facility->delete();

        $this->assertNull(Facility::find($facilityId));
    }

    public function test_facility_is_active_is_cast_to_boolean()
    {
        $facility = Facility::create([
            'name' => 'Test Facility',
            'description' => 'Test Description',
            'is_active' => 1,
        ]);

        $this->assertIsBool($facility->is_active);
        $this->assertTrue($facility->is_active);
    }

    public function test_facility_fillable_attributes()
    {
        $attributes = [
            'name' => 'Test Facility',
            'description' => 'Test Description',
            'display_type' => 'image',
            'icon' => 'fas fa-icon',
            'duration' => 60,
            'type' => 'wahana',
            'is_active' => true,
        ];

        $facility = Facility::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $facility->$key);
        }
    }

    public function test_facility_type_can_be_wahana_or_fasilitas()
    {
        $wahana = Facility::create(['name' => 'Wahana', 'description' => 'Test', 'type' => 'wahana']);
        $fasilitas = Facility::create(['name' => 'Fasilitas', 'description' => 'Test', 'type' => 'fasilitas']);

        $this->assertEquals('wahana', $wahana->type);
        $this->assertEquals('fasilitas', $fasilitas->type);
    }

    public function test_facility_display_type_can_be_image_or_icon()
    {
        $imageType = Facility::create(['name' => 'Image', 'description' => 'Test', 'display_type' => 'image']);
        $iconType = Facility::create(['name' => 'Icon', 'description' => 'Test', 'display_type' => 'icon']);

        $this->assertEquals('image', $imageType->display_type);
        $this->assertEquals('icon', $iconType->display_type);
    }

    public function test_facility_has_timestamps()
    {
        $facility = Facility::factory()->create();

        $this->assertNotNull($facility->created_at);
        $this->assertNotNull($facility->updated_at);
    }

    public function test_facility_media_collection_registration()
    {
        $facility = Facility::factory()->create();

        // Test that media collection exists
        $this->assertTrue(method_exists($facility, 'registerMediaCollections'));
    }
}
