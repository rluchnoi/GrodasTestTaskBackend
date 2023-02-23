<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

if (! function_exists('model_binding_error_response')) {
    function model_binding_error_response(): Response
    {
        return response([
            'error' => 'Specified ID was not resolved!'
        ], JsonResponse::HTTP_NOT_FOUND);
    }
}