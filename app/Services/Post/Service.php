<?php


namespace App\Services\Post;
use App\Models\Post;

class Service
{
    public function filter($data)
    {
        switch (true) {
            case $data['filter'] == "priceDesc":
                return Post::orderBy('price', 'desc');
            case $data['filter'] == "priceAsc":
                return Post::orderBy('price', 'asc');
            case $data['filter'] == "dateDesc":
                return Post::orderBy('created_at', 'desc');
            case $data['filter'] == "dateAsc":
                return Post::orderBy('created_at', 'asc');
        }
    }

    public function getValidationError($validator) {
        return [
            'status' => 'Error',
            'error_messages' => $validator->messages()->all()
        ];
    }

    public function getValidationSuccess($postId) {
        return [
            'status' => 'Created',
            'post_id' => $postId
        ];
    }
}