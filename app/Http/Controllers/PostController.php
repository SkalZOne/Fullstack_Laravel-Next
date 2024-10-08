<?php

namespace App\Http\Controllers;

use App\Http\Requests\ManyPostsRequest;
use App\Http\Requests\SinglePostRequest;
use App\Http\Resources\ManyPostsResource;
use App\Http\Resources\SinglePostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Validator;

class PostController extends BaseController
{

    public function all(ManyPostsRequest $request)
    {
        $data = $request->validated();

        if (isset($data['filter'])) {
            $query = $this->service->filter($data);
        } else {
            $query = Post::query();
        }

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
            return $this->service->getValidationError($validator);
        } else {
            $create = Post::create($validator->getData());
            $postId = $create->id;

            return $this->service->getValidationSuccess($postId);
        }
    }
}
