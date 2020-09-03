<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // return view('home');
        return '{
"time": {
"updated": "Sep 2, 2020 08:53:00 UTC",
"updatedISO": "2020-09-02T08:53:00+00:00",
"updateduk": "Sep 2, 2020 at 09:53 BST"
},
"disclaimer": "This data was produced from the CoinDesk Bitcoin Price Index (USD). Non-USD currency data converted using hourly conversion rate from openexchangerates.org",
"chartName": "Bitcoin",
"bpi": {
"USD": {
"code": "USD",
"symbol": "&#36;",
"rate": "11,714.0090",
"description": "United States Dollar",
"rate_float": 11714.009
},
"GBP": {
"code": "GBP",
"symbol": "&pound;",
"rate": "8,754.9215",
"description": "British Pound Sterling",
"rate_float": 8754.9215
},
"EUR": {
"code": "EUR",
"symbol": "&euro;",
"rate": "9,837.4482",
"description": "Euro",
"rate_float": 9837.4482
}
}
}';
    }
}
