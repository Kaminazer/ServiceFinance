<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    public function run(): void
    {
        $currenciesData = [
            [
                'name' => 'Гривня',
                'code' => 980
            ],

            [
                'name' => 'Долар США',
                'code' => 840
            ],

            [
                'name' => 'Євро',
                'code' => 978
            ],

            [
                'name' => 'Злотий',
                'code' => 985
            ],

            [
                'name' => 'Данська крона',
                'code' => 208
            ],

            [
                'name' => 'Канадський долар',
                'code' => 124
            ],
        ];

        foreach ($currenciesData as $currencyData) {
            Currency::create($currencyData);
        }
    }
}
