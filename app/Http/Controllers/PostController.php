<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;

class PostController extends Controller
{

    public function all(PostsRequest $request)
    {
        $data = $request->validated();

        if (isset($data['filter'])) {
            switch (true) {
                case $data['filter'] == "priceDesc":
                    $query = Post::orderBy('price', 'desc');
                    break;
                case $data['filter'] == "priceAsc":
                    $query = Post::orderBy('price', 'asc');
                    break;
                case $data['filter'] == "dateDesc":
                    $query = Post::orderBy('created_at', 'desc');
                    break;
                case $data['filter'] == "dateAsc":
                    $query = Post::orderBy('created_at', 'asc');
                    break;
            }
        }

        $query = Post::query();
        $posts = $query->paginate(10)->all();

        return PostsResource::collection($posts);
    }

    public function single(PostsRequest $request)
    {
        $data = $request->validated();

        if (isset($data['filter'])) {
            switch (true) {
                case $data['filter'] == "priceDesc":
                    $query = Post::orderBy('price', 'desc');
                    break;
                case $data['filter'] == "priceAsc":
                    $query = Post::orderBy('price', 'asc');
                    break;
                case $data['filter'] == "dateDesc":
                    $query = Post::orderBy('created_at', 'desc');
                    break;
                case $data['filter'] == "dateAsc":
                    $query = Post::orderBy('created_at', 'asc');
                    break;
            }
        }

        $query = Post::query();
        $posts = $query->paginate(10)->all();

        return PostsResource::collection($posts);
    }
}
