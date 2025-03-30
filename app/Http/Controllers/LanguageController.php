<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LanguageController extends Controller
{

    public function change(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'language' => 'required|string|in:sk,en', // Only allow Slovak or English
        ]);

        // Store the selected language in the session
        $request->session()->put('language', $request->language);

        // Redirect back to the language selection page
        return back()->withInput();
    }
}
