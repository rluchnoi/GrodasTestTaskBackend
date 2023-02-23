<?php

namespace App\Http\Requests;

/**
 * Store Product Request
 */
class StoreProductRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string',
            'user_id' => 'required|int',
            'price'   => 'required|int',
        ];
    }
}
