<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    public function index(){


        $settings = settings()->all();
        return view('admin.settings.index',compact('settings'));
    }

}
