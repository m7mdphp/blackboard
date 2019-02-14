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
use App\Teachers;
class Teacher extends Controller
{
use ValidateAjax;

    public function login(){
		return view('teacher.login');
	}
	
	public function dologin(){
	 $this->validateAjax(request(), [
            'email' => 'required|email',
            'password' => 'required',
        ], true);

		if (auth()->guard('teacher')->attempt(request()->only(['email', 'password']), request()->has('remember'))) {
            request()->session()->regenerate();
activity('Logged In');
           
Auth::shouldUse('teacher');
            return response()->json(['redirect' => request()->session()->pull('url.intended', route('teacher.home'))]);
        }
        else {
            return response()->json(['message' => trans('auth.failed')], 422);
        }
	}
	
	    public function passwordEmailForm()
    {
        return view('teacher.email');
    }
	
	    // email password reset link
    public function passwordEmail()
    {
        $this->validateAjax(request(), [
            'email' => 'required|email',
            'g-recaptcha-response' => 'sometimes|recaptcha',
        ]);

        if ($user = Teachers::where('email', request()->input('email'))->first()) {
            $token = Password::getRepository()->create($user);

            Mail::send(['text' => 'teacher.password'], ['token' => $token], function (Message $message) use ($user) {
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
        return view('teacher.reset', compact('token'));
    }
	 // reset password
    public function passwordReset()
    {
        $this->validateAjax(request(), [
            'email' => 'required|email',
            'password' => 'required|confirmed',
            'g-recaptcha-response' => 'sometimes|recaptcha',
        ]);

        $response = Password::broker()->reset(request()->except('_token'), function ($teacher, $password) {
            $teacher->password = Hash::make($password);
            $teacher->setRememberToken(Str::random(60));
            $teacher->save();

            event(new PasswordReset($teacher));
            auth()->guard('teacher')->login($teacher);
        });

        if ($response == Password::PASSWORD_RESET) {
            activity('Reset Password');
            flash('success', 'Password reset!');

            return response()->json(['redirect' => route('teacher.index')]);
        }
        else {
            return response()->json(['message' => trans($response)], 422);
        }
    }
	 // logout
    public function logout()
    {
	
        activity('Logged Out');

        auth()->guard('teacher')->logout();
        request()->session()->invalidate();

        return redirect()->route('teacher.login');
    }
	// show profile edit form
    public function profileForm()
    {
        return view('teacher.profile');
    }

    // edit profile
    public function profile()
    {
        $this->validateAjax(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:teachers,email,' . auth()->guard('teacher')->user()->id,
        ]);

        auth()->guard('teacher')->user()->update(request()->all());

        activity('Edited Profile', request()->all());
        flash('success', 'Profile edited!');

        return response()->json(['reload_page' => true]);
    }

    // show password change form
    public function passwordChangeForm()
    {
        return view('teacher.change');
    }

    // change password
    public function passwordChange()
    {
        $this->validateAjax(request(), [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        if (Hash::check(request()->input('current_password'), auth()->guard('teacher')->user()->password)) {
            auth()->guard('teacher')->user()->update(['password' => Hash::make(request()->input('password'))]);

            activity('Changed Password');
            flash('success', 'Password changed!');

            return response()->json(['reload_page' => true]);
        }
        else {
            return response()->json(['message' => trans('auth.failed')], 422);
        }
    }
}
