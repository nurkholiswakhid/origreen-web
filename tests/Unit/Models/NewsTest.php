<?php

namespace Tests\Unit\Models;

use App\Models\News;
use Illuminate\Support\Str;
use Tests\TestCase;

class NewsTest extends TestCase
{
    public function test_news_can_be_created()
    {
        $news = News::create([
            'title' => 'Breaking News ' . time(),
            'excerpt' => 'This is a news excerpt',
            'content' => 'Full content of the news',
            'is_active' => true,
        ]);

        $this->assertNotNull($news->id);
        $this->assertStringContainsString('Breaking News', $news->title);
    }

    public function test_news_can_be_updated()
    {
        $news = News::factory()->create();

        $news->update([
            'title' => 'Updated News ' . time(),
            'content' => 'Updated content',
        ]);

        $this->assertStringContainsString('Updated News', $news->title);
        $this->assertEquals('Updated content', $news->content);
    }

    public function test_news_can_be_deleted()
    {
        $news = News::factory()->create();
        $newsId = $news->id;

        $news->delete();

        $this->assertNull(News::find($newsId));
    }

    public function test_news_slug_is_automatically_generated()
    {
        $title = 'My Breaking News Title ' . time();
        $news = News::create([
            'title' => $title,
            'excerpt' => 'Brief excerpt',
            'content' => 'Some content',
        ]);

        $expected_slug = Str::slug($title);
        $this->assertEquals($expected_slug, $news->slug);
    }

    public function test_news_slug_is_updated_when_title_changes()
    {
        $news = News::factory()->create();

        $new_title = 'New Title ' . time();
        $news->update(['title' => $new_title]);

        $expected_slug = Str::slug($new_title);
        $this->assertEquals($expected_slug, $news->slug);
    }

    public function test_news_slug_is_not_updated_if_title_not_changed()
    {
        $news = News::factory()->create();
        $original_slug = $news->slug;

        $news->update(['content' => 'Updated content']);

        $this->assertEquals($original_slug, $news->slug);
    }

    public function test_news_is_active_is_cast_to_boolean()
    {
        $news = News::factory()->create([
            'is_active' => 1,
        ]);

        $this->assertIsBool($news->is_active);
        $this->assertTrue($news->is_active);
    }

    public function test_news_published_at_is_cast_to_datetime()
    {
        $now = now();
        $news = News::factory()->create([
            'published_at' => $now,
        ]);

        $this->assertNotNull($news->published_at);
    }

    public function test_news_fillable_attributes()
    {
        $title = 'Test News ' . time();
        $attributes = [
            'title' => $title,
            'excerpt' => 'Test Excerpt',
            'content' => 'Test Content',
            'image_url' => '/storage/test.jpg',
            'is_active' => true,
        ];

        $news = News::create($attributes);

        $this->assertEquals($title, $news->title);
        $this->assertEquals('Test Excerpt', $news->excerpt);
    }

    public function test_news_has_timestamps()
    {
        $news = News::factory()->create();

        $this->assertNotNull($news->created_at);
        $this->assertNotNull($news->updated_at);
    }
}
