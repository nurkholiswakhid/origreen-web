<?php

namespace Tests\Unit\Models;

use App\Models\Faq;
use Tests\TestCase;

class FaqTest extends TestCase
{
    public function test_faq_can_be_created()
    {
        $faq = Faq::create([
            'question' => 'What is the opening time?',
            'answer' => 'We open at 08:00 AM',
            'is_active' => true,
            'order' => 1,
        ]);

        $this->assertNotNull($faq->id);
        $this->assertEquals('What is the opening time?', $faq->question);
    }

    public function test_faq_can_be_updated()
    {
        $faq = Faq::factory()->create();

        $faq->update([
            'question' => 'Updated Question?',
            'answer' => 'Updated Answer',
        ]);

        $this->assertEquals('Updated Question?', $faq->question);
        $this->assertEquals('Updated Answer', $faq->answer);
    }

    public function test_faq_can_be_deleted()
    {
        $faq = Faq::factory()->create();
        $faqId = $faq->id;

        $faq->delete();

        $this->assertNull(Faq::find($faqId));
    }

    public function test_faq_is_active_is_cast_to_boolean()
    {
        $faq = Faq::create([
            'question' => 'Test?',
            'answer' => 'Test Answer',
            'is_active' => 1,
        ]);

        $this->assertIsBool($faq->is_active);
        $this->assertTrue($faq->is_active);
    }

    public function test_faq_fillable_attributes()
    {
        $attributes = [
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'is_active' => true,
            'order' => 5,
        ];

        $faq = Faq::create($attributes);

        foreach ($attributes as $key => $value) {
            $this->assertEquals($value, $faq->$key);
        }
    }

    public function test_faq_order_can_be_set()
    {
        $faq1 = Faq::factory()->create(['order' => 1]);
        $faq2 = Faq::factory()->create(['order' => 2]);
        $faq3 = Faq::factory()->create(['order' => 3]);

        $this->assertEquals(1, $faq1->order);
        $this->assertEquals(2, $faq2->order);
        $this->assertEquals(3, $faq3->order);
    }

    public function test_faq_has_timestamps()
    {
        $faq = Faq::factory()->create();

        $this->assertNotNull($faq->created_at);
        $this->assertNotNull($faq->updated_at);
    }
}
