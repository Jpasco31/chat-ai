<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FrontendController extends Controller
{
    public function index()
    {
        // If authenticated, have Inertia navigate to the /chat route
        if (Auth::check()) {
            return Inertia::location(route('chat.show'));
        }

        // Otherwise, render the home page
        return Inertia::render('Home', [
            'canLogin' => Route::has('login'),
        ]);
    }
}
