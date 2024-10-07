<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Http\Resources\PostsResource;
use App\Models\Post;

class PostController extends Controller
{

    public function show(FilterRequest $request) {
        
        $data = $request->validated();

        dd($data);


        $orders = Post::paginate(10);

        return PostsResource::collection($orders);
    }

}
