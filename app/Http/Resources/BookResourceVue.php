<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResourceVue extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'description' => $this->description,
            'price' => $this->price,
            'cover' => url($this->cover), 
            'authors' => $this->authors->implode('fullname', ', '),
            'genres' => $this->genres->implode('name', ', '),
            'reviews' => $this->reviews,
            'rating' => $this->getAverageBookRating()

            //'authors' => AuthorResource::collection($this->whenLoaded('authors')), 
            //'genres' => GenreResource::collection($this->whenLoaded('genres')), 
        ];
    }
}
