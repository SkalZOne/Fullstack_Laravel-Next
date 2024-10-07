<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostsRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;

class PostController extends Controller
{

    public function show(PostsRequest $request)
    {

        $data = $request->validated();


        switch (isset($data['filter'])) {
            case "priceDesc":
                $query = Post::orderBy('price', 'desc');
                break;
            case "priceAsc":
                $query = Post::orderBy('price', 'asc');
                break;
            case "dateDesc":
                $query = Post::orderBy('created_at', 'desc');
                break;
            case "dateAsc":
                $query = Post::orderBy('created_at', 'asc');
                break;
            default:
                $query = Post::query();
                break;
        }

        $posts = $query->paginate(10)->all();

        return PostsResource::collection($posts);
    }

}
