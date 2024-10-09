<?php

namespace Tests\Unit\Services\Post;

use App\Models\Post;
use Tests\TestCase;

class ServiceTest extends TestCase
{
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new \App\Services\Post\Service;
    }

    /**
     * A basic unit test example.
     */
    public function test_filterPriceDesc(): void
    {
        $createdPosts = Post::factory()->count(2)->create()->toQuery();
        $result = $this->service->filter(['filter' => 'priceDesc'], $createdPosts)->all();

        $this->assertGreaterThan($result[1]->price, $result[0]->price);
    }

    public function test_filterPriceAsc(): void
    {
        $createdPosts = Post::factory()->count(2)->create()->toQuery();
        $result = $this->service->filter(['filter' => 'priceAsc'], $createdPosts)->all();

        $this->assertLessThan($result[1]->price, $result[0]->price);
    }

    public function test_filterDateDesc(): void
    {
        $createdPosts = Post::factory()->count(2)->create()->toQuery();
        $result = $this->service->filter(['filter' => 'dateDesc'], $createdPosts)->all();

        $this->assertGreaterThan($result[1]->price, $result[0]->price);
    }

    public function test_filterDateAsc(): void
    {
        $createdPosts = Post::factory()->count(2)->create()->toQuery();
        $result = $this->service->filter(['filter' => 'dateAsc'], $createdPosts)->all();

        $this->assertLessThan($result[1]->price, $result[0]->price);
    }
}
