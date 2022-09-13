<?php

use App\Support\StockMarket;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    // $queryString = http_build_query([
    //     'access_key' => 'ffc54f8582fc4832cfea1d8c71f36862'
    // ]);

    // $ch = curl_init(sprintf('%s?%s', 'http://api.marketstack.com/v1/tickers/aapl/intraday/latest', $queryString));
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    // $json = curl_exec($ch);
    // curl_close($ch);

    // $apiResult = json_decode($json, true);
    // dd($apiResult);
    // foreach ($apiResult['data'] as $stocksData) {
    //     echo sprintf('Ticker %s has a day high of %s on %s', $stocksData['symbol'], $stocksData['high'], $stockData['date']);
    // }
    $api = new StockMarket('aapl');
    return $api->storeCurrentData();
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
