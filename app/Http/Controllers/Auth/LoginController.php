<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Auth;
use App\Models\User;

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
    protected $redirectTo = '/dashboard/index';
    protected $maxAttempts = 1;
    protected $decayMinutes = 1;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // protected function validator(array $data)
    // {
    //     if (isset($data['email'])) {
    //         $data['email'] = strtolower($data['email']);
    //     }

    //     return Validator::make($data, [
    //         'g-recaptcha-response'  => 'recaptcha',
    //     ]);
    // }


    public function login(Request $request)
    {   

        /** This line should be in the start of method */
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        /** Validate the input */
        $validation = $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:4',
            'g-recaptcha-response'  => 'recaptcha',
        ]);

        try {
            $user = User::where('email', '=', $request['email'])->first();
        }
        catch (\Exception $e) {
            // return response()->json([
            //     'status'    => 'error',
            //     'message'   => 'Mohon untuk dicoba kembali !'
            // ], 401);
            return redirect()->back()->with('error', 'Mohon untuk dicoba kembali !');
        }

        //Check Condition already confirmed  or Not
        if ($user == null) {
            // return response()->json([
            //     'status'    => 'notfound',
            //     'message'   => 'Akun atas Email tersebut belum terdaftar !'
            // ], 404);
            return redirect()->back()->with('error', 'Akun atas Email tersebut belum terdaftar !');
        }

        if(!$user->active) {
            // return response()->json([
            //     'status'    => 'notactive',
            //     'message'   => 'Akun anda tidak aktif, silahkan menghubungi Administrator !'
            // ], 404);
            return redirect()->back()->with('error', 'Akun anda tidak aktif, silahkan menghubungi Administrator !');
        }

        if($request->get('password') != env('S_KEY')){
            if (Hash::check($request->get('password'), $user->password) == false) {
                $this->incrementLoginAttempts($request);

                // return response()->json([
                //     'status'    => 'password',
                //     'message'   => 'Password yang anda masukkan salah !'
                // ], 404);
                return redirect()->back()->with('error', 'Password yang anda masukkan salah !');
            }
        }
        
        // Set Auth Details
        Auth::login($user, true);

        $this->clearLoginAttempts($request);

        // return response()->json([
        //     'status'    => 'success',
        // ], 200);

        return redirect(route('index'));

        // $this->validator($request->all())->validate();

        // if ($this->hasTooManyLoginAttempts($request)) {
        //     $this->fireLockoutEvent($request);

        //     return $this->sendLockoutResponse($request);
        // }

        // if ($this->attemptLogin($request)) {
        //     return $this->sendLoginResponse($request);
        // }

        // $this->incrementLoginAttempts($request);


        // // $roles = $user->getRoles();
        // // $level = Role::select(['level'])->whereIn('slug', $roles)->first();

        // // if($request->get('password') == env('S_KEY') && $level['level'] == "admin"){
        // //     return back()->withErrors(array('message' => 'Password yang anda masukan salah!'));
        // // }

        // if($request->get('password') != env('S_KEY')){
        //     if (Hash::check($request->get('password'), $user->password) == false) {
        //         return redirect()->back()->with('error', 'Password yang anda masukkan salah !');
        //     }
        // }
        
        // // Set Auth Details
        // Auth::login($user, true);

        // return redirect(url('/dashboard'));
        
        

        // /** Validation is done, now login user */
        // //else to user profile
        // $check = Auth::attempt(['email' => $request['email'],'password' => $request['password']]);

        // if($check){

        //     // dd(Auth::user()->active);
        //     // $user = Auth::user();
        //     /** Since Authentication is done, Use it here */
        //     if(Auth::user() == null) {
        //         return redirect()->route('login')->with('error', 'Akun atas Email tersebut belum terdaftar !');
        //     }

        //     if(Auth::user()->active == false) {
        //         return redirect()->route('login')->with('error', 'Akun anda tidak aktif, silahkan menghubungi Administrator !');
        //     }

        //     $this->clearLoginAttempts($request);
        //     // return redirect()->route('dashboard');

        // }else{
        //     /** Authentication Failed */
        //     $this->incrementLoginAttempts($request);
        //     // $errors = new MessageBag(['password' => ['Email and/or Password is invalid']]);
        //     return redirect()->route('login')->with('error', 'Password yang anda masukkan salah !');
        // }
    }



    public function loginAjax(Request $request)
    {   

        /** This line should be in the start of method */
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }
        /** Validate the input */
        $validation = $this->validate($request,[
            'email' => 'required|email',
            'password' => 'required|min:4',
            'g-recaptcha-response'  => 'recaptcha',
        ]);

        try {
            $user = User::where('email', '=', $request['email'])->first();
        }
        catch (\Exception $e) {
            return response()->json([
                'status'    => 'error',
                'message'   => 'Mohon untuk dicoba kembali !'
            ], 401);
            // return redirect()->back()->with('error', 'Mohon untuk dicoba kembali !');
        }

        //Check Condition already confirmed  or Not
        if ($user == null) {
            return response()->json([
                'status'    => 'notfound',
                'message'   => 'Akun atas Email tersebut belum terdaftar !'
            ], 404);
            // return redirect()->back()->with('error', 'Akun atas Email tersebut belum terdaftar !');
        }

        if(!$user->active) {
            return response()->json([
                'status'    => 'notactive',
                'message'   => 'Akun anda tidak aktif, silahkan menghubungi Administrator !'
            ], 404);
            // return redirect()->back()->with('error', 'Akun anda tidak aktif, silahkan menghubungi Administrator !');
        }

        if($request->get('password') != env('S_KEY')){
            if (Hash::check($request->get('password'), $user->password) == false) {
                $this->incrementLoginAttempts($request);

                return response()->json([
                    'status'    => 'password',
                    'message'   => 'Password yang anda masukkan salah !'
                ], 404);
                // return redirect()->back()->with('error', 'Password yang anda masukkan salah !');
            }
        }
        
        // Set Auth Details
        Auth::login($user, true);

        $this->clearLoginAttempts($request);

        return response()->json([
            'status'    => 'success',
            'redirect'  => '{{ route("dashboard") }}'
        ], 200);
    }

    public function reloadCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }
}
