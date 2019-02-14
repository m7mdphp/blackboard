<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Kjdion84\Laraback\Traits\ValidateAjax;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Centers;
class Center extends Controller
{
use ValidateAjax;

    public function login(){
		return view('center.login');
	}
	
	public function dologin(){
	 $this->validateAjax(request(), [
            'email' => 'required|email',
            'password' => 'required',
        ], true);

		if (auth()->guard('center')->attempt(request()->only(['email', 'password']), request()->has('remember'))) {
            request()->session()->regenerate();
activity('Logged In');
           
Auth::shouldUse('center');
            return response()->json(['redirect' => request()->session()->pull('url.intended', route('center.home'))]);
        }
        else {
            return response()->json(['message' => trans('auth.failed')], 422);
        }
	}
	
	    public function passwordEmailForm()
    {
        return view('center.email');
    }
	
	    // email password reset link
    public function passwordEmail()
    {
        $this->validateAjax(request(), [
            'email' => 'required|email',
            'g-recaptcha-response' => 'sometimes|recaptcha',
        ]);

        if ($user = Centers::where('email', request()->input('email'))->first()) {
            $token = Password::getRepository()->create($user);

            Mail::send(['text' => 'center.password'], ['token' => $token], function (Message $message) use ($user) {
                $message->subject(config('app.name') . ' Password Reset Link');
                $message->to($user->email);
            });

            flash('success', 'Password reset link emailed!');

            return response()->json(['reload_page' => true]);
        }
        else {
            return response()->json(['message' => trans('auth.failed')], 422);
        }
    }
	 public function passwordResetForm($token)
    {
        return view('center.reset', compact('token'));
    }
	 // reset password
    public function passwordReset()
    {
        $this->validateAjax(request(), [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'g-recaptcha-response' => 'sometimes|recaptcha',
        ]);

        $response = Password::broker()->reset(request()->except('_token'), function ($center, $password) {
            $center->password = Hash::make($password);
            $center->setRememberToken(Str::random(60));
            $center->save();

            event(new PasswordReset($center));
            auth()->guard('center')->login($center);
        });

        if ($response == Password::PASSWORD_RESET) {
            activity('Reset Password');
            flash('success', 'Password reset!');

            return response()->json(['redirect' => route('center.index')]);
        }
        else {
            return response()->json(['message' => trans($response)], 422);
        }
    }
	 // logout
    public function logout()
    {
	
        activity('Logged Out');

        auth()->guard('center')->logout();
        request()->session()->invalidate();

        return redirect()->route('center.login');
    }
	// show profile edit form
    public function profileForm()
    {
        return view('center.profile');
    }

    // edit profile
    public function profile()
    {
        $this->validateAjax(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:centers,email,' . auth()->guard('center')->user()->id,
        ]);

        auth()->guard('center')->user()->update(request()->all());

        activity('Edited Profile', request()->all());
        flash('success', 'Profile edited!');

        return response()->json(['reload_page' => true]);
    }

    // show password change form
    public function passwordChangeForm()
    {
        return view('center.change');
    }

    // change password
    public function passwordChange()
    {
        $this->validateAjax(request(), [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check(request()->input('current_password'), auth()->guard('center')->user()->password)) {
            auth()->guard('center')->user()->update(['password' => Hash::make(request()->input('password'))]);

            activity('Changed Password');
            flash('success', 'Password changed!');

            return response()->json(['reload_page' => true]);
        }
        else {
            return response()->json(['message' => trans('auth.failed')], 422);
        }
    }
}
