<?php

namespace App\Http\Requests;

class UpdateBookRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'title' => 'sometimes|string|max:255',
            'author' => 'sometimes|string|max:255',
            'published_year' => 'sometimes|integer|min:0|max:' . date( 'Y' ),
            'isbn' => 'sometimes|string|unique:books,isbn,' . $this->route( 'book' )->id . '|max:13',
        ];
    }
}
