<?php

namespace Tests\Unit\Models;

use App\Models\Testimonial;
use Tests\TestCase;

class TestimonialTest extends TestCase
{
    public function test_testimonial_can_be_created()
    {
        $testimonial = Testimonial::create([
            'name' => 'John Doe',
            'occupation' => 'Software Developer',
            'content' => 'Great place to visit with family!',
            'avatar_url' => '/storage/avatar.jpg',
            'rating' => 5,
            'is_active' => true,
        ]);

        $this->assertNotNull($testimonial->id);
        $this->assertEquals('John Doe', $testimonial->name);
    }

    public function test_testimonial_can_be_updated()
    {
        $testimonial = Testimonial::factory()->create();

        $testimonial->update([
            'name' => 'Jane Doe',
            'rating' => 4,
        ]);

        $this->assertEquals('Jane Doe', $testimonial->name);
        $this->assertEquals(4, $testimonial->rating);
    }

    public function test_testimonial_can_be_deleted()
    {
        $testimonial = Testimonial::factory()->create();
        $testimonialId = $testimonial->id;

        $testimonial->delete();

        $this->assertNull(Testimonial::find($testimonialId));
    }

    public function test_testimonial_is_active_is_cast_to_boolean()
    {
        $testimonial = Testimonial::create([
            'name' => 'Test',
            'content' => 'Test',
            'is_active' => 1,
        ]);

        $this->assertIsBool($testimonial->is_active);
        $this->assertTrue($testimonial->is_active);
    }

    public function test_testimonial_rating_is_cast_to_integer()
    {
        $testimonial = Testimonial::create([
            'name' => 'Test',
            'content' => 'Test',
            'rating' => '5',
        ]);

        $this->assertIsInt($testimonial->rating);
        $this->assertEquals(5, $testimonial->rating);
    }

    public function test_testimonial_fillable_attributes()
    {
        $attributes = [
            'name' => 'Test User',
            'occupation' => 'Test Job',
            'content' => 'Test Content',
            'avatar_url' => '/storage/test.jpg',
            'rating' => 5,
            'is_active' => true,
        ];

        $testimonial = Testimonial::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $testimonial->$key);
        }
    }

    public function test_testimonial_rating_validation()
    {
        $testimonial1 = Testimonial::factory()->create(['rating' => 1]);
        $testimonial5 = Testimonial::factory()->create(['rating' => 5]);

        $this->assertEquals(1, $testimonial1->rating);
        $this->assertEquals(5, $testimonial5->rating);
    }

    public function test_testimonial_has_timestamps()
    {
        $testimonial = Testimonial::factory()->create();

        $this->assertNotNull($testimonial->created_at);
        $this->assertNotNull($testimonial->updated_at);
    }
}
