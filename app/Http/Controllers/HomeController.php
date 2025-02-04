<?php

namespace App\Http\Controllers;

use session;
use App\Models\Account;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        #$users = Account::where('id', auth()->user()->id)->first();
        return view('content.home');
    }
}
