<?php

namespace App\Http\Controllers;

use Session;
use Socialite;
use App\Models\User;
use App\Models\Company;
use App\Models\JobSeeker;
use App\Models\SiteSetting;
use App\Models\JobSeekerPreference;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function create_user(Request $request) {
        $input =  $request->all();
        if($input['password'] == $input['cpassword']) {
            unset($input['cpassword']);
            $input['password'] = Hash::make($input['password']);
            // check if email exists
            $check = User::where(['email' => $input['email']])->first();
            if($check) {
                return redirect()->route('register')->with('error', 'User already exists with this email!');
            }
            $input['token'] = md5(uniqid(rand(), true));
            $user = User::create($input);
            if($input['role'] == 'employee') {
                Company::create([
                    'user_id'       =>  $user->id,
                    'slug'          =>  $this->slugify($input['name']),
                    'industry_id'   =>  $input['industry_id']
                ]);
            }
            if($input['role'] == 'jobseeker') {
                $seeker = JobSeeker::create(['user_id' => $user->id]);
                JobSeekerPreference::create(['job_seeker_id' => $seeker->id]);
            }
            $details = [
                'role'          =>  $user->role,
                'name'          =>  $user->name,
                'url'           =>  url('/') . '/activate/' . $user->id . '/' . $user->token,
            ];
            $user->notify(new \App\Notifications\AccountCreated($details));
            return redirect()->route('login')->with('success', 'User Registered! Verify Email to continue!');
        } else {
            return redirect()->route('register')->with('error', 'Password MisMatch!');
        }
    }

    public function check_user(Request $request) {
        $check = User::where(['email' => $request->email])->first();
        if($check) {
            if(Hash::check($request->password, $check->password)) {
                if(!$check->email_verified) {
                    return redirect()->route('login')->withErrors(['email' => 'Email not verified.'])->withInput();
                }
                $request->session()->put('user',[                          
                    'userid'    =>  $check->id,
                    'role'      =>  $check->role,
                    'name'      =>  $check->name,
                ]);
                if($check->role == 'admin' || $check->role == 'staff') {
                    return redirect()->route('admin.dashboard');
                } else if($check->role == 'employee') {
                    return redirect()->route('employee.dashboard');
                }
                return redirect()->route('jobseeker.dashboard');
            } else {
                return redirect()->route('login')->withErrors(['password' => 'Password do not match our records.'])->withInput();
            }
        } else {
            return redirect()->route('login')->withErrors(['email' => 'These credentials do not match our records.'])->withInput();
        }
    }
    public function logout() {
        Session::flush(); 
        return redirect()->route('landing');
    }

    public function verify_email($id, $token) {
        $user =  User::findorfail($id);
        if($token == $user->token) {
            $user->update(['email_verified' => 1]);
            return view('verification.verified');
        } else {
            return view('verification.error');
        }
        
    }

    public function resetpassword(Request $request) {
        $user = User::where(['email' => $request->email])->first();
        if($user) {
            $details = [
                'name'      =>  $user->name,
                'url'       =>  url('/') . '/reset/' . $user->id . '/' . $user->token,
            ];
            $user->notify(new \App\Notifications\ResetPassword($details));
        }
        return redirect()->back()->with('success', 'Mail sent to this email if found on our record!');
    }

    public function reset_validate($id, $token) {
        $sitesetting = SiteSetting::first();
        $user =  User::findorfail($id);
        if($token == $user->token) {
            return view('verification.resetpassword',compact('sitesetting','user'));
        } else {
            return view('verification.error');
        }
    }

    public function reset_password(Request $request) {
        $input =  $request->all();
        if($input['password'] == $input['cpassword']) {
            $input['password'] = Hash::make($input['password']);
            $user = User::findorfail($input['id']);
            $user->update($input);
            return redirect()->route('login')->with('success', 'Password Updated! Login to continue!');
        } else {
            return redirect()->back()->with('error', 'Password Mismatch!');
        }
    }

    public function redirectToProvider($provider) {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider) {
        $user = Socialite::driver($provider)->stateless()->user();
        $auth = $this->findorCreateUser($user,$provider);
        Session::put('user',[                          
            'userid'    =>  $auth->id,
            'role'      =>  $auth->role,
            'name'      =>  $auth->name,
        ]);

        if($auth->role == 'admin' || $auth->role == 'staff') {
            return redirect()->route('admin.dashboard');
        } else if($auth->role == 'employee') {
            return redirect()->route('employee.dashboard');
        }
        return redirect()->route('jobseeker.dashboard');
    }

    public function findorCreateUser($user,$provider) {
        $authUser = User::where(['email' => $user->email])->first();
        if ($authUser) {
            return $authUser;
        }
        $token = md5(uniqid(rand(), true));
        $auth = User::create([
            'name'              =>  $user->name,
            'role'              =>  'jobseeker',
            'email'             =>  $user->email,
            'provider'          =>  $provider,
            'provider_id'       =>  $user->id,
            'token'             =>  $token,
            'email_verified'     =>  '1'
        ]);
        $seeker = JobSeeker::create(['user_id' => $auth->id]);
        JobSeekerPreference::create(['job_seeker_id' => $seeker->id]);
        return $auth;
    }

    public function slugify($text, string $divider = '-') {
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = preg_replace('~[^-\w]+~', '', $text);
        $text = trim($text, $divider);
        $text = preg_replace('~-+~', $divider, $text);
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}
