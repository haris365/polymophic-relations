<?php

namespace App\Services;

use App\Models\Image;

class ImageService{

    private $post;

    public function __construct(object $post)
    {
        $this->post = $post;
    }

    public function getImage($image = NULL)
    {              
        $image_path = $image->store('image', 'public');       
        $image  = Image::create([
            'url' => $image_path,
            'imageable_type' => 'App\Models\Post',
            'imageable_id' => $this->post->id,
        ]);

        return $image;
    }
}