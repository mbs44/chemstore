<?php
namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

/**
 * support language change request
 */
class LanguageController extends Controller
{

    /**
     * applies language change
     * @param Request $request
     * @return RedirectResponse
     */
    public function change(Request $request): RedirectResponse
    {
        // Validate the incoming request
        $request->validate([
            'language' => 'required|string|in:sk,en', // Only allow Slovak or English
        ]);

        // Store the selected language to the session
        $request->session()->put('language', $request->language);

        // Redirect back to the language selection page
        return back()->withInput();
    }
}
