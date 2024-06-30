<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Story;
use Spatie\Permission\Models\Role;
use DB;
class LoginController extends Controller
{
    public function index()
    {
        if (auth()->user()) {
            return redirect()->route('dashboard');
        }
        
        $pageTitle = 'Login';
        $pageDescription = 'Some description for the page';

        return view('login.login', compact('pageTitle', 'pageDescription'));
    }

    

    public function login(Request $request)
    {
        if (Auth::attempt($request->only('username', 'password'))) {
            $request->session()->regenerate();
            return redirect()->route('dashboard');
        } else {
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function dashboard()
    {
        $userCount = User::count();
        $roleCount = Role::count();
        $story = Story::all();
        // dd($story);

        $pageTitle = 'Dashboard';
        $type_menu = 'dashboard';
        return view('pages.dashboard-general-dashboard', compact('story', 'userCount', 'roleCount', 'pageTitle', 'type_menu'));
    }

    public function viewForgetPassword(){
        $pageTitle = 'Forget Password';
        return view('pages.auth-forgot-password', compact('pageTitle'));
    }

    public function forgetPassword(Request $request){
        $getUser = DB::table('users')->where('email', $request->email)->first();
        // dd($getUser);
        if (!empty($getUser)) {
            $fieldUpdate = [
                'password'      => Hash::make('Rapp@'.$getUser->username),
                'updated_by'=> $getUser->id,
            ];
            $update = DB::table('users')->where('id', $getUser->id)->update($fieldUpdate);
            // send email 
            $subject = "Forget Password Rapp";
            $details = [
                'title' => 'Forget Password',
                'body1' => 'Hai '.$getUser->name.', You have requested a password reset. ',
                'body2' => 'Your password will be changed to Rapp@'.$getUser->username,
                'body3' => 'Please log in and change your password in the profile form.',
            ];
                
            \Mail::to($getUser->email)->send(new \App\Mail\Email($details, $subject));
            return back()->with('success', 'Password reset successful, please check your email');
        } else {
            return back()->with('failed', 'Invalid Email');
        }
    }
}
