<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManyPostsRequest;
use App\Http\Requests\SinglePostRequest;
use App\Http\Resources\ManyPostsResource;
use App\Http\Resources\SinglePostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends Controller
{

    public function all(ManyPostsRequest $request)
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

        return ManyPostsResource::collection($posts);
    }

    public function single(SinglePostRequest $request)
    {
        $data = $request->validated();

        $query = Post::query();

        $post = $query->where('title', 'like', "%{$data['title']}%")->get();

        return SinglePostResource::collection($post);
    }

    public function create(Request $request)
    { 
        $validator = Validator::make($request->all(), [
            'title' => '',
            'description' => '',
            'primary_photo' => 'url|onlyOneUrl',
            'secondary_photo' => 'url|onlyOneUrl',
            'third_photo' => 'url|onlyOneUrl',
            'price' => ''
        ]);

        if ($validator->fails()) {
            return [
                'status' => 'Error',
                'error_messages' => $validator->messages()->all()
            ];
        } else {
            $create = Post::create($validator->getData());

            $createdPostId = $create->id;

            return [
                'status' => 'Created',
                'post_id' => $createdPostId
            ];
        }
    }
}
