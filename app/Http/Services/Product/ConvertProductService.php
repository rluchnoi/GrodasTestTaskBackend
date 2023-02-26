<?php

namespace App\Http\Services\Product;

use App\Models\Currency;
use App\Models\Product;
use Exception;
use Illuminate\Support\Collection;

/**
 * Convert Product Service
 */
class ConvertProductService
{
    /**
     * Round until number
     */
    const ROUND_UNTIL = 3;

    public function convert(Product|Collection $data, string $currencyName)
    {
        $currencyExists = Currency::find($currencyName);

        if ($currencyExists) {
            return match (true) {
                $data instanceof Product    => $this->formatData($data, $currencyExists),
                $data instanceof Collection => $data->map(fn ($product) => $this->formatData($product, $currencyExists)),
            };
        }

        $existingCurrencies = implode(', ', config('currencies'));

        throw new Exception("Provided currency do not exist. Please select one from the list: $existingCurrencies");
    }

    /**
     * Format product data
     */
    private function formatData(Product $product, Currency $currency): array
    {
        return [
            'id'            => $product->id,
            'name'          => $product->name,
            'order_id'      => $product->order_id,
            'price'         => $this->calculatePrice($product, $currency),
            'currency_name' => $currency->name
        ];
    }

    /**
     * Calculate new price
     */
    private function calculatePrice(Product $product, Currency $newCurrency): string
    {
        if ($product->currency->name === $newCurrency->name) {
            return round($product->price, 2);
        }

        $productCurrencyRate = $product->currency->rate;
        $newCurrencyRate     = $newCurrency->rate;
        $relation            = $productCurrencyRate / $newCurrencyRate;

        return $this->roundPrice(round($product->price * $relation, 2));
    }

    /**
     * Round price algorithm
     */
    private function roundPrice(float $price): string
    {
        $multiplier = pow(10, floor(log10(abs($price))) - (self::ROUND_UNTIL - 1));

        return (string)round($price / $multiplier) * $multiplier;
    }
}
