<?php

namespace Tests\Feature\Admin;

use App\Models\Faq;
use App\Models\User;
use Tests\TestCase;

class FaqControllerTest extends TestCase
{
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        
        $this->admin = User::factory()->create([
            'is_admin' => true,
            'email' => 'admin-faq-' . uniqid() . '@example.com',
        ]);
    }

    public function test_admin_can_view_faqs_list()
    {
        $response = $this->actingAs($this->admin)
            ->get(route('admin.faqs.index'));

        $response->assertStatus(200);
    }

    public function test_admin_can_create_faq()
    {
        $data = [
            'question' => 'Test Question?',
            'answer' => 'Test Answer',
            'is_active' => true,
        ];

        $response = $this->actingAs($this->admin)
            ->post(route('admin.faqs.store'), $data);

        $this->assertDatabaseHas('faqs', [
            'question' => 'Test Question?',
        ]);
    }

    public function test_admin_can_update_faq()
    {
        $faq = Faq::factory()->create();

        $data = [
            'question' => 'Updated Question?',
            'answer' => 'Updated Answer',
            'is_active' => true,
            'order' => 1,
        ];

        $this->actingAs($this->admin)
            ->put(route('admin.faqs.update', $faq), $data);

        $this->assertDatabaseHas('faqs', [
            'id' => $faq->id,
            'question' => 'Updated Question?',
        ]);
    }

    public function test_admin_can_delete_faq()
    {
        $faq = Faq::factory()->create();

        $this->actingAs($this->admin)
            ->delete(route('admin.faqs.destroy', $faq));

        $this->assertDatabaseMissing('faqs', [
            'id' => $faq->id,
        ]);
    }
}
