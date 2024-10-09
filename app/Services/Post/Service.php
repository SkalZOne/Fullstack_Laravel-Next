<?php


namespace App\Services\Post;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class Service
{
    public function filter($data, $posts)
    {
        switch (true) {
            case $data['filter'] == "priceDesc":
                return $posts->orderBy('price', 'desc')->paginate(10);
            case $data['filter'] == "priceAsc":
                return $posts->orderBy('price', 'asc')->paginate(10);
            case $data['filter'] == "dateDesc":
                return $posts->orderBy('created_at', 'desc')->paginate(10);
            case $data['filter'] == "dateAsc":
                return $posts->orderBy('created_at', 'asc')->paginate(10);
        }
    }

    public function getValidationError($validator)
    {
        return [
            'status' => 'Error',
            'error_messages' => $validator->messages()->all()
        ];
    }

    public function getValidationSuccess($postId)
    {
        return [
            'status' => 'Created',
            'post_id' => $postId
        ];
    }
}