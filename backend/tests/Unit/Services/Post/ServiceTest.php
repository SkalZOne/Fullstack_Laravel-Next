<?php

namespace Tests\Unit\Services\Post;

use App\Models\Post;
use Str;
use Tests\TestCase;
use Validator;

class ServiceTest extends TestCase
{
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new \App\Services\Post\Service;
    }

    // Filters Testings
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

        $this->assertGreaterThan($result[1]->created_at, $result[0]->created_at);
    }

    public function test_filterDateAsc(): void
    {
        $createdPosts = Post::factory()->count(2)->create()->toQuery();
        $result = $this->service->filter(['filter' => 'dateAsc'], $createdPosts)->all();

        $this->assertLessThan($result[1]->created_at, $result[0]->created_at);
    }


    // Validation Testings
    public function test_getValidationError(): void
    {
        $validator = Validator::make([], [
            'title' => 'required'
        ]);
        
        $this->assertIsString($this->service->getValidationError($validator)['error_messages'][0]);
    }

    public function test_getValidationSuccess(): void
    {

        $createdPostId = Post::factory()->count(1)->create()->all()[0]['id'];

        $this->assertIsInt($this->service->getValidationSuccess($createdPostId)['post_id']);
    }

}
