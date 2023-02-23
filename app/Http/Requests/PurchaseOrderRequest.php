<?php

namespace App\Http\Requests;

/**
 * Purchase Order Request
 */
class PurchaseOrderRequest extends BaseRequest
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
     * 
     * Card Number - Regular expression pattern will match most of the common credit card numbers, 
     * including Visa, MasterCard, American Express, Discover, Diners Club, and JCB.
     * 
     * Card Expiration Date - Regular expression matches expiration dates in the format of MM/YYYY or MM/YY
     * 
     * Card CVV - Regular expression matches 3 or 4 digits
     */
    public function rules(): array
    {
        return [
            'cardNumber'         => [
                'required', 
                'regex:/^(4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14}|6(?:011|5[0-9][0-9])[0-9]{12}|3[47][0-9]{13}|3(?:0[0-5]|[68][0-9])[0-9]{11}|(?:2131|1800|35\d{3})\d{11})$/'
            ],
            'cardCVV'            => ['required', 'regex:/^[0-9]{3,4}$/'],
            'cardExpirationDate' => ['required', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{4}|[0-9]{2})$/']
        ];
    }

    /**
     * Custom error messages
     */
    public function messages(): array
    {
        return [
            'cardCVV.regex' => 'The card CVV field format is invalid.'
        ];
    }
}
