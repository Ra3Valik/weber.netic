<?php

namespace App\Http\Requests;

class StoreBookRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'published_year' => 'required|integer|min:0|max:' . date( 'Y' ),
            'isbn' => 'required|string|unique:books,isbn|max:13',
        ];
    }
}
