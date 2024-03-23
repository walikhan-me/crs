<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;
    protected $redirectTo = '/welcome';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function showLoginForm(Request $request)
    {
        return view('Admin.login'); // Corrected view path
    }
    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended($this->redirectTo);
    }
}
