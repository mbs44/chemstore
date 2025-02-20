<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use LdapRecord\Laravel\Auth\AuthenticatesWithLdap;
use LdapRecord\Laravel\Auth\ListensForLdapBindFailure;

class LoginController extends Controller
{
    use AuthenticatesWithLdap, ListensForLdapBindFailure;

    public function showLoginForm() : View
    {
        return view('auth.login'); // This renders the login view
    }

    public function login(Request $request):RedirectResponse
    {
        $username = $request->input('username'); // or any custom field you want to search by
        $password = $request->input('password');

        //      $user = UserCustom::where('uid', $username)->first();

        $credentials = [
            'uid' => $username,
            'password' => $password
        ];

        if (Auth::guard('web')->attempt($credentials)) {
//            $user = Auth::user(); // Check if the user is authenticated
//            dd($user);
            return redirect('/chemicals');
        }
        // Handle failed authentication
        return back()->withErrors(['message' => 'Authentication failed.'], 401);

    }

    public function logout() : RedirectResponse
    {
        Auth::guard('ldap')->logout();
        return redirect('/login'); // Redirect to login after logout
    }
}
