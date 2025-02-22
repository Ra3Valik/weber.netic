<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class BaseApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return true;
    }

    abstract public function rules(): array;

    /**
     * Handle a failed validation attempt.
     */
    protected function failedValidation( Validator $validator )
    {
        throw new HttpResponseException( response()->json( [
            'success' => false,
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422 ) );
    }
}
