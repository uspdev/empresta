<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function __construct() {
        $this->middleware('can:manager');
    }

    public function index(){
        return view('settings.index');
    }
}
