<?php

namespace App\Jobs;

use App\Models\Currency;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

/**
 * A job which fecthes currencies rates and saves them
 */
class FetchCurrenciesRatesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Job logger prefix
     */
    const LOGGER_PREFIX = 'Rate Job. ';

    /**
     * Fetch currencies rates
     */
    public function handle(): void
    {
        $response = Http::get('https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json');

        if ($response->successful()) {
            $currencies = collect($response->json())
                ->whereIn('cc', config('currencies'));

            $this->save($currencies);

            $this->loggFetchStatus('Success: Currencies were fetched');
        } else {
            $this->loggFetchStatus('Error: Currencies were not fetched');
        }
    }

    /**
     * Log fetch status
     */
    private function loggFetchStatus(string $message)
    {
        Log::info(self::LOGGER_PREFIX . $message);
    }

    /**
     * Save currencies data to the database
     */
    private function save(Collection $currencies): void
    {
        $currencies->map(fn ($currency) => 
            Currency::updateOrCreate(['name' => $currency['cc']], [
                'name'          => $currency['cc'],
                'full_name'     => $currency['txt'],
                'rate'          => $currency['rate'],
                'exchange_date' => $currency['exchangedate']
            ]));
    }
}
