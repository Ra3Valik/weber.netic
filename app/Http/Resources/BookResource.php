<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     schema="Book",
     *     title="Book",
     *     description="Book model",
     *     type="object",
     *     required={"id", "title", "author", "published_year", "isbn"},
     *     @OA\Property(property="id", type="integer", example=1),
     *     @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *     @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
     *     @OA\Property(property="published_year", type="integer", example=1925),
     *     @OA\Property(property="isbn", type="string", example="978-3-16-148410-0"),
     *     @OA\Property(property="created_at", type="string", format="date-time"),
     *     @OA\Property(property="updated_at", type="string", format="date-time")
     * )
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'published_year' => $this->published_year,
            'isbn' => $this->isbn,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
