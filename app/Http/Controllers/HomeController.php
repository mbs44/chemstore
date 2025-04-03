<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * simply provides blade for home page
 */
class HomeController extends Controller
{
    /**
     * simply provides blade for home page
     * @return View
     */
    public function index():View
    {
        return view('home');
    }
}
