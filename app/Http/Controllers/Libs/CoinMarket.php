<?php

namespace App\Http\Controllers\Libs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CoinMarket extends Controller
{
    /**
     * @var string
     */
    private $url;
    /**
     * @var string[]
     */
    private $headers;

    public function __construct()
    {
        $this->url = env('COINMARKETCAP_URL');

        $this->headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . env('COINMARKETCAP_KEY')
        ];
    }

    public function getLatest()
    {
        $url = $this->url . "/v1/cryptocurrency/quotes/latest";
        $parameters = [
            'convert' => 'USD',
            'symbol'  => "BTC,ETH,TRX"
        ];
        $curl = curl_init(); // Get cURL resource
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL

        curl_setopt_array($curl, array(
            CURLOPT_URL            => $request,            // set the request URL
            CURLOPT_HTTPHEADER     => $this->headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ));

        $response = curl_exec($curl); // Send the request, save the response
        curl_close($curl); // Close request
        return json_decode($response);
    }
}
