<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Ldap\LdapUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;

/**
 * Provides implementation for login, logout and login screen
 */
class LoginController extends Controller
{
    use AuthenticatesWithLdap, ListensForLdapBindFailure;

    /**
     * returns login blade
     * @return View
     */
    public function showLoginForm() : View
    {
        return view('auth.login'); // This renders the login view
    }

    /**
     * Implements authentication procedure
     * @param Request $request
     * @return RedirectResponse
     */
    public function login(Request $request):RedirectResponse
    {
        //take credentials from request
        $username = $request->input('username');
        $password = $request->input('password');

        // prepare credentials object
        $credentials = [
            LdapUser::authLoginAttribute => $username,
            LdapUser::authPasswordAttribute => $password
        ];

        // call auth guard
        if (Auth::guard('web')->attempt($credentials)) {
            // redirect to chemicals list if authenticated
            return redirect('/chemicals');
        }
        // return auth fail message
        return back()->withErrors(['message' => 'Authentication failed. Username or password is invalid']); //, 401

    }

    public function logout() : RedirectResponse
    {
        // logout by calling auth guard
        Auth::guard('web')->logout();
        return redirect('/login'); // Redirect to login after logout
    }
}
