<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Temat;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; //żeby działało przekierowywanie do strony /login po podaniu błędnych danych

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    protected function authenticated()
    {
        //po zatwierdzeniu zalogowania, do zmiennej sesyjnej zostaje pobrana zmienna z tematami do nawigacji

        $tematy = Temat::orderBy('nazwa','asc')->get(); //pobiera z bazy posortowane po id malejąco

            session(['listaTematow' => $tematy]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()
            ->route('login')
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => [trans('auth.failed')],
            ]);
    }

}
