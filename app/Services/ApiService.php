<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ApiService
{
    private int $UAH = 980;
    private int $USD = 840;
    private int $EUR = 978;
    protected $apiUrl = 'https://api.monobank.ua/bank/currency';
    protected $apiToken = 'uxZqWAaiC4LIvhSKQ1ck8Z3wxXXZd166Non-jnWP8ibc';
    public function getExchangeRate() {
        // Спробуємо отримати дані з кешу за ключем, який залежить від валютних кодів.
        $cacheKey = "exchange_rate_currencies";
        $exchangeRate = Cache::get($cacheKey);

        if (!$exchangeRate) {
            // Якщо дані не знайдені в кеші, отримуємо їх з API та зберігаємо в кеші на 1 годину (або будь-який інший проміжок часу за вашим вибором).
            $exchangeRate = $this->getCurrencyRates();
            // Зберігаємо отриманий курс в кеші за ключем на 1 годину.
            Cache::put($cacheKey, $exchangeRate, now()->addHour());
        }

        return $exchangeRate;
    }
    public function getCurrencyRates()
    {
        $client = new Client();

        $headers = [
            'X-Token' => $this->apiToken,
        ];

        $response = $client->get($this->apiUrl, [
            'headers' => $headers,
        ]);

        $data = json_decode($response->getBody(), true);

// Розгорнемо JSON у асоціативний масив з ключами currencyCodeA та currencyCodeB
        $exchangeRates = [];
        foreach ($data as $currencyData) {
            $fromCurrency = $currencyData['currencyCodeA'];
            $toCurrency = $currencyData['currencyCodeB'];
            $exchangeRates["{$fromCurrency}_{$toCurrency}"] = $currencyData;
        }
        return $exchangeRates;
    }
    public function convertCurrency(Request $request)
    {
        $desiredPrecision = 2;
        $Rates = $this->getExchangeRate();
        $transactions = $request->user()->accounts()->with('transactions')->get()->pluck('transactions')->flatten()
            ->sortByDesc('date');
        foreach ($transactions as $transaction) {
            $fromCurrency = $transaction->account->currency->code;
            $toCurrency = auth()->user()->currency->code;

            if ($toCurrency == $fromCurrency){
                continue;
            }

            if ($toCurrency == $this->EUR && $fromCurrency == $this->USD){
                $exchangeRates = $Rates["{$toCurrency}_{$fromCurrency}"];

                $transaction->sum *= $exchangeRates['rateBuy'];
                $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                continue;
            } elseif ($fromCurrency == $this->EUR && $toCurrency == $this->USD) {
                $exchangeRates = $Rates["{$fromCurrency}_{$toCurrency}"];
                $transaction->sum /= $exchangeRates['rateSell'];
                $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                continue;
            }
            if ($toCurrency == $this->UAH){
                $exchangeRates = $Rates["{$fromCurrency}_{$this->UAH}"];
                if($exchangeRates['rateCross'] == 0){
                    $transaction->sum *= $exchangeRates['rateBuy'];
                    $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                } else {
                    $transaction->sum *= $exchangeRates['rateCross'];
                    $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                }
                continue;
            }

            if ($fromCurrency == $this->UAH){
                $exchangeRates = $Rates["{$toCurrency}_{$this->UAH}"];
                if($exchangeRates['rateCross'] == 0){
                    $transaction->sum /= $exchangeRates['rateSell'];
                    $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                } else {
                    $transaction->sum /= $exchangeRates['rateCross'];
                    $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                }
                continue;
            }

            if ($toCurrency == $this->USD || $toCurrency == $this->EUR){
                $exchangeRates = $Rates["{$fromCurrency}_{$this->UAH}"];
                $transaction->sum *= $exchangeRates['rateCross'];
                $exchangeRates = $Rates["{$toCurrency}_{$this->UAH}"];
                $transaction->sum /= $exchangeRates['rateSell'];
                $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                continue;
            }

            if ($fromCurrency == $this->USD || $fromCurrency == $this->EUR){
                $exchangeRates = $Rates["{$fromCurrency}_{$this->UAH}"];
                $transaction->sum *= $exchangeRates['rateBuy'];
                $exchangeRates = $Rates["{$toCurrency}_{$this->UAH}"];
                $transaction->sum /= $exchangeRates['rateCross'];
                $transaction->sum = number_format($transaction->sum, $desiredPrecision);
                continue;
            }

            if ($fromCurrency != $this->UAH && $toCurrency != $this->UAH ) {
                $exchangeRates = $Rates["{$fromCurrency}_{$this->UAH}"];
                $transaction->sum *= $exchangeRates['rateCross'];
                $exchangeRates = $Rates["{$toCurrency}_{$this->UAH}"];
                $transaction->sum /= $exchangeRates['rateCross'];
                $transaction->sum = number_format($transaction->sum, $desiredPrecision);
            }
        }
        return $transactions;
    }
}
