<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TableController extends Controller
{
    //
    function basicTable(){
        return view('Tables.basic-table');
    }
    function dataTable(){
        return view('Tables.data-table');
        
    }
    function editTable(){
        return view('Tables.edit-table');
        
    }
}
