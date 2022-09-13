<?php

namespace App\Support;

use Illuminate\Support\Facades\Http;

class  StockMarket
{
    private $ticker;
    private $previousDayClose;
    private $currentDayOpen;
    private $currentDayHigh;
    private $currentDayLow;
    private $currentDayClose;
    private $currentDayValueChange;

    public function __construct($ticker)
    {
        $this->ticker = $ticker;
    }
    public function getPreviousDayClose()
    {
        $previousDay = now()->yesterday()->toDateString();
        $response = $this->connect('eod/' . $previousDay);
        $result = json_decode($response->body());
        dd($result->data);
    }
    public function storeCurrentData()
    {

        $response = $this->connect('intraday',"&interval=15min");
        $result = json_decode($response->body());
        dd($result->data[0]);
    }

    public function connect($endpoint, $params = null)
    {
        $apiKey = config('services.marketstack.key');
        $url = 'http://api.marketstack.com/v1/' . $endpoint;
        $query = 'access_key=' . $apiKey . '&symbols=' . $this->ticker . $params;
        $request  = Http::get($url, $query);
        return $request;
    }
}
