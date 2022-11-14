<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Exception;
use http\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
//    use AuthenticatesUsers;

    /**
     * Display the login view.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function update(Request $request)
    {
        try {

            $user = (Auth::user())['id'];
            // check if updated email is already registered, but not for this user
            $userId = User::select('id')->where('email', $request->email)->get()[0]['id'];
//
            if($userId != $user){
               return view('admin.error', ['error' => "The email has already been taken.", 'code' => 422]);
            }
        }catch (\ErrorException $exception){
            // if email not found get()[0] will give "Undefined array key"
        }

        $user = User::where('id', $user)
            ->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

        return redirect()->back();
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */

    public function redirectToGoogle()

    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()

    {
        try {

            $user = Socialite::driver('google')->user();
//            dd($user->id);
            $finduser = User::where('google_id', $user->id)->first();
//            dd($finduser);
            if($finduser){

                Auth::login($finduser);

                return redirect()->route('dashboard');

            }else{

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'google_id'=> $user->id

                ]);
//                dd($newUser);
                Auth::login($newUser);

                return redirect()->route('dashboard');

            }

        } catch (Exception $e) {
//            dd($e->getMessage());
            return redirect('auth/google');

        }

    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('facebook_provider_user_id', $user->id)->first();

            if($finduser){

                Auth::login($finduser);

                return redirect()->route('dashboard');

            }else {

                $newUser = User::create([

                    'name' => $user->name,

                    'email' => $user->email,

                    'facebook_provider_user_id' => $user->id

                ]);
                Auth::login($newUser);

                return redirect()->route('dashboard');
            }

        }catch (Exception $e) {
//            dd($e->getMessage());
            return redirect('auth/facebook');
        }

    }
}
