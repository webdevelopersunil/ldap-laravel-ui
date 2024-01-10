<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use LdapRecord\Container;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'cpfNo';
    }


    public function attemptLogin(Request $request)
    {
        $validator = $request->validate([
            'cpfNo' => 'required',
        ]);

        $user = User::where('cpfNo', $request->cpfNo)->first();
        if($user){
            $credentials = $request->only('cpfNo', 'password');
            if (Auth::attempt($credentials)) {
               // Authentication successful
               return redirect()->intended('/home');
            } else {
               return redirect()->route('login')->with('error', 'Invalid credentials');
            }
        }else{
            $connection = Container::getConnection('default');
            $record = $connection->query()->findBy('samaccountname', $request->cpfNo );
            if(!$record) {
                // abort(403);
                return redirect()->route('login')->with('error', 'Invalid credentials');
            }
            if ( $connection->auth()->attempt($record['dn'], $request->password )) {
                $user = User::where('cpfNo', $request->cpfNo)->first();
                if(!$user) {
                    $user = User::create([
                        'name' => $record['name'][0],
                        'email' => $record['mail'][0],
                        'cpfNo' => $request->cpfNo,
                        'password' => bcrypt($request->password),
                    ]);
                }
                Auth::login($user);
                return redirect()->intended('home');
            }

            return false; 
        }
        
        return false;
    }
}
