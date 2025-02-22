<?php

namespace App\Http\Requests;

class BookRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules() : array
    {
        return [
            'author' => ['nullable', 'string', 'max:255'],
            'published_year' => ['nullable', 'integer', 'min:0', 'max:' . date( 'Y' )],
            'published_year_from' => ['nullable', 'integer', 'min:1000', 'max:' . date( 'Y' )],
            'published_year_to' => ['nullable', 'integer', 'min:0', 'max:' . date( 'Y' ), 'gt:published_year_from'],
            'sort_by' => ['nullable', 'string', 'in:title,published_year'],
            'order' => ['nullable', 'string', 'in:asc,desc'],
        ];
    }
}
