<?php

namespace App\Http\Controllers;

use App\Forms\Auth\LogoutForm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application customer dashboard.
     */
    public function index()
    {
        return view('settings.home', [
            'form' => $this->form(new LogoutForm())
        ]);
    }
}
