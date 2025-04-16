<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Handle the user authentication.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function authenticated($request, $user)
    {
        // تحقق من صلاحيات المستخدم
        if ($user->role === 'Admin' || $user->name === 'abdool') {

            return redirect()->intended($this->redirectTo);
        }

        return redirect('/');
    }


}
