<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChartController extends Controller
{
    function chartMorris(){
        return view('Charts.chart-morris');
    }

    function chartHigh(){
        return view('Charts.chart-high');

    }
    
    function chartAm(){
        return view('Charts.chart-am');

    }

    function chartApex(){
        return view('Charts.chart-apex');

    }
}
