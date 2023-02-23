<?php

namespace App\Http\Requests;

/**
 * Update Product Request
 */
class UpdateProductRequest extends StoreProductRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'    => 'string',
            'user_id' => 'int',
            'price'   => 'int',
        ];
    }
}
